<?php

use App\Http\Controllers\AdministrasiController;
use App\Http\Controllers\ConfigsController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HargaKomoditasHarianKabkotaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KomoditasController;
use App\Http\Controllers\MenusController;
use App\Http\Controllers\ModulesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Route;
use App\Model\User;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'index']);
Auth::routes();
Route::group(['middleware' => ['user.check', 'auth', 'web']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::group(['prefix' => 'master'], function () {
        Route::resource('komoditas', KomoditasController::class)->parameters([
            'komoditas' => 'komoditas',
        ]);;
        Route::resource('administrasi', AdministrasiController::class);
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('users', [UsersController::class, 'index'])->name('settings.users.index');
        Route::get('users/fetch', [UsersController::class, 'fetch'])->name('settings.users.fetch');
        Route::get('users/{id}/edit', [UsersController::class, 'edit'])->name('settings.users.edit');
        Route::get('users/{id}/show', [UsersController::class, 'show'])->name('settings.users.show');
        Route::post('users/store', [UsersController::class, 'store'])->name('settings.users.store');
        Route::post('users/update', [UsersController::class, 'update'])->name('settings.users.update');
        Route::post('users/biodata', [UsersController::class, 'biodata'])->name('settings.users.biodata');
        Route::put('users/editpass', [UsersController::class, 'editpass'])->name('settings.users.editpass');
        Route::get('users/profile', [UsersController::class, 'profile'])->name('settings.users.profile');
        Route::post('users/avatar', [UsersController::class, 'avatar'])->name('settings.users.avatar');
        Route::post('users/login', [UsersController::class, 'login'])->name('settings.users.login');
        Route::delete('users/destroy', [UsersController::class, 'destroy'])->name('settings.users.destroy');

        Route::get('roles', [RolesController::class, 'index'])->name('settings.roles.index');
        Route::get('roles/create', [RolesController::class, 'create'])->name('settings.roles.create');
        Route::get('roles/fetch', [RolesController::class, 'fetch'])->name('settings.roles.fetch');
        Route::get('roles/{id}/edit', [RolesController::class, 'edit'])->name('settings.roles.edit');
        Route::get('roles/{id}/show', [RolesController::class, 'show'])->name('settings.roles.show');
        Route::post('roles/store', [RolesController::class, 'store'])->name('settings.roles.store');
        Route::post('roles/update', [RolesController::class, 'update'])->name('settings.roles.update');
        Route::post('roles/save', [RolesController::class, 'save'])->name('settings.roles.save');
        Route::delete('roles/destroy', [RolesController::class, 'destroy'])->name('settings.roles.destroy');

        Route::get('modules', [ModulesController::class, 'index'])->name('settings.modules.index');
        Route::get('modules/fetch', [ModulesController::class, 'fetch'])->name('settings.modules.fetch');
        Route::get('modules/{id}/edit', [ModulesController::class, 'edit'])->name('settings.modules.edit');
        Route::get('modules/{id}/show', [ModulesController::class, 'show'])->name('settings.modules.show');
        Route::post('modules/store', [ModulesController::class, 'store'])->name('settings.modules.store');
        Route::post('modules/update', [ModulesController::class, 'update'])->name('settings.modules.update');
        Route::delete('modules/destroy', [ModulesController::class, 'destroy'])->name('settings.modules.destroy');

        Route::get('menus', [MenusController::class, 'index'])->name('settings.menus.index');
        Route::put('menus/update', [MenusController::class, 'update'])->name('settings.menus.update');
        Route::post('menus/store', [MenusController::class, 'store'])->name('settings.menus.store');
        Route::delete('menus/destroy/{id}', [MenusController::class, 'destroy'])->name('settings.menus.destroy');

        Route::get('configs', [ConfigsController::class, 'index'])->name('settings.configs.index');
        Route::post('configs/store', [ConfigsController::class, 'store'])->name('settings.configs.store');
    });

    Route::resource('harga-komoditas-harian', HargaKomoditasHarianKabkotaController::class);
    Route::get('data-komoditas/upload', [HargaKomoditasHarianKabkotaController::class, 'upload'])->name('data-komoditas.upload');
    Route::post('data-komoditas/import', [HargaKomoditasHarianKabkotaController::class, 'import'])->name('data-komoditas.import');
});
