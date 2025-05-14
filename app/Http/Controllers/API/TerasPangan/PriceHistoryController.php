<?php
// app/Http/Controllers/Api/TerasPangan/PriceHistoryController.php
namespace App\Http\Controllers\Api\TerasPangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PriceHistoryController extends Controller
{
    public function daily(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'commodities' => 'required|array',
            'days'        => 'required|integer|min:1|max:30',
            'endDate'     => 'required|date'
        ]);

        $sample = [
            ['commodity' => 'Beras',        'today' => 14000, 'yesterday' => 14881, 'twoDaysAgo' => 14833],
            ['commodity' => 'Jagung',       'today' => 12000, 'yesterday' => 11800, 'twoDaysAgo' => 11500],
            ['commodity' => 'Kedelai',      'today' => 8800,  'yesterday' => 9000,  'twoDaysAgo' => 9200],
            ['commodity' => 'Bawang Merah', 'today' => 56000, 'yesterday' => 58000, 'twoDaysAgo' => 57000]
        ];

        return response()->json(['endDate' => $request->endDate, 'prices' => $sample]);
    }
}
