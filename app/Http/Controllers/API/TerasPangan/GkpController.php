<?php

// app/Http/Controllers/Api/TerasPangan/GkpController.php
namespace App\Http\Controllers\Api\TerasPangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GkpController extends Controller
{
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'level'    => 'nullable|in:petani',
            'commodity' => 'nullable|string',
            'period'   => 'required|in:weekly',
            'endDate'  => 'required|date'
        ]);

        $results = [
            ['mg' => 'MG V', 'count' => 21],
            ['mg' => 'MG I', 'count' => 18],
            ['mg' => 'MG II', 'count' => 3],
            ['mg' => 'MG III', 'count' => 0],
            ['mg' => 'MG IV', 'count' => 0]
        ];

        return response()->json([
            'level'       => $request->level ?? 'petani',
            'commodity'   => $request->commodity,
            'period'      => $request->period,
            'endDate'     => $request->endDate,
            'data'        => $results,
            'hppNasional' => 6500
        ]);
    }
}
