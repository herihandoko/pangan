<?php

// app/Http/Controllers/Api/TerasPangan/PriceStatisticsController.php
namespace App\Http\Controllers\Api\TerasPangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PriceStatisticsController extends Controller
{
    public function quarterly(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'commodities' => 'required|array',
            'endMonth'    => 'required|date_format:Y-m'
        ]);

        $stats = [
            ['commodity' => 'Beras',        'max' => 14800, 'min' => 5000,  'avg' => 7400],
            ['commodity' => 'Jagung',       'max' => 13000, 'min' => 9000,  'avg' => 11000],
            ['commodity' => 'Kedelai',      'max' => 9500,  'min' => 8000,  'avg' => 8700],
            ['commodity' => 'Bawang Merah', 'max' => 60000, 'min' => 50000, 'avg' => 55000]
        ];

        return response()->json(['endMonth' => $request->endMonth, 'statistics' => $stats]);
    }
}
