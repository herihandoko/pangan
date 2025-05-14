<?php

// app/Http/Controllers/Api/TerasPangan/SummaryController.php
namespace App\Http\Controllers\Api\TerasPangan;

use App\Http\Controllers\Controller;
use App\Komoditas;
use App\Models\HargaKomoditasHarianKabkota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class SummaryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $date      = $request->query('date', Carbon::yesterday()->toDateString());
        $yesterday = Carbon::parse($date)->subDay()->toDateString();

        // 1) Avg price per komoditas
        $avgToday = HargaKomoditasHarianKabkota::select('id_komoditas', DB::raw('AVG(harga) as harga_rata'))
            ->whereDate('waktu', $date)
            ->groupBy('id_komoditas');

        $avgYest = HargaKomoditasHarianKabkota::select('id_komoditas', DB::raw('AVG(harga) as harga_rata'))
            ->whereDate('waktu', $yesterday)
            ->groupBy('id_komoditas');

        // 2) Compute changes
        $changes = Komoditas::joinSub(
            $avgToday,
            't',
            fn($j) =>
            $j->on('master_komoditas.id_kmd', 't.id_komoditas')
        )
            ->joinSub(
                $avgYest,
                'y',
                fn($j) =>
                $j->on('master_komoditas.id_kmd', 'y.id_komoditas')
            )
            ->select(
                'master_komoditas.id_kmd',
                'nama_pangan',
                DB::raw('ROUND((t.harga_rata - y.harga_rata) / y.harga_rata * 100, 2) as percent_change')
            );

        $increase = (clone $changes)->orderByDesc('percent_change')->first();
        $decrease = (clone $changes)->orderBy('percent_change')->first();

        // 3) Rice status
        $riceId    = Komoditas::where('nama_pangan', 'like', '%Beras%')->value('id_kmd');
        $riceToday = HargaKomoditasHarianKabkota::where('id_komoditas', $riceId)
            ->whereDate('waktu', $date)->avg('harga');
        $riceYest  = HargaKomoditasHarianKabkota::where('id_komoditas', $riceId)
            ->whereDate('waktu', $yesterday)->avg('harga');

        $riceStatus = $riceToday > $riceYest
            ? 'NAIK' : ($riceToday < $riceYest ? 'TURUN' : 'STABIL');

        // 4) Cheap food count
        $regions = HargaKomoditasHarianKabkota::select('id_komoditas', 'kode_kab', DB::raw('AVG(harga) as avg_price'))
            ->whereDate('waktu', $date)
            ->groupBy('id_komoditas', 'kode_kab')
            ->get();

        $cheapCount = $regions->groupBy('id_komoditas')
            ->map(fn($items) => $items->filter(fn($i) => $i->avg_price == $items->min('avg_price')))
            ->flatten()->count();

        return response()->json([
            'priceDecrease'   => ['percent' => $decrease->percent_change, 'commodity' => $decrease->nama_pangan],
            'priceIncrease'   => ['percent' => $increase->percent_change, 'commodity' => $increase->nama_pangan],
            'ricePriceStatus' => ['status'  => $riceStatus, 'date' => $date],
            'cheapFoodCount'  => ['total'   => $cheapCount, 'date' => $date],
            'lastUpdated'     => Carbon::now()->toIso8601String(),
            'source'          => 'Dinas Ketahanan Pangan Prov. Banten'
        ]);
    }
}
