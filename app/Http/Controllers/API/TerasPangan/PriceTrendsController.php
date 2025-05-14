<?php

namespace App\Http\Controllers\Api\TerasPangan;

use App\Http\Controllers\Controller;
use App\Komoditas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\MasterKomoditas;

class PriceTrendsController extends Controller
{
    /**
     * GET /api/teras-pangan/price-trends/monthly
     * Query params:
     *   - commodities[]: array of commodity names (string)
     *   - months: integer, number of months
     *   - endMonth: string YYYY-MM
     *
     * Response JSON:
     * {
     *   "endMonth": "2025-05",
     *   "trends": [
     *     { "month": "Maret", "prices": { "Beras": 12000.00, ... } },
     *     ...
     *   ]
     * }
     */
    public function monthly(Request $request)
    {
        $validated = $request->validate([
            'commodities'   => 'required|array|min:1',
            'commodities.*' => 'string|distinct',
            'months'        => 'required|integer|min:1',
            'endMonth'      => 'required|date_format:Y-m',
        ]);

        $names    = $validated['commodities'];
        $months   = (int) $validated['months'];
        $endMonth = Carbon::createFromFormat('Y-m', $validated['endMonth'])->startOfMonth();
        $startMonth = $endMonth->copy()->subMonths($months - 1)->startOfMonth();

        // Map commodity names to IDs and invert mapping for names lookup
        $komIds      = Komoditas::whereIn('nama_pangan', $names)
            ->pluck('id_kmd', 'nama_pangan');
        $idToNameMap = $komIds->flip(); // Collection: id_kmd => nama_pangan

        // Fetch average price per commodity per month (format YYYY-MM)
        $records = DB::table('harga_komoditas_harian_kabkota')
            ->select(
                DB::raw("DATE_FORMAT(waktu, '%Y-%m') as ym"),
                'id_komoditas',
                DB::raw('ROUND(AVG(harga), 2) as avg_price')
            )
            ->whereIn('id_komoditas', $komIds->values()->toArray())
            ->whereDate('waktu', '>=', $startMonth->toDateString())
            ->whereDate('waktu', '<=', $endMonth->copy()->endOfMonth()->toDateString())
            ->groupBy('ym', 'id_komoditas')
            ->orderBy('ym')
            ->get();

        // Group by ym (year-month)
        $grouped = $records->groupBy('ym');

        $trends = [];
        foreach ($grouped as $ym => $items) {
            // Month name in Indonesian
            $monthName = Carbon::createFromFormat('Y-m', $ym)
                ->locale('id')->translatedFormat('F');

            // Build prices per commodity
            $prices = [];
            foreach ($items as $row) {
                $name = $idToNameMap->get($row->id_komoditas);
                $prices[$name] = (float) $row->avg_price;
            }

            $trends[] = [
                'month'   => $monthName,
                'prices'  => $prices,
            ];
        }

        return response()->json([
            'endMonth' => $endMonth->format('Y-m'),
            'trends'   => $trends,
        ]);
    }
}
