<?php
// app/Http/Controllers/Api/TerasPangan/SupplyBalanceController.php
namespace App\Http\Controllers\Api\TerasPangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupplyBalanceController extends Controller
{
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate(['date' => 'required|date']);

        $data = [
            ['commodity' => 'Beras', 'quantityKg' => 120000],
            ['commodity' => 'Jagung', 'quantityKg' => 85000],
            ['commodity' => 'Kedelai', 'quantityKg' => 45000],
            ['commodity' => 'Bawang Merah', 'quantityKg' => 30000],
            ['commodity' => 'Bawang Putih', 'quantityKg' => 25000]
        ];

        return response()->json(['date' => $request->date, 'data' => $data]);
    }
}
