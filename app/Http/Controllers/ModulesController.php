<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Modules;
use DataTables;
use Auth;

class ModulesController extends Controller
{

    public $listing_cols = ['id', 'name', 'label', 'fa_icon', 'url', 'code'];
    private $moduleCode = 'modules';
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index()
    {
        $this->authorize('view', $this->moduleCode);
        return View('settings.modules.index', [
            'moduleCode' => $this->moduleCode
        ]);
    }

    public function fetch(Request $request)
    {
        $user = Auth::user();
        $data = Modules::select($this->listing_cols)->whereNull('deleted_at');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) use ($user) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="btn btn-xs btn-icon btn-circle btn-success btn-action-view"><i class="fa fa-eye"></i></a> ';
                if ($user->can('edit', $this->moduleCode) == 1) {
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="btn btn-xs btn-icon btn-circle btn-warning btn-action-edit"><i class="fas fa-pencil-alt"></i></a> ';
                }
                if ($user->can('delete', $this->moduleCode) == 1) {
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-xs btn-icon btn-circle btn-danger btn-action-delete"><i class="fa fa-trash"></i></a>';
                }
                return $btn;
            })
            ->addColumn('icons', function ($row) {

                return '<i class="' . $row->fa_icon . '"></i>';
            })
            ->rawColumns(['action', 'icons'])
            ->make(true);
    }

    public function destroy(Request $request, Modules $user)
    {
        $this->authorize('delete', $this->moduleCode);
        Modules::find($request->id)->delete();
        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $this->authorize('edit', $this->moduleCode);
        $Modules = Modules::find($id);
        return response()->json($Modules);
    }

    public function update(Request $request, Modules $user)
    {
        $this->authorize('edit', $this->moduleCode);
        $field = [
            'name' => ['required', 'string', 'max:255'],
            'label' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255', 'unique:modules,code,' . $request->id],
            'fa_icon' => ['required', 'string'],
            'url' => ['required', 'string'],
        ];

        $dataUpdate = [
            'name' => $request->name,
            'label' => $request->label,
            'url' => $request->url,
            'fa_icon' => $request->fa_icon
        ];

        $validator = \Validator::make($request->all(), $field);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->toArray()
            ], 422);
        }

        Modules::where('id', $request->id)->update($dataUpdate);
        return response()->json([
            'success' => true,
            'message' => 'Update user success'
        ]);
    }

    public function store(Request $request, Modules $modules)
    {
        $this->authorize('create', $this->moduleCode);
        $validator = \Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'label' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255', 'unique:modules'],
            'fa_icon' => ['required', 'string'],
            'url' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->toArray()
            ], 422);
        }
        $modules->storeData($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Add module success'
        ]);
    }
}
