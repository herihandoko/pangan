<?php
// Controller: app/Http/Controllers/Api/TerasPangan/SupplyBalanceController.php

namespace App\Http\Controllers\Api\TerasPangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NeracaKetersediaanPangan;
use Carbon\Carbon;

class SupplyBalanceController extends Controller
{
    /**
     * GET /api/teras-pangan/supply-balance?date=YYYY-MM-DD
     * Returns list of commodities with available quantity (kg) per region.
     */
    public function index(Request $request)
    {
        // Validate date param or default to yesterday
        $date = $request->query('date', Carbon::yesterday()->toDateString());

        // Fetch supply balance records for the given date
        $records = NeracaKetersediaanPangan::with(['komoditas', 'administrasi'])
            ->where('date', $date)
            ->get();

        // Transform data
        $data = $records->map(function ($item) {
            return [
                'commodity'  => $item->komoditas->nama_pangan,
                'region'     => $item->administrasi->nm_adm,
                'quantityKg' => (float) $item->quantity_kg,
            ];
        });

        return response()->json([
            'date' => $date,
            'data' => $data,
        ]);
    }
}
