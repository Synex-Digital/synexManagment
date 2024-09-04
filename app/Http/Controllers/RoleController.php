<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        $all_permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        $users = User::get();
        return view('dashboard.role.index',[
            'roles' => $roles,
            'all_permissions' => $all_permissions,
            'permission_groups' => $permission_groups,
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|unique:roles,name',
            ]);


        if ($validator->fails()) {
            $errors = $validator->errors();
            foreach ($errors->messages() as  $messages) {
                foreach ($messages as $message) {
                    flash()->options([
                        'position' => 'bottom-right',
                    ])->error($message);
                }
            }
            return back()->withErrors($validator)->withInput();
        }
        $permissions = $request->input('permissions');
        if (!empty($permissions)) {
            // Process Data
            $role = Role::create(['name' => $request->name, 'guard_name' => 'web']);
            $role->syncPermissions($permissions);
            flash()->options(['position' => 'bottom-right'])->success('Role Created Successfully');
            return back();
        }
        else{
            return back()->with('error','Select Permissions !!');
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        $role->syncPermissions([]);
        $role->delete();
        flash()->options(['position' => 'bottom-right'])->success('Role Deleted Successfully');
        return back();
        // $user = User::find($id);
        // $user->syncRoles([]);
        // $user->syncPermissions([]);
        // $user->delete();
        // flash()->options(['position' => 'bottom-right'])->success('User Deleted Successfully');
        // return back();
    }

    public function roleAssign_store(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id'=>'required',
            'role_id'=>'required',
            ]);


        if ($validator->fails()) {
            $errors = $validator->errors();
            foreach ($errors->messages() as  $messages) {
                foreach ($messages as $message) {
                    flash()->options([
                        'position' => 'bottom-right',
                    ])->error($message);
                }
            }
            return back()->withErrors($validator)->withInput();
        }
        $user = User::find($request->user_id);
        $user->assignRole($request->role_id);
        flash()->options(['position' => 'bottom-right'])->success('Role Assigned Successfully');
        return back();
    }
    public function userRole_delete($id){
        $user = User::find($id);
        $user->roles()->detach();
        $user->permissions()->detach();
        flash()->options(['position' => 'bottom-right'])->success('User(Role) Deleted Successfully');
        return back();
    }

}
