<?php

// app/Http/Controllers/Api/TerasPangan/PricePerRegionController.php
namespace App\Http\Controllers\Api\TerasPangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PricePerRegionController extends Controller
{
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'commodities' => 'required|array',
            'date'        => 'required|date'
        ]);

        $regions = [
            ['region' => 'Kab. Pandeglang',    'prices' => ['Beras Medium' => 30000, 'Bawang Putih' => 45000]],
            ['region' => 'Kab. Lebak',         'prices' => ['Beras Medium' => 32000, 'Bawang Putih' => 44000]],
            ['region' => 'Kota Serang',        'prices' => ['Beras Medium' => 31000, 'Bawang Putih' => 46000]],
            ['region' => 'Kota Tangerang',     'prices' => ['Beras Medium' => 33000, 'Bawang Putih' => 47000]]
        ];

        return response()->json(['date' => $request->date, 'regions' => $regions]);
    }
}
