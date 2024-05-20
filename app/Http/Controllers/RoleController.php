<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::get();
        return view('role-permission.roles.gestionRole',
            ['roles'=>$roles]
        );
    }
    public function store(Request $request)
    {

        $request->validate([
            'name'=>[
                'required',
                'string',
                'unique:roles,name'
            ]
            ]);

            Role::create([
                'name' => $request->name
            ]);
            return redirect()->route('admin.gestionRole')->with('status','Role Created Successfully');
    }
    public function update(Request $request, string $id)
    {
            
        $validatedData = $request->validate([
            'name'=>[
                'required',
                'string',
                'unique:roles,name'
            ]
            ]);
            $role = Role::findOrFail($id);
            $role->update($validatedData);
            return redirect()->route('admin.gestionRole')->with('status','Role Edited Successfully');
    }

    public function delete(string $id)
    {

    $role = Role::findOrFail($id);

    $role->delete();

    return redirect()->route('admin.gestionRole')->with('status','Role Edited Successfully');
    }
    public function addPermissionToRole(string $id)
    {
        $permissions = Permission::get();
        $role = Role::findOrFail($id);
        $rolePermissions = DB::table('role_has_permissions')
                                ->where('role_has_permissions.role_id',$role->id)
                                ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                                ->all();
        return view('role-permission.roles.add-permissions',[
            'role'=>$role,
            'permissions'=>$permissions,
            'rolePermissions'=>$rolePermissions
        ]);
    }
    public function givePermissionToRole(Request $request, string $id)
    {
        
        $role = Role::findOrFail($id);
        $role->syncPermissions($request->permission);
        return redirect()->route('admin.gestionRole');
    }
}   
