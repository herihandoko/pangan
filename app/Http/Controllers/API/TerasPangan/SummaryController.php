<?php

// app/Http/Controllers/Api/TerasPangan/SummaryController.php
namespace App\Http\Controllers\Api\TerasPangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'priceDecrease'   => ['percent' => 20.43, 'commodity' => 'Cabai Rawit Merah'],
            'priceIncrease'   => ['percent' => 2.90,  'commodity' => 'Daging Sapi Lokal'],
            'ricePriceStatus' => ['status'  => 'STABIL', 'date' => '11 Mei 2025'],
            'cheapFoodCount'  => ['total'   => 12,     'date' => '11 Mei 2025'],
            'lastUpdated'     => '2025-05-12T06:00:00+07:00',
            'source'          => 'Dinas Ketahanan Pangan Prov. Banten'
        ]);
    }
}
