<?php

use App\Http\Controllers\FileController;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Route;
use App\Model\User;
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

Route::get('/', 'HomeController@index');
Route::get('appredirect/{key}', function ($key) {
    $fromKey = base64_decode(env('PORTAL_KEY'));
    $encrypterFrom = new Encrypter($fromKey, env('PORTAL_CIPHER'));
    $user_email = $encrypterFrom->decryptString($key);
    $user = User::where('email', $user_email)->first();
    if (Auth::check()) {
        Auth::logout();
    }
    if ($user) {
        Auth::login($user);
    }
    return redirect('/');
});
Auth::routes();
Route::group(['middleware' => ['user.check', 'auth', 'web']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/home/application-cost', 'HomeController@costapp')->name('home.costapp');
    Route::get('/home/appliaction-status', 'HomeController@stsapp')->name('home.stsapp');
    Route::get('/home/appliaction-opd', 'HomeController@opdapp')->name('home.opdapp');
    Route::get('/phpinfo', function () {
        phpinfo();
    });

    Route::group(['prefix' => 'document'], function () {
        Route::get('/user-files/{path}', [FileController::class, 'getUserFile'])->name('file.user_files.show');
    });

    Route::group(['prefix' => 'inventory'], function () {
        Route::get('application', 'InventoryController@index')->name('inventory.application.index');
        Route::get('application/fetch', 'InventoryController@fetch')->name('inventory.application.fetch');
        Route::get('application/create', 'InventoryController@create')->name('inventory.application.create');
        Route::get('application/{id}/edit', 'InventoryController@edit')->name('inventory.application.edit');
        Route::get('application/{id}/show', 'InventoryController@show')->name('inventory.application.show');
        Route::post('application/store', 'InventoryController@store')->name('inventory.application.store');
        Route::put('application/update', 'InventoryController@update')->name('inventory.application.update');
        Route::delete('application/destroy', 'InventoryController@destroy')->name('inventory.application.destroy');

        Route::get('hardware', 'HardwareController@index')->name('inventory.hardware.index');
        Route::get('hardware/fetch', 'HardwareController@fetch')->name('inventory.hardware.fetch');
        Route::get('hardware/create', 'HardwareController@create')->name('inventory.hardware.create');
        Route::get('hardware/{id}/edit', 'HardwareController@edit')->name('inventory.hardware.edit');
        Route::get('hardware/{id}/show', 'HardwareController@show')->name('inventory.hardware.show');
        Route::post('hardware/store', 'HardwareController@store')->name('inventory.hardware.store');
        Route::put('hardware/update', 'HardwareController@update')->name('inventory.hardware.update');
        Route::delete('hardware/destroy', 'HardwareController@destroy')->name('inventory.hardware.destroy');
    });

    Route::group(['prefix' => 'master'], function () {
        Route::get('category', 'CategoryController@index')->name('master.category.index');
        Route::get('category/fetch', 'CategoryController@fetch')->name('master.category.fetch');
        Route::get('category/create', 'CategoryController@create')->name('master.category.create');
        Route::get('category/{id}/edit', 'CategoryController@edit')->name('master.category.edit');
        Route::get('category/{id}/show', 'CategoryController@show')->name('master.category.show');
        Route::post('category/store', 'CategoryController@store')->name('master.category.store');
        Route::put('category/update', 'CategoryController@update')->name('master.category.update');
        Route::delete('category/destroy', 'CategoryController@destroy')->name('master.category.destroy');

        Route::get('opd', 'OpdController@index')->name('master.opd.index');
        Route::get('opd/fetch', 'OpdController@fetch')->name('master.opd.fetch');
        Route::get('opd/create', 'OpdController@create')->name('master.opd.create');
        Route::get('opd/{id}/edit', 'OpdController@edit')->name('master.opd.edit');
        Route::get('opd/{id}/show', 'OpdController@show')->name('master.opd.show');
        Route::post('opd/store', 'OpdController@store')->name('master.opd.store');
        Route::put('opd/update', 'OpdController@update')->name('master.opd.update');
        Route::delete('opd/destroy', 'OpdController@destroy')->name('master.opd.destroy');

        Route::get('sub-unit', 'ProgramController@index')->name('master.sub-unit.index');
        Route::get('sub-unit/fetch', 'ProgramController@fetch')->name('master.sub-unit.fetch');
        Route::get('sub-unit/create', 'ProgramController@create')->name('master.sub-unit.create');
        Route::get('sub-unit/{id}/edit', 'ProgramController@edit')->name('master.sub-unit.edit');
        Route::get('sub-unit/{id}/show', 'ProgramController@show')->name('master.sub-unit.show');
        Route::post('sub-unit/store', 'ProgramController@store')->name('master.sub-unit.store');
        Route::put('sub-unit/update', 'ProgramController@update')->name('master.sub-unit.update');
        Route::delete('sub-unit/destroy', 'ProgramController@destroy')->name('master.sub-unit.destroy');

        Route::get('database', 'DatabaseController@index')->name('master.database.index');
        Route::get('database/fetch', 'DatabaseController@fetch')->name('master.database.fetch');
        Route::get('database/create', 'DatabaseController@create')->name('master.database.create');
        Route::get('database/{id}/edit', 'DatabaseController@edit')->name('master.database.edit');
        Route::get('database/{id}/show', 'DatabaseController@show')->name('master.database.show');
        Route::post('database/store', 'DatabaseController@store')->name('master.database.store');
        Route::put('database/update', 'DatabaseController@update')->name('master.database.update');
        Route::delete('database/destroy', 'DatabaseController@destroy')->name('master.database.destroy');

        Route::get('servers', 'ServersController@index')->name('master.servers.index');
        Route::get('servers/fetch', 'ServersController@fetch')->name('master.servers.fetch');
        Route::get('servers/create', 'ServersController@create')->name('master.servers.create');
        Route::get('servers/{id}/edit', 'ServersController@edit')->name('master.servers.edit');
        Route::get('servers/{id}/show', 'ServersController@show')->name('master.servers.show');
        Route::post('servers/store', 'ServersController@store')->name('master.servers.store');
        Route::put('servers/update', 'ServersController@update')->name('master.servers.update');
        Route::delete('servers/destroy', 'ServersController@destroy')->name('master.servers.destroy');

        Route::resource('komoditas', KomoditasController::class)->parameters([
            'komoditas' => 'komoditas',
        ]);;
        Route::resource('administrasi', AdministrasiController::class);
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('users', 'UsersController@index')->name('settings.users.index');
        Route::get('users/fetch', 'UsersController@fetch')->name('settings.users.fetch');
        Route::get('users/{id}/edit', 'UsersController@edit')->name('settings.users.edit');
        Route::get('users/{id}/show', 'UsersController@show')->name('settings.users.show');
        Route::post('users/store', 'UsersController@store')->name('settings.users.store');
        Route::post('users/update', 'UsersController@update')->name('settings.users.update');
        Route::post('users/biodata', 'UsersController@biodata')->name('settings.users.biodata');
        Route::put('users/editpass', 'UsersController@editpass')->name('settings.users.editpass');
        Route::get('users/profile', 'UsersController@profile')->name('settings.users.profile');
        Route::post('users/avatar', 'UsersController@avatar')->name('settings.users.avatar');
        Route::post('users/login', 'UsersController@login')->name('settings.users.login');
        Route::delete('users/destroy', 'UsersController@destroy')->name('settings.users.destroy');

        Route::get('roles', 'RolesController@index')->name('settings.roles.index');
        Route::get('roles/create', 'RolesController@create')->name('settings.roles.create');
        Route::get('roles/fetch', 'RolesController@fetch')->name('settings.roles.fetch');
        Route::get('roles/{id}/edit', 'RolesController@edit')->name('settings.roles.edit');
        Route::get('roles/{id}/show', 'RolesController@show')->name('settings.roles.show');
        Route::post('roles/store', 'RolesController@store')->name('settings.roles.store');
        Route::post('roles/update', 'RolesController@update')->name('settings.roles.update');
        Route::post('roles/save', 'RolesController@save')->name('settings.roles.save');
        Route::delete('roles/destroy', 'RolesController@destroy')->name('settings.roles.destroy');

        Route::get('modules', 'ModulesController@index')->name('settings.modules.index');
        Route::get('modules/fetch', 'ModulesController@fetch')->name('settings.modules.fetch');
        Route::get('modules/{id}/edit', 'ModulesController@edit')->name('settings.modules.edit');
        Route::get('modules/{id}/show', 'ModulesController@show')->name('settings.modules.show');
        Route::post('modules/store', 'ModulesController@store')->name('settings.modules.store');
        Route::post('modules/update', 'ModulesController@update')->name('settings.modules.update');
        Route::delete('modules/destroy', 'ModulesController@destroy')->name('settings.modules.destroy');

        Route::get('menus', 'MenusController@index')->name('settings.menus.index');
        Route::put('menus/update', 'MenusController@update')->name('settings.menus.update');
        Route::post('menus/store', 'MenusController@store')->name('settings.menus.store');
        Route::delete('menus/destroy/{id}', 'MenusController@destroy')->name('settings.menus.destroy');

        Route::get('configs', 'ConfigsController@index')->name('settings.configs.index');
        Route::post('configs/store', 'ConfigsController@store')->name('settings.configs.store');
    });

    Route::get('gallery', 'GalleryController@index')->name('gallery');
    Route::resource('harga-komoditas-harian', HargaKomoditasHarianKabkotaController::class);
    Route::get('data-komoditas/upload', 'HargaKomoditasHarianKabkotaController@upload')->name('data-komoditas.upload');
    Route::post('data-komoditas/import', 'HargaKomoditasHarianKabkotaController@import')->name('data-komoditas.import');

    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});
