<?php
// app/Http/Controllers/Api/TerasPangan/CheapFoodController.php
namespace App\Http\Controllers\Api\TerasPangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheapFoodController extends Controller
{
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate(['date' => 'required|date']);

        $data = [
            ['region' => 'Kota Serang',    'count' => 3],
            ['region' => 'Kab. Serang',    'count' => 2],
            ['region' => 'Kab. Pandeglang', 'count' => 2],
            ['region' => 'Kab. Tangerang', 'count' => 1],
            ['region' => 'Kota Tangerang', 'count' => 1],
            ['region' => 'Kota Cilegon',   'count' => 1],
            ['region' => 'Kab. Lebak',     'count' => 1]
        ];

        return response()->json(['date' => $request->date, 'data' => $data, 'total' => 12]);
    }
}
