<?php
namespace App\Http\Controllers\Api\TerasPangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PricePerRegionController extends Controller
{
    /**
     * GET /api/teras-pangan/price-per-region?commodities[]=...&date=YYYY-MM-DD
     *
     * Response JSON:
     * {
     *   "date": "2025-05-12",
     *   "regions": [
     *     {
     *       "region_id": 1,
     *       "region": "Kab. Pandeglang",
     *       "prices": { "Beras Medium": 30000.00, "Bawang Putih": 45000.00 }
     *     },
     *     ...
     *   ]
     * }
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'commodities'   => 'required|array|min:1',
            'commodities.*' => 'string|distinct',
            'date'          => 'required|date_format:Y-m-d',
        ]);

        $names = $validated['commodities'];
        $date  = $validated['date'];

        $records = DB::table('harga_komoditas_harian_kabkota as kh')
            ->join('master_administrasi as ma', 'kh.kode_kab', '=', 'ma.kd_adm')
            ->join('master_komoditas   as mk', 'kh.id_komoditas', '=', 'mk.id_kmd')
            ->select(
                'ma.kd_adm as region_id',
                'ma.nm_adm as region',
                'mk.nama_pangan as commodity',
                DB::raw('ROUND(AVG(kh.harga), 2) as price')
            )
            ->whereIn('mk.nama_pangan', $names)
            ->whereDate('kh.waktu', $date)
            ->groupBy('ma.kd_adm', 'ma.nm_adm', 'mk.nama_pangan')
            ->get();

        $grouped = $records->groupBy('region_id');

        $regions = $grouped->map(function ($items, $regionId) {
            $first = $items->first();
            $prices = $items->pluck('price', 'commodity')->map(fn($p) => (float)$p);
            return [
                'region_id' => $regionId,
                'region'    => $first->region,
                'prices'    => $prices,
            ];
        })->values();

        return response()->json([
            'date'    => $date,
            'regions' => $regions,
        ]);
    }
}
