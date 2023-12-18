<?php

namespace App\Http\Controllers;

use App\Document;
use App\Http\Requests\StoreInventoryRequest;
use App\Http\Requests\UpdateInventoryRequest;
use App\Inventory;
use App\Model\Category;
use App\Model\Dbinventory;
use App\Model\InventoryHasLanguage;
use App\Model\InventoryHasService;
use App\Model\Language;
use App\Model\StatusAplikasi;
use App\Opd;
use App\Program;
use App\Servers;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;

class InventoryController extends Controller
{
    private $moduleCode = 'application-inventory';

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $this->authorize('viewAny', $this->moduleCode);
        $data['moduleCode'] = $this->moduleCode;
        $data['status'] = $request->status;
        return view('inventory.application.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Inventory $inventory)
    {
        //
        $this->authorize('create', $this->moduleCode);

        $number = Inventory::max('id');
        $desiredLength = 6;
        $data['code'] = 'INV' . date('Ym') . '-' . str_pad($number + 1, $desiredLength, '0', STR_PAD_LEFT);
        $data['moduleCode'] = $this->moduleCode;
        $data['opds'] = Opd::pluck('name', 'id')->prepend('Select OPD', '');
        $data['programs'] = Program::pluck('name', 'code')->prepend('Select Subunit', '');
        $data['categories'] = Category::pluck('name', 'id')->prepend('Select Kategori', '');
        $data['inventory'] = Inventory::pluck('name', 'id')->prepend('Select Aplikasi', '');
        $data['servers'] = Servers::pluck('ip', 'id')->prepend('Select Server', '');
        $data['databases'] = Dbinventory::pluck('name', 'id')->prepend('Select Database', '');
        $data['languages'] = Language::pluck('name', 'id');
        $data['status_app'] = StatusAplikasi::pluck('name', 'name');
        return view('inventory.application.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInventoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInventoryRequest $request, Inventory $inventory)
    {
        $this->authorize('create', $this->moduleCode);
        $inventory->code = $request->code;
        $inventory->name = $request->name;
        $inventory->version = $request->version;
        $inventory->user_base = $request->user_base;
        $inventory->scope = $request->scope;
        $inventory->keterangan = $request->description;
        $inventory->opd_id = $request->opd_id;
        $inventory->category_id = $request->category;
        $inventory->url = $request->url;
        $inventory->tahun_anggaran = $request->tahun_anggaran;
        $inventory->created_by = auth()->user()->id;
        $inventory->created_at = date('Y-m-d H:i:s');
        $inventory->status = $request->status;
        $inventory->platform = $request->platform;
        $inventory->manufacturer = $request->manufacturer;
        $inventory->server_id = $request->server_id;
        $inventory->type_hosting = $request->type_hosting;
        $inventory->predecessor_app = $request->predecessor_app;
        $inventory->service_api = $request->service_api;
        $inventory->endpoint_api = $request->endpoint_api;
        $inventory->sub_unit = $request->sub_unit;
        $inventory->harga = $request->harga;
        $inventory->repository = $request->repository;
        $inventory->database = $request->database;
        $inventory->sumber_dana = $request->sumber_dana;
        $inventory->tahun_pembuatan = $request->tahun_pembuatan;
        $inventory->ip_address = $request->ip_address;
        if ($inventory->save()) {
            $docSpd = $request->doc_spd;
            if ($docSpd) {
                $data = [];
                foreach ($docSpd as $key => $value) {
                    if ($value)
                        $data[] = [
                            'inventory_id' => $inventory->id,
                            'inventory' => 'application-spd',
                            'url' => $value,
                            'created_at' => date('Y-m-d H:i:s')
                        ];
                }
                if ($data)
                    Document::insert($data);
            }
            $docKmk = $request->doc_kmk;
            if ($docKmk) {
                $data = [];
                foreach ($docKmk as $key => $value) {
                    if ($value)
                        $data[] = [
                            'inventory_id' => $inventory->id,
                            'inventory' => 'application-kmk',
                            'url' => $value,
                            'created_at' => date('Y-m-d H:i:s')
                        ];
                }
                if ($data)
                    Document::insert($data);
            }
            $docProbis = $request->doc_probis;
            if ($docProbis) {
                $data = [];
                foreach ($docProbis as $key => $value) {
                    if ($value)
                        $data[] = [
                            'inventory_id' => $inventory->id,
                            'inventory' => 'application-probis',
                            'url' => $value,
                            'created_at' => date('Y-m-d H:i:s')
                        ];
                }
                if ($data)
                    Document::insert($data);
            }
            $docManual = $request->doc_manual;
            if ($docManual) {
                $data = [];
                foreach ($docManual as $key => $value) {
                    if ($value)
                        $data[] = [
                            'inventory_id' => $inventory->id,
                            'inventory' => 'application-manual',
                            'url' => $value,
                            'created_at' => date('Y-m-d H:i:s')
                        ];
                }
                if ($data)
                    Document::insert($data);
            }

            $docLanguage = $request->language;
            if ($docLanguage) {
                $data = [];
                foreach ($docLanguage as $key => $value) {
                    if ($value)
                        $data[] = [
                            'inventory_id' => $inventory->id,
                            'language_id' => $value,
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                }
                if ($data)
                    InventoryHasLanguage::insert($data);
            }

            $docService = $request->service_name;
            $docServiceData = $request->service_data;
            if ($docService) {
                $data = [];
                foreach ($docService as $key => $value) {
                    if ($value)
                        $data[] = [
                            'inventory_id' => $inventory->id,
                            'service_name' => $value,
                            'service_data' => $docServiceData[$key],
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                }
                if ($data)
                    InventoryHasService::insert($data);
            }

            return redirect()->route('inventory.application.index')->with('success', 'Tambah Inventory Aplikasi Berhasil.');
        } else {
            return redirect()->route('inventory.application.index')->with('error', 'Tambah Inventory Aplikasi Gagal.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $this->authorize('view', $this->moduleCode);
        $data['application'] = Inventory::with('category', 'opd', 'program')->where('id', $id)->first();
        $data['moduleCode'] = $this->moduleCode;
        $data['documents'] = Document::select('id', 'inventory', 'url')->where('inventory_id', $id)->get();
        return view('inventory.application.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $this->authorize('update', $this->moduleCode);
        $number = Inventory::max('id');
        $desiredLength = 6;
        $data['application'] = Inventory::find($id);
        $data['code'] = 'INV' . date('Ym') . '-' . str_pad($number + 1, $desiredLength, '0', STR_PAD_LEFT);
        $data['moduleCode'] = $this->moduleCode;
        $data['opds'] = Opd::pluck('name', 'id')->prepend('Select OPD', '');
        $data['programs'] = Program::pluck('name', 'code')->prepend('Select Subunit', '');
        $data['categories'] = Category::pluck('name', 'id')->prepend('Select Kategori', '');
        $data['inventory'] = Inventory::pluck('name', 'id')->prepend('Select Aplikasi', '');
        $data['documents'] = Document::select('id', 'inventory', 'url')->where('inventory_id', $id)->get();
        $data['servers'] = Servers::pluck('ip', 'id')->prepend('Select Server', '');
        $data['databases'] = Dbinventory::pluck('name', 'id')->prepend('Select Database', '');
        $data['languages'] = Language::pluck('name', 'id');
        $data['language'] = InventoryHasLanguage::select('language_id')->where('inventory_id', $id)->pluck('language_id');
        $data['status_app'] = StatusAplikasi::pluck('name', 'name');
        $data['services'] = InventoryHasService::where('inventory_id', $id)->get();
        return view('inventory.application.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInventoryRequest  $request
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInventoryRequest $request)
    {
        //
        $this->authorize('update', $this->moduleCode);
        $inventory = Inventory::find($request->id);
        $inventory->code = $request->code;
        $inventory->name = $request->name;
        $inventory->version = $request->version;
        $inventory->user_base = $request->user_base;
        $inventory->scope = $request->scope;
        $inventory->keterangan = $request->description;
        $inventory->opd_id = $request->opd_id;
        $inventory->category_id = $request->category;
        $inventory->url = $request->url;
        $inventory->tahun_anggaran = $request->tahun_anggaran;
        $inventory->updated_by = auth()->user()->id;
        $inventory->updated_at = date('Y-m-d H:i:s');
        $inventory->status = $request->status;
        $inventory->platform = $request->platform;
        $inventory->manufacturer = $request->manufacturer;
        $inventory->server_id = $request->server_id;
        $inventory->type_hosting = $request->type_hosting;
        $inventory->predecessor_app = $request->predecessor_app;
        $inventory->service_api = $request->service_api;
        $inventory->endpoint_api = $request->endpoint_api;
        $inventory->sub_unit = $request->sub_unit;
        $inventory->database = $request->database;
        $inventory->harga = $request->harga;
        $inventory->repository = $request->repository;
        $inventory->sumber_dana = $request->sumber_dana;
        $inventory->tahun_pembuatan = $request->tahun_pembuatan;
        $inventory->ip_address = $request->ip_address;
        if ($inventory->save()) {
            Document::where('inventory_id', $inventory->id)->delete();
            InventoryHasLanguage::where('inventory_id', $inventory->id)->delete();
            InventoryHasService::where('inventory_id', $inventory->id)->delete();
            $docSpd = $request->doc_spd;
            if ($docSpd) {
                $data = [];
                foreach ($docSpd as $key => $value) {
                    if ($value)
                        $data[] = [
                            'inventory_id' => $inventory->id,
                            'inventory' => 'application-spd',
                            'url' => $value,
                            'created_at' => date('Y-m-d H:i:s')
                        ];
                }
                if ($data)
                    Document::insert($data);
            }
            $docKmk = $request->doc_kmk;
            if ($docKmk) {
                $data = [];
                foreach ($docKmk as $key => $value) {
                    if ($value)
                        $data[] = [
                            'inventory_id' => $inventory->id,
                            'inventory' => 'application-kmk',
                            'url' => $value,
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                }
                if ($data)
                    Document::insert($data);
            }
            $docProbis = $request->doc_probis;
            if ($docProbis) {
                $data = [];
                foreach ($docProbis as $key => $value) {
                    if ($value)
                        $data[] = [
                            'inventory_id' => $inventory->id,
                            'inventory' => 'application-probis',
                            'url' => $value,
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                }
                if ($data)
                    Document::insert($data);
            }
            $docManual = $request->doc_manual;
            if ($docManual) {
                $data = [];
                foreach ($docManual as $key => $value) {
                    if ($value)
                        $data[] = [
                            'inventory_id' => $inventory->id,
                            'inventory' => 'application-manual',
                            'url' => $value,
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                }
                if ($data)
                    Document::insert($data);
            }

            $docLanguage = $request->language;
            if ($docLanguage) {
                $data = [];
                foreach ($docLanguage as $key => $value) {
                    if ($value)
                        $data[] = [
                            'inventory_id' => $inventory->id,
                            'language_id' => $value,
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                }
                if ($data)
                    InventoryHasLanguage::insert($data);
            }

            $docService = $request->service_name;
            $docServiceData = $request->service_data;
            if ($docService) {
                $data = [];
                foreach ($docService as $key => $value) {
                    if ($value)
                        $data[] = [
                            'inventory_id' => $inventory->id,
                            'service_name' => $value,
                            'service_data' => $docServiceData[$key],
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                }
                if ($data)
                    InventoryHasService::insert($data);
            }

            return redirect()->route('inventory.application.index')->with('success', 'Ubah Inventory Aplikasi Berhasil.');
        } else {
            return redirect()->route('inventory.application.index')->with('error', 'Ubah Inventory Aplikasi Gagal.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request): JsonResponse
    {
        //
        $this->authorize('delete', $this->moduleCode);
        $model = Inventory::find($request->id);
        $model->delete();
        return response()->json(['success' => true]);
    }


    public function fetch(Request $request): JsonResponse
    {
        $user = auth()->user();
        $status = $request->status;
        $data = Inventory::select('id', 'code', 'name', 'version', 'scope', 'category_id', 'platform', 'tahun_anggaran', 'status', 'type_hosting', 'manufacturer', 'opd_id', 'url', 'ip_address','tahun_pembuatan')
            ->with('category', 'opd');
        if ($status)
            $data->where('status', $status);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                if ($row->status == 'active') {
                    return '<i class="fa fa-fw fa-circle text-success"></i>';
                } else {
                    return '<i class="fa fa-fw fa-circle text-danger"></i>';
                }
            })
            ->addColumn('category', function ($row) {
                return $row->category->name ?? '-';
            })
            ->addColumn('url', function ($row) {
                return '<a href="https://'.$row->url.'" target="_blank">'.$row->url.'</a>' ?? '-';
            })
            ->addColumn('opd', function ($row) {
                return $row->opd->name ?? '-';
            })
            ->addColumn('action', function ($row) use ($user) {
                $btn = '<a href="' . route('inventory.application.show', $row->id) . '" data-toggle="tooltip" data-original-title="View" class="btn btn-xs btn-icon btn-circle btn-success btn-action-view"><i class="fa fa-eye"></i></a> ';
                if ($user->can('edit', $this->moduleCode) == 1) {
                    $btn .= '<a href="' . route('inventory.application.edit', $row->id) . '" data-toggle="tooltip" data-original-title="Edit" class="btn btn-xs btn-icon btn-circle btn-warning btn-action-edit"><i class="fa fa-pencil"></i></a> ';
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
                        $w->orWhere('name', 'LIKE', "%" . Str::lower($search['value']) . "%");
                    });
                }
            })
            ->rawColumns(['action', 'status', 'category', 'opd','url'])
            ->make(true);
    }
}
