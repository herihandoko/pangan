<?php

namespace App\Http\Controllers;

use App\Hardware;
use App\Inventory;
use App\Opd;
use App\Traits\ApiTrait;
use Illuminate\Support\Facades\DB;
use DataTables;
use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController extends Controller
{

    use ApiTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $appAll = Inventory::count();
        $appActive = Inventory::where('status', 'active')->count();
        $appInactive = Inventory::where('status', 'inactive')->count();
        $hardware = Hardware::count();
        $onprem = Inventory::where('type_hosting', 'on_prem')->count();
        $hybrid = Inventory::where('type_hosting', 'hybrid')->count();
        $cloud = Inventory::where('type_hosting', 'cloud')->count();
        return view('home', [
            'app_all' => $appAll,
            'app_active' => $appActive,
            'app_inactive' => $appInactive,
            'hardware' => $hardware,
            'hosting_type' => [
                'on_prem' => $onprem,
                'hybrid' => $hybrid,
                'cloud' => $cloud
            ]
        ]);
    }

    public function costapp(): JsonResponse
    {
        $inventories = Inventory::select('name', 'harga')->orderBy('harga', 'desc')->skip(0)->take(10)->get();
        $labels = [];
        $data = [];
        foreach ($inventories as $key => $value) {
            $labels[] = $value->name;
            $data[] = $value->harga;
        }
        return response()->json([
            'success' => true,
            'data' => [
                'labels' => $labels,
                'datasets' => [
                    [
                        'label' => 'Licenses',
                        'data' => $data,
                        'borderWidth' => 1,
                        'borderColor' => '#1a85f2',
                        'backgroundColor' => '#8abcee',
                    ]
                ]
            ]
        ]);
    }

    public function stsapp(): JsonResponse
    {
        $inventories = Inventory::select('status')->get();
        $active = 0;
        $inactive = 0;
        foreach ($inventories as $key => $value) {
            if ($value->status == 'active') {
                $active++;
            } else {
                $inactive++;
            }
        }

        return response()->json([
            'success' => true,
            'data' => [
                'labels' => ['Active', 'In Active'],
                'datasets' => [
                    [
                        'data' => [$active, $inactive],
                        'borderWidth' => 1,
                        'borderColor' => ['#169dab', '#3c444b'],
                        'backgroundColor' => ['#83cdcd', '#81868a'],
                    ]
                ]
            ]
        ]);
    }

    public function opdapp(): JsonResponse
    {
        $data = Opd::select('id', 'code', 'name')->withCount('inventory');
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
}
