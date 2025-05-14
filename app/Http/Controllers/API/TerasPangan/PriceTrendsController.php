<?php

// app/Http/Controllers/Api/TerasPangan/PriceTrendsController.php
namespace App\Http\Controllers\Api\TerasPangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PriceTrendsController extends Controller
{
    public function monthly(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'commodities' => 'required|array',
            'months'      => 'required|integer|min:1',
            'endMonth'    => 'required|date_format:Y-m'
        ]);

        $trends = [
            ['month' => 'Maret', 'prices' => ['Beras' => 12000, 'Jagung' => 10000, 'Kedelai' => 8500]],
            ['month' => 'April', 'prices' => ['Beras' => 13000, 'Jagung' => 11000, 'Kedelai' => 9000]],
            ['month' => 'Mei',   'prices' => ['Beras' => 14000, 'Jagung' => 12000, 'Kedelai' => 9500]]
        ];

        return response()->json(['endMonth' => $request->endMonth, 'trends' => $trends]);
    }
}
