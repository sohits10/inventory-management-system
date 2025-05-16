<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    protected $user;

    /**
     * Initialize the UserController with dependencies.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the users with necessary relationships.
     * Optionally loads data via AJAX if requested.
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // Fetch all roles
        $data['roles'] = Role::all();
    
        // Fetch users (with pagination or without, as needed)
        $data['users'] = User::paginate(10);  // This will paginate the users
    
        // If the request is an AJAX request, return the users data with roles attached
        if ($request->ajax()) {
            return $this->user->with('roles')->get();
        }
    
        // Otherwise, return the view with the roles and users data
        return view('user_management.users.index', $data);
    }
    

    /**
     * Show the form for creating a new user.
     * Load available roles and permissions.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        
        return view('user_management.users.create', [
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    /**
     * Store a new user and associate them with roles.
     * Wrap in a transaction for consistency.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8',
            'role_ids' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 400, 'errors' => $validator->messages()]);
        }

        DB::beginTransaction();
        try {
            $user = $this->user->create([
                'id' => Str::uuid()->toString(),
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'created_by' => auth()->id(),
            ]);

            foreach ($request->role_ids as $roleId) {
                UserRole::create([
                    'id' => Str::uuid()->toString(),
                    'user_id' => $user->id,
                    'role_id' => $roleId,
                ]);
            }

            DB::commit();
            return response()->json(['status' => 200, 'message' => 'User created successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 500, 'message' => 'An error occurred']);
        }
    }

    /**
     * Show the form for editing a specific user.
     * Loads user details, roles, and permissions.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = $this->user->with('roles', 'permissions')->findOrFail($id);
        $roles = Role::all();
        $permissions = Permission::all();

        return view('user_management.users.edit', compact('user', 'roles', 'permissions'));
    }

    /**
     * Update a user's details and roles.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role_ids' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 400, 'errors' => $validator->messages()]);
        }

        DB::beginTransaction();
        try {
            $user = $this->user->findOrFail($id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'updated_by' => auth()->id(),
            ]);

            UserRole::where('user_id', $user->id)->delete();
            foreach ($request->role_ids as $roleId) {
                UserRole::create([
                    'id' => Str::uuid()->toString(),
                    'user_id' => $user->id,
                    'role_id' => $roleId,
                ]);
            }

            DB::commit();
            return response()->json(['status' => 200, 'message' => 'User updated successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 500, 'message' => 'An error occurred']);
        }
    }

    /**
     * Deactivate a user.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deactivate($id)
    {
        try {
            $user = $this->user->findOrFail($id);
            $user->update(['status' => 0]);

            return response()->json(['status' => 200, 'message' => 'User deactivated successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => 'An error occurred']);
        }
    }
}
