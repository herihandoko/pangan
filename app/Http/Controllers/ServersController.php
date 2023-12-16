<?php

namespace App\Http\Controllers;

use App\Hardware;
use App\Servers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Auth;
use DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class ServersController extends Controller
{
    private $moduleCode = 'servers';

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $this->authorize('viewAny', $this->moduleCode);
        $data['moduleCode'] = $this->moduleCode;
        return view('master.servers.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        //
        $this->authorize('create', $this->moduleCode);
        $data['moduleCode'] = $this->moduleCode;
        $data['hardware'] = Hardware::pluck('inventory_tag', 'id')->prepend('Select Hardware', '');
        return view('master.servers.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        //
        $this->authorize('create', $this->moduleCode);
        $validator = Validator::make($request->all(), [
            'ip' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $model = new Servers();
        $model->type = $request->type;
        $model->ip = $request->ip;
        $model->id_hardware = $request->id_hardware;
        $model->hdd = $request->hdd;
        $model->ram = $request->ram;
        $model->cpu = $request->cpu;
        $model->status = $request->status;
        $model->service = $request->service;
        $model->created_at = date('Y-m-d H:i:s');
        $model->save();
        return redirect()->route('master.servers.index')->with('success', 'Tambah Kategori Berhasil.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        //
        $this->authorize('view', $this->moduleCode);
        $data['servers'] = Servers::with('hardware')->where('id', $id)->first();
        return view('master.servers.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        //
        $this->authorize('update', $this->moduleCode);
        $data['servers'] = Servers::find($id);
        $data['hardware'] = Hardware::pluck('inventory_tag', 'id')->prepend('Select Hardware', '');
        return view('master.servers.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request): RedirectResponse
    {
        //
        $this->authorize('update', $this->moduleCode);
        $validator = Validator::make($request->all(), [
            'ip' => 'required|max:255|unique:servers,ip,' . $request->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $model = Servers::find($request->id);
        $model->type = $request->type;
        $model->ip = $request->ip;
        $model->id_hardware = $request->id_hardware;
        $model->hdd = $request->hdd;
        $model->ram = $request->ram;
        $model->cpu = $request->cpu;
        $model->status = $request->status;
        $model->service = $request->service;
        $model->updated_at = date('Y-m-d H:i:s');
        $model->save();
        return redirect()->route('master.servers.index')->with('success', 'Update Server Berhasil.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request): JsonResponse
    {
        //
        $this->authorize('delete', $this->moduleCode);
        $model = Servers::find($request->id);
        $model->delete();
        return response()->json(['success' => true]);
    }

    public function fetch(Request $request): JsonResponse
    {
        $this->authorize('viewAny', $this->moduleCode);
        $user = Auth::user();
        $data = Servers::with('hardware');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('hardware', function ($row) {
                return $row->hardware->inventory_tag;
            })
            ->addColumn('status', function ($row) {
                if ($row->status == 'active') {
                    return '<i class="fa fa-fw fa-circle text-success"></i>';
                } else {
                    return '<i class="fa fa-fw fa-circle text-danger"></i>';
                }
            })
            ->addColumn('action', function ($row) use ($user) {
                $btn = '<a href="' . route('master.servers.show', $row->id) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="btn btn-xs btn-icon btn-circle btn-success btn-action-view"><i class="fa fa-eye"></i></a> ';
                if ($user->can('edit', $this->moduleCode) == 1) {
                    $btn .= '<a href="' . route('master.servers.edit', $row->id) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="btn btn-xs btn-icon btn-circle btn-warning btn-action-edit"><i class="fa fa-pencil"></i></a> ';
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
                        $w->orWhere('ip', 'LIKE', "%" . Str::lower($search['value']) . "%");
                    });
                }
            })
            ->rawColumns(['action', 'status', 'hardware'])
            ->make(true);
    }
}
