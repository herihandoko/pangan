<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\Monetize\UserBankController;
use App\Http\Controllers\Monetize\PayoutController;
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
    Route::get('/phpinfo', function () {
        phpinfo();
    });

    Route::group(['prefix' => 'document'], function () {
        Route::get('/user-files/{path}', [FileController::class, 'getUserFile'])->name('file.user_files.show');
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

    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});
