<?php

namespace App\Http\Controllers;

use App\Hardware;
use App\Http\Requests\StoreHardwareRequest;
use App\Http\Requests\UpdateHardwareRequest;
use App\Opd;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;
use Faker\Core\Number;

class HardwareController extends Controller
{
    private $moduleCode = 'hardware';

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->authorize('viewAny', $this->moduleCode);
        $data['moduleCode'] = $this->moduleCode;
        return view('inventory.hardware.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->authorize('create', $this->moduleCode);
        $data['moduleCode'] = $this->moduleCode;
        $data['opds'] = Opd::pluck('name', 'id')->prepend('Select OPD', '');
        return view('inventory.hardware.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHardwareRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHardwareRequest $request)
    {
        //
        $this->authorize('create', $this->moduleCode);
        $model = new Hardware();
        $model->type = $request->type;
        $model->inventory_tag = $request->inventory_tag;
        $model->barcode = $request->barcode;
        $model->harga = $request->harga;
        $model->currency = $request->currency;
        $model->manufacturer = $request->manufacturer;
        $model->brand = $request->brand;
        $model->model = $request->model;
        $model->purchase_date = $request->purchase_date;
        $model->waranty_date = $request->waranty_date;
        $model->status = $request->status;
        $model->opd_id = $request->opd_id;
        $model->serial_number = $request->serial_number;
        $model->tahun_anggaran = $request->tahun_anggaran;
        $model->description = $request->description;
        $model->created_at = date('Y-m-d H:i:s');
        $model->save();
        return redirect()->route('inventory.hardware.index')->with('success', 'Tambah Perangkat Keras Berhasil.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hardware  $hardware
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $this->authorize('view', $this->moduleCode);
        $data['moduleCode'] = $this->moduleCode;
        $data['hardware'] = Hardware::with('opd')->where('id', $id)->first();
        return view('inventory.hardware.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hardware  $hardware
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $this->authorize('update', $this->moduleCode);
        $data['moduleCode'] = $this->moduleCode;
        $data['opds'] = Opd::pluck('name', 'id')->prepend('Select OPD', '');
        $data['hardware'] = Hardware::find($id);
        return view('inventory.hardware.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHardwareRequest  $request
     * @param  \App\Hardware  $hardware
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHardwareRequest $request)
    {
        //
        $this->authorize('update', $this->moduleCode);
        $data['moduleCode'] = $this->moduleCode;
        $model = Hardware::find($request->id);
        $model->type = $request->type;
        $model->inventory_tag = $request->inventory_tag;
        $model->barcode = $request->barcode;
        $model->harga = $request->harga;
        $model->currency = $request->currency;
        $model->manufacturer = $request->manufacturer;
        $model->brand = $request->brand;
        $model->model = $request->model;
        $model->purchase_date = $request->purchase_date;
        $model->waranty_date = $request->waranty_date;
        $model->status = $request->status;
        $model->opd_id = $request->opd_id;
        $model->serial_number = $request->serial_number;
        $model->tahun_anggaran = $request->tahun_anggaran;
        $model->description = $request->description;
        $model->updated_at = date('Y-m-d H:i:s');
        $model->save();
        return redirect()->route('inventory.hardware.index')->with('success', 'Edit Perangkat Keras Berhasil.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hardware  $hardware
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $this->authorize('delete', $this->moduleCode);
        $model = Hardware::find($request->id);
        $model->delete();
        return response()->json(['success' => true]);
    }

    public function fetch(Request $request): JsonResponse
    {
        $user = auth()->user();
        $data = Hardware::with('opd');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                if ($row->status == 'active') {
                    return '<i class="fa fa-fw fa-circle text-success"></i>';
                } elseif ($row->status == 'service') {
                    return '<i class="fa fa-fw fa-circle text-warning"></i>';
                } else {
                    return '<i class="fa fa-fw fa-circle text-danger"></i>';
                }
            })
            ->editColumn('type', function ($row) {
                switch ($row->type) {
                    case 'server':
                        $type = 'Server and Data Storage';
                        break;
                    case 'network':
                        $type = 'Network Device';
                        break;
                    case 'safety':
                        $type = 'Safety Device';
                        break;
                    case 'enduser':
                        $type = 'End User';
                        break;
                    default:
                        $type = 'Printer';
                        break;
                }
                return $type;
            })
            ->editColumn('harga', function ($row) {
                return number_format($row->harga, 2);
            })
            ->editColumn('purchase_date', function ($row) {
                return date('d M Y', strtotime($row->purchase_date));
            })
            ->addColumn('status_text', function ($row) {
                return $row->status;
            })
            ->addColumn('opd', function ($row) {
                return $row->opd->name;
            })
            ->addColumn('action', function ($row) use ($user) {
                $btn = '<a href="' . route('inventory.hardware.show', $row->id) . '" data-toggle="tooltip" data-original-title="View" class="btn btn-xs btn-icon btn-circle btn-success btn-action-view"><i class="fa fa-eye"></i></a> ';
                if ($user->can('edit', $this->moduleCode) == 1) {
                    $btn .= '<a href="' . route('inventory.hardware.edit', $row->id) . '" data-toggle="tooltip" data-original-title="Edit" class="btn btn-xs btn-icon btn-circle btn-warning btn-action-edit"><i class="fa fa-pencil"></i></a> ';
                }
                if ($user->can('delete', $this->moduleCode) == 1) {
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-xs btn-icon btn-circle btn-danger btn-action-delete"><i class="fa fa-trash"></i></a>';
                }
                return $btn;
            })
            ->filter(function ($instance) use ($request) {
                if (!empty($request->get('search'))) {
                    $instance->where(function ($w) use ($request) {
                        $search = $request->get('search');
                        $w->orWhere('inventory_tag', 'LIKE', "%" . Str::lower($search['value']) . "%");
                    });
                }
            })
            ->rawColumns(['action', 'status', 'status_text', 'opd'])
            ->make(true);
    }
}
