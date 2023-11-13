<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Roles;
use DataTables;
use App\Model\Modules;
use DB;
use Auth;
use Illuminate\Validation\Rule;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleCode = 'roles';
    public $listing_cols = ['id', 'name', 'label', 'description'];

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        //
        $this->authorize('view', $this->moduleCode);
        return view('settings.roles.index', [
            'moduleCode' => $this->moduleCode
        ]);
    }

    public function create(Request $request)
    {
        $this->authorize('create', $this->moduleCode);
        $dataRole = Roles::find(0);
        $modules_access = Modules::getRoleAccess(0);
        return View('settings.roles.create', [
            'role' => $dataRole,
            'modules_access' => $modules_access,
            'request' => $request
        ]);
    }

    public function fetch(Request $request)
    {
        $user = Auth::user();
        $data = Roles::select($this->listing_cols);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) use ($user) {
                $btn = '<a href="' . url('settings/roles/' . $row->id) . '/show" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="btn btn-xs btn-icon btn-circle btn-success"><i class="fa fa-eye"></i></a> ';
                if ($user->can('edit', $this->moduleCode) == 1) {
                    $btn .= '<a href="' . url('settings/roles/' . $row->id) . '/edit" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="btn btn-xs btn-icon btn-circle btn-warning"><i class="fa fa-pencil"></i></a> ';
                }
                if ($user->can('delete', $this->moduleCode) == 1) {
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-xs btn-icon btn-circle btn-danger btn-action-delete"><i class="fa fa-trash"></i></a>';
                }
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function destroy(Request $request, Roles $roles)
    {
        $this->authorize('delete', $this->moduleCode);
        Roles::find($request->id)->delete();
        return response()->json(['success' => true]);
    }

    public function edit(Request $request, Roles $roles)
    {
        $this->authorize('edit', $this->moduleCode);
        $dataRole = Roles::find($request->id);
        $modules_access = Modules::getRoleAccess($request->id);
        return view('settings.roles.update', [
            'role' => $dataRole,
            'modules_access' => $modules_access,
            'request' => $request
        ]);
    }

    public function update(Request $request)
    {
        $this->authorize('edit', $this->moduleCode);
        $field = [
            'label' => ['required', 'string', 'max:255'],
            'description' => ['max:1000'],
            'name' => ['required', 'string', 'max:255', Rule::unique('roles')->ignore($request->id)],
        ];

        $validator = \Validator::make($request->all(), $field);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->toArray()
            ], 422);
        }

        Roles::find($request->id)->update([
            'name' => $request->name,
            'label' => $request->label,
            'description' => $request->description
        ], ['id' => $request->id]);

        return response()->json([
            'success' => true,
            'message' => 'Update module success'
        ]);
    }

    public function store(Request $request, Roles $roles)
    {
        $this->authorize('create', $this->moduleCode);
        $validator = \Validator::make($request->all(), [
            'label' => ['required', 'string', 'max:255'],
            'description' => ['max:1000'],
            'name' => ['required', 'string', 'max:255', Rule::unique('roles')->ignore($request->id)],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->toArray()
            ], 422);
        }

        $data = Roles::create([
            'name' => $request->name,
            'label' => $request->label,
            'description' => $request->description,
            'guard_name' => $request->name,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        if ($data->id) {
            return response()->json([
                'success' => true,
                'message' => 'Add user success',
                'id' => $data->id
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Add user failure'
            ]);
        }
    }

    public function show(Request $request, Roles $roles)
    {
        $this->authorize('view', $this->moduleCode);
        $dataRole = Roles::find($request->id);
        $modules_access = Modules::getRoleAccess($request->id);
        return view('settings.roles.detail', [
            'role' => $dataRole,
            'modules_access' => $modules_access,
            'request' => $request
        ]);
    }

    public function save(Request $request, Roles $roles)
    {
        $now = date("Y-m-d H:i:s");
        $id = $request->id;
        $modules_access = Modules::getRoleAccess($id);
        foreach ($modules_access as $module) {
            $module_name = 'module_' . $module->id;
            if (isset($request->$module_name)) {
                $view = 'module_view_' . $module->id;
                $create = 'module_create_' . $module->id;
                $edit = 'module_edit_' . $module->id;
                $delete = 'module_delete_' . $module->id;
                if (isset($request->$view)) {
                    $view = 1;
                } else {
                    $view = 0;
                }
                if (isset($request->$create)) {
                    $create = 1;
                } else {
                    $create = 0;
                }
                if (isset($request->$edit)) {
                    $edit = 1;
                } else {
                    $edit = 0;
                }
                if (isset($request->$delete)) {
                    $delete = 1;
                } else {
                    $delete = 0;
                }

                $query = DB::table('role_module')->where('role_id', $id)->where('module_id', $module->id);
                if ($query->count() == 0) {
                    DB::insert('insert into role_module (role_id, module_id, acc_view, acc_create, acc_edit, acc_delete, created_at, updated_at) values (?, ?, ?, ?, ?, ?, ?, ?)', [$id, $module->id, $view, $create, $edit, $delete, $now, $now]);
                } else {
                    DB::table('role_module')->where('role_id', $id)->where('module_id', $module->id)->update(['acc_view' => $view, 'acc_create' => $create, 'acc_edit' => $edit, 'acc_delete' => $delete]);
                }
            } else {
                DB::table('role_module')->where('role_id', $id)->where('module_id', $module->id)->update(['acc_view' => 0, 'acc_create' => 0, 'acc_edit' => 0, 'acc_delete' => 0]);
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Update module success'
        ]);
    }
}
