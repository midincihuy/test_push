<?php

namespace App\Http\Controllers\Admin;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\RolesDataTable;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Requests\Admin\StoreRolesRequest as Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RolesDataTable $dataTable)
    {
      return $dataTable->render('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $permissions = Permission::get()->pluck('name', 'name');
      return view('admin.roles.create', compact('permissions'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if (! Gate::allows('roles_manage')) {
            return abort(401);
      }
      $role = Role::create($request->except('permission'));
      $permissions = $request->input('permission') ? $request->input('permission') : [];
      $role->givePermissionTo($permissions);

      return redirect()->route('admin.roles.index');
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
    public function edit($id)
    {
      if (! Gate::allows('roles_manage')) {
          return abort(401);
      }
      $permissions = Permission::get()->pluck('name', 'name');

      $role = Role::findOrFail($id);

      return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      if (! Gate::allows('roles_manage')) {
          return abort(401);
      }
      $role = Role::findOrFail($id);
      $role->update($request->except('permission'));
      $permissions = $request->input('permission') ? $request->input('permission') : [];
      $role->syncPermissions($permissions);

      return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
