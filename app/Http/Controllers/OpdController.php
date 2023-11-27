<?php

namespace App\Http\Controllers;

use App\Opd;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Auth;
use DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class OpdController extends Controller
{
    private $moduleCode = 'opd';

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
        return view('master.opd.index', compact('data'));
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
        return view('master.opd.create', compact('data'));
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
            'name' => 'required|max:255',
            'code' => 'required|unique:opds|max:150',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $model = new Opd();
        $model->code = $request->code;
        $model->name = $request->name;
        $model->created_at = date('Y-m-d H:i:s');
        $model->save();
        return redirect()->route('master.opd.index')->with('success', 'Tambah OPD Berhasil.');
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
        $opd = Opd::find($id);
        return view('master.opd.show', compact('opd'));
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
        $opd = Opd::find($id);
        return view('master.opd.edit', compact('opd'));
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
            'name' => 'required|max:255',
            'code' => 'required|max:150|unique:opds,code,' . $request->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $model = Opd::find($request->id);
        $model->name = $request->name;
        $model->code = $request->code;
        $model->updated_at = date('Y-m-d H:i:s');
        $model->save();
        return redirect()->route('master.opd.index')->with('success', 'Update Kaetegori Berhasil.');
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
        $model = Opd::find($request->id);
        $model->delete();
        return response()->json(['success' => true]);
    }

    public function fetch(Request $request): JsonResponse
    {
        $this->authorize('viewAny', $this->moduleCode);
        $user = Auth::user();
        $data = Opd::select('id', 'name', 'code');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) use ($user) {
                $btn = '<a href="' . route('master.opd.show', $row->id) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="btn btn-xs btn-icon btn-circle btn-success btn-action-view"><i class="fa fa-eye"></i></a> ';
                if ($user->can('edit', $this->moduleCode) == 1) {
                    $btn .= '<a href="' . route('master.opd.edit', $row->id) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="btn btn-xs btn-icon btn-circle btn-warning btn-action-edit"><i class="fa fa-pencil"></i></a> ';
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
            ->rawColumns(['action'])
            ->make(true);
    }
}
