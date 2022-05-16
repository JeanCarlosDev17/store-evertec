<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleStoreRequest;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
//        $this->middleware('permission: ver-rol | crear-rol | editar-rol | eliminar-rol',['only'=>['index']]);
//        $this->middleware('permission: crear-rol ',['only'=>['create','store']]);
//        $this->middleware('permission: editar-rol ',['only'=>['edit','update']]);
//        $this->middleware('permission:  eliminar-rol',['only'=>['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.roles.index')->with('roles', Role::paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permision = Permission::get();
        return view('admin.role.create')->with('permision', $permision);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleStoreRequest $request)
    {
        $role = Role::create(['name'=>$request->input('name')]);
        $role->syncPermissions($request->input('permission'));
        return redirect()->back()->with('result', 'Rol ha sido generado ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permission = Permission::get();
        $rolePermission = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.role_id')
            ->all();
        return view('admin.roles.edit')
                ->with(['role'=>$role, 'permission'=>$permission, 'rolePermission'=>$rolePermission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleStoreRequest $request, Role $role)
    {
        $role->nombre = $request->name;
        $role->save();
        $role->syncPermissions($request->permission);
        return redirect()->back()->with('result', 'Rol actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('result', 'Rol Eliminado');
    }
}
