<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('admin/home');
})->name('start');

Route::get('/admin', function () {
    return redirect('admin/home');
});
Route::get('/home', function () {
    return redirect('admin/home');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('permissions', 'Admin\PermissionsController',['only' => [
    'index', 'create', 'store', 'edit', 'update'
    ]])
    ->middleware('can:permissions_manage');

    Route::resource('roles', 'Admin\RolesController',['only' => [
    'index', 'create', 'store', 'edit', 'update'
    ]])
    ->middleware('can:roles_manage');

    Route::resource('users', 'Admin\UsersController',['only' => [
    'index', 'create', 'store', 'edit', 'update'
    ]])
    ->middleware('can:users_manage');

    Route::resource('menus', 'Admin\MenusController',['only' => [
    'index', 'create', 'store', 'edit', 'update'
    ]])
    ->middleware('can:menus_manage');

    Route::get('panel/account', 'Admin\PanelController@account')->name('panel.account');
    Route::post('panel/account', 'Admin\PanelController@update')->name('panel.update');

    Route::get('panel/account', 'Admin\PanelController@account')->name('panel.account');
    Route::post('panel/account', 'Admin\PanelController@update')->name('panel.update');
    Route::get('panel/change_password', 'Admin\PanelController@change_password')->name('panel.change_password');
    Route::post('panel/change_password', 'Admin\PanelController@change_passwd')->name('panel.change_passwd');

});
