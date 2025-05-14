<?php

namespace App\Http\Controllers\Api\TerasPangan;

use App\Http\Controllers\Controller;
use App\Komoditas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\MasterKomoditas;

class PriceStatisticsController extends Controller
{
    /**
     * GET /api/teras-pangan/price-statistics/quarterly
     * Query params:
     *   - commodities[]: array of commodity names (string)
     *   - endMonth: string YYYY-MM
     *
     * Response JSON:
     * {
     *   "endMonth": "2025-05",
     *   "statistics": [
     *     {
     *       "commodity": "Beras",
     *       "max": 14800,
     *       "min": 5000,
     *       "avg": 7400
     *     },
     *     ...
     *   ]
     * }
     */
    public function quarterly(Request $request)
    {
        $validated = $request->validate([
            'commodities' => 'required|array|min:1',
            'commodities.*' => 'string|distinct',
            'endMonth'    => 'required|date_format:Y-m',
        ]);

        $names    = $validated['commodities'];
        $endMonth = Carbon::createFromFormat('Y-m', $validated['endMonth'])->startOfMonth();
        $startMonth = $endMonth->copy()->subMonths(2)->startOfMonth();
        $endDate  = $endMonth->copy()->endOfMonth();

        // Map commodity names to IDs
        $komIds = Komoditas::whereIn('nama_pangan', $names)
            ->pluck('id_kmd', 'nama_pangan');

        // Fetch statistics (max, min, avg) per commodity
        $stats = DB::table('harga_komoditas_harian_kabkota')
            ->select(
                'id_komoditas',
                DB::raw('MAX(harga) as max_price'),
                DB::raw('MIN(harga) as min_price'),
                DB::raw('ROUND(AVG(harga), 2) as avg_price')
            )
            ->whereIn('id_komoditas', $komIds->values()->toArray())
            ->whereDate('waktu', '>=', $startMonth->toDateString())
            ->whereDate('waktu', '<=', $endDate->toDateString())
            ->groupBy('id_komoditas')
            ->get();

        // Build result array ordered by input names
        $result = [];
        foreach ($names as $name) {
            if (!isset($komIds[$name])) {
                continue;
            }
            $id = $komIds[$name];
            $rec = $stats->firstWhere('id_komoditas', $id);
            $result[] = [
                'commodity' => $name,
                'max'       => $rec?->max_price !== null ? (float) $rec->max_price : null,
                'min'       => $rec?->min_price !== null ? (float) $rec->min_price : null,
                'avg'       => $rec?->avg_price !== null ? (float) $rec->avg_price : null,
            ];
        }

        return response()->json([
            'endMonth'   => $endMonth->format('Y-m'),
            'statistics' => $result,
        ]);
    }
}
