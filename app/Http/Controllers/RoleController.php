<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;

use App\Models\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    protected $role;

    /**
     * Initialize RoleController.
     *
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    /**
     * Display a listing of roles.
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $roles = $this->role->with('permissions')->get();
        if ($request->ajax()) {
            return $roles;
        }
        return view('user_management.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $permissions = Permission::all();
        dd($permissions);
        return view('user_management.roles.create', compact('permissions'));
    }

    /**
     * Store a new role and associate permissions.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:roles|max:255',
            'permission_ids' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 400, 'errors' => $validator->messages()]);
        }

        DB::beginTransaction();
        try {
            $role = $this->role->create([
                'id' => Str::uuid()->toString(),
                'name' => $request->name,
            ]);

            foreach ($request->permission_ids as $permissionId) {
                RolePermission::create([
                    'role_id' => $role->id,
                    'permission_id' => $permissionId,
                ]);
            }

            DB::commit();
            return response()->json(['status' => 200, 'message' => 'Role created successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 500, 'message' => 'An error occurred']);
        }
    }

    /**
     * Display the form for editing the role.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $role = $this->role->with('permissions')->findOrFail($id);
        $permissions = Permission::all();

        return view('user_management.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update role details and associated permissions.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
            'permission_ids' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 400, 'errors' => $validator->messages()]);
        }

        DB::beginTransaction();
        try {
            $role = $this->role->findOrFail($id);
            $role->update(['name' => $request->name]);

            RolePermission::where('role_id', $role->id)->delete();
            foreach ($request->permission_ids as $permissionId) {
                RolePermission::create([
                    'role_id' => $role->id,
                    'permission_id' => $permissionId,
                ]);
            }

            DB::commit();
            return response()->json(['status' => 200, 'message' => 'Role updated successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 500, 'message' => 'An error occurred']);
        }
    }
}
