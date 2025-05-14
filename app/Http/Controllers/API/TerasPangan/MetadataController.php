<?php

// app/Http/Controllers/Api/TerasPangan/MetadataController.php
namespace App\Http\Controllers\Api\TerasPangan;

use App\Http\Controllers\Controller;

class MetadataController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'menus'       => ['SPAN Lapor', 'Teras Kepegawaian', 'Teras Pemukiman', 'Teras Investasi', 'Teras Kesehatan', 'Teras Perhubungan'],
            'lastUpdated' => '2025-05-12T06:00:00+07:00',
            'source'      => 'Dinas Ketahanan Pangan Prov. Banten'
        ]);
    }
}
