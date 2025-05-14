<?php
// Controller: app/Http/Controllers/Api/TerasPangan/GkpController.php

namespace App\Http\Controllers\Api\TerasPangan;

use App\Http\Controllers\Controller;
use App\Komoditas;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\GkpRecord;
use Illuminate\Support\Facades\DB;

class GkpController extends Controller
{
    /**
     * GET /api/teras-pangan/gkp
     * Params:
     *   - level: string, e.g. 'petani'
     *   - commodity: string|null, nama komoditas (optional)
     *   - period: string, e.g. 'weekly'
     *   - endDate: YYYY-MM-DD
     *
     * Response JSON:
     * {
     *   "level": "petani",
     *   "commodity": null,
     *   "period": "weekly",
     *   "endDate": "2025-05-12",
     *   "data": [
     *     { "week": "MG I", "count": 18 },
     *     { "week": "MG II", "count": 3 },
     *     ...
     *   ],
     *   "hppNasional": 6500.00
     * }
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'level'     => 'required|string',
            'commodity' => 'nullable|string',
            'period'    => 'required|string',
            'endDate'   => 'required|date_format:Y-m-d',
        ]);

        $level      = $validated['level'];
        $commodity  = $validated['commodity'] ?? null;
        $period     = $validated['period'];
        $endDate    = Carbon::createFromFormat('Y-m-d', $validated['endDate']);

        $query = GkpRecord::query()
            ->where('level', $level)
            ->where('period', $period)
            ->whereDate('date', '<=', $endDate->toDateString());

        if ($commodity) {
            // Map nama komoditas ke id jika perlu
            $komoditasId = Komoditas::where('nama_pangan', $commodity)
                ->value('id_kmd');
            $query->where('id_komoditas', $komoditasId);
        }

        // Ambil data dan group per week
        $records = $query
            ->select('week', DB::raw('SUM(count) as count'), 'hpp_nasional')
            ->groupBy('week', 'hpp_nasional')
            ->orderBy('week')
            ->get();

        $data = $records->map(fn($r) => [
            'week'  => $r->week,
            'count' => (int)$r->count,
        ]);

        $hppNasional = $records->first()->hpp_nasional ?? null;

        return response()->json([
            'level'       => $level,
            'commodity'   => $commodity,
            'period'      => $period,
            'endDate'     => $endDate->toDateString(),
            'data'        => $data,
            'hppNasional' => $hppNasional !== null ? (float)$hppNasional : null,
        ]);
    }
}
