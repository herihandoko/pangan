<?php

namespace App\Http\Controllers\Api\TerasPangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

class MetadataController extends Controller
{
    /**
     * GET /api/teras-pangan/metadata
     * 
     * Response JSON:
     * {
     *   "menus": ["SPAN Lapor", "Teras Kepegawaian", "Teras Pemukiman", "Teras Investasi", "Teras Kesehatan", "Teras Perhubungan"],
     *   "lastUpdated": "2025-05-12T06:00:00+07:00",
     *   "source": "Dinas Ketahanan Pangan Prov. Banten"
     * }
     */
    public function index(): JsonResponse
    {
        $menus = [
            'SPAN Lapor',
            'Teras Kepegawaian',
            'Teras Pemukiman',
            'Teras Investasi',
            'Teras Kesehatan',
            'Teras Perhubungan',
        ];

        return response()->json([
            'menus'       => $menus,
            'lastUpdated' => Carbon::now()->toIso8601String(),
            'source'      => 'Dinas Ketahanan Pangan Prov. Banten',
        ]);
    }
}
