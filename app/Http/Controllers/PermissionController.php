<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::paginate(4);
        return view('role-permission.Permission.gestionPermession',
            ['permissions'=>$permissions]
        );
    }
    public function store(Request $request)
    {

        $request->validate([
            'name'=>[
                'required',
                'string',
                'unique:permissions,name'
            ]
            ]);

            Permission::create([
                'name' => $request->name
            ]);
            return redirect()->route('admin.gestionPermission')->with('status','Permission Created Successfully');
    }
    public function update(Request $request, string $id)
    {
            
        $validatedData = $request->validate([
            'name'=>[
                'required',
                'string',
                'unique:permissions,name'
            ]
            ]);
            $permission = Permission::findOrFail($id);
            $permission->update($validatedData);
            return redirect()->route('admin.gestionPermission')->with('status','Permission Edited Successfully');
    }

    public function delete(string $id)
    {

    $permission = Permission::findOrFail($id);

    $permission->delete();

    return redirect()->route('admin.gestionPermission')->with('status','Permission Edited Successfully');
    }
}
