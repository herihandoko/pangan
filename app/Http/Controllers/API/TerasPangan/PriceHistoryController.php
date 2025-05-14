<?php
// app/Http/Controllers/Api/TerasPangan/PriceHistoryController.php
namespace App\Http\Controllers\Api\TerasPangan;

use App\Http\Controllers\Controller;
use App\Komoditas;
use App\Models\HargaKomoditasHarianKabkota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PriceHistoryController extends Controller
{
    public function daily(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'commodities' => 'required|array|min:1',
            'commodities.*' => 'string|distinct',
            'days'        => 'required|integer|min:1|max:30',
            'endDate'     => 'required|date_format:Y-m-d',
        ]);

        $names    = $validated['commodities'];
        $days     = (int)$validated['days'];
        $endDate  = Carbon::createFromFormat('Y-m-d', $validated['endDate']);
        $startDate = $endDate->copy()->subDays($days - 1);

        // Map commodity names to IDs
        $komIds = Komoditas::whereIn('nama_pangan', $names)
            ->pluck('id_kmd', 'nama_pangan');

        // Fetch average prices per commodity per date
        $records = HargaKomoditasHarianKabkota::select(
            'id_komoditas',
            DB::raw('DATE(waktu) as date'),
            DB::raw('ROUND(AVG(harga), 2) as avg_price')
        )
            ->whereIn('id_komoditas', $komIds->values()->toArray())
            ->whereDate('waktu', '>=', $startDate->toDateString())
            ->whereDate('waktu', '<=', $endDate->toDateString())
            ->groupBy('id_komoditas', 'date')
            ->get();

        // Group by commodity ID
        $grouped = $records->groupBy('id_komoditas');

        $result = [];
        foreach ($names as $name) {
            if (!isset($komIds[$name])) {
                continue;
            }
            $id = $komIds[$name];
            $history = [];
            for ($i = 0; $i < $days; $i++) {
                $date = $endDate->copy()->subDays($i)->toDateString();
                $rec = $grouped->get($id)?->firstWhere('date', $date);
                $history[$date] = $rec?->avg_price ? (float)$rec->avg_price : null;
            }
            $result[] = ['commodity' => $name, 'history' => $history];
        }

        return response()->json([
            'endDate' => $endDate->toDateString(),
            'prices'  => $result,
        ]);
    }
}
