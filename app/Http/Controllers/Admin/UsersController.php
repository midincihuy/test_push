<?php

namespace App\Http\Controllers\Admin;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\DataTables\UsersDataTable;
use App\User;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if (! Gate::allows('users_manage')) {
          return abort(401);
      }
      $roles = Role::get()->pluck('name', 'name');

      return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsersRequest $request)
    {
      if (! Gate::allows('users_manage')) {
          return abort(401);
      }
      $user = User::create($request->all());
      $roles = $request->input('roles') ? $request->input('roles') : [];
      $user->assignRole($roles);
      $user->api_token = str_random(50);
      $user->save();

      return redirect()->route('admin.users.index');
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
      if (! Gate::allows('users_manage')) {
          return abort(401);
      }
      $roles = Role::get()->pluck('name', 'name');

      $user = User::findOrFail($id);

      return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersRequest $request, $id)
    {
      if (! Gate::allows('users_manage')) {
          return abort(401);
      }
      $user = User::findOrFail($id);
      $user->update($request->all());
      $roles = $request->input('roles') ? $request->input('roles') : [];
      $user->syncRoles($roles);

      return redirect()->route('admin.users.index');
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
