<?php
namespace App\Http\Controllers\Api\TerasPangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CheapFoodController extends Controller
{
    /**
     * GET /api/teras-pangan/cheap-food?date=YYYY-MM-DD
     * Response JSON:
     * {
     *   "date": "2025-05-12",
     *   "data": [
     *     { "region_id": 1, "region": "Kab. Pandeglang", "count": 2 },
     *     ...
     *   ],
     *   "total": 12
     * }
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date_format:Y-m-d',
        ]);

        $date = $validated['date'];

        // Ambil rata-rata harga per komoditas per region
        $records = DB::table('harga_komoditas_harian_kabkota as kh')
            ->join('master_administrasi as ma', 'kh.kode_kab', '=', 'ma.kd_adm')
            ->select(
                'kh.id_komoditas',
                'ma.kd_adm as region_id',
                'ma.nm_adm as region',
                DB::raw('ROUND(AVG(kh.harga), 2) as avg_price')
            )
            ->whereDate('kh.waktu', $date)
            ->groupBy('kh.id_komoditas', 'ma.kd_adm', 'ma.nm_adm')
            ->get();

        // Filter untuk harga termurah tiap komoditas
        $cheaps = $records
            ->groupBy('id_komoditas')
            ->map(function ($items) {
                $min = $items->min('avg_price');
                return $items->filter(fn($i) => $i->avg_price == $min);
            })
            ->flatten(1);

        // Hitung jumlah termurah per region
        $data = $cheaps
            ->groupBy('region_id')
            ->map(fn($items, $regionId) => [
                'region_id' => $regionId,
                'region'    => $items->first()->region,
                'count'     => $items->count(),
            ])
            ->values();

        $total = $cheaps->count();

        return response()->json([
            'date'  => $date,
            'data'  => $data,
            'total' => $total,
        ]);
    }
}