<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\GeneralController;
use App\Http\Controllers\Backend\SlideController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Backend\OrderController;

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


Route::group(['middleware' => ['role:SuperAdmin','auth'], 'prefix' => 'admin/dashboard',],function () {

    // Route::get('/', [GeneralController::class, 'dashboard'])->name('dashboard');
    Route::get('/', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');

    // Route::resource('users', UserController::class);
    Route::get('users', [UserController::class, 'index'])->name('users.index')->middleware(['can:Read Users']);
    Route::get('user/create', [UserController::class, 'create'])->name('users.create')->middleware(['can:Create Users']);
    Route::post('user/create/save', [UserController::class, 'store'])->name('users.store')->middleware(['can:Create Users']);
    Route::get('user/{id}', [UserController::class, 'show'])->name('users.show')->middleware(['can:Read Users']);
    Route::get('user/{id}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware(['can:Update Users']);
    Route::put('user/{id}/update', [UserController::class, 'update'])->name('users.update')->middleware(['can:Update Users']);
    Route::delete('user/{id}', [UserController::class, 'destroy'])->name('users.destroy')->middleware(['can:Delete Users']);

    // Route::resource('roles', RoleController::class);
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index')->middleware(['can:Read Roles']);
    Route::get('role/create', [RoleController::class, 'create'])->name('roles.create')->middleware(['can:Create Roles']);
    Route::post('role/create/save', [RoleController::class, 'store'])->name('roles.store')->middleware(['can:Create Roles']);
    Route::get('role/{id}', [RoleController::class, 'show'])->name('roles.show')->middleware(['can:Read Roles']);
    Route::get('role/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit')->middleware(['can:Update Roles']);
    Route::put('role/{id}/update', [RoleController::class, 'update'])->name('roles.update')->middleware(['can:Update Roles']);
    Route::delete('role/{id}', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware(['can:Delete Roles']);


    Route::resource('slider', SlideController::class);



    Route::get('orders', [OrderController::class, 'index'])->name('order.index');


    Route::get('reset-password/{user}', [UserController::class, 'reset_password'])->name('users.reset_password');
    Route::get('my-profile', [GeneralController::class, 'myProfile'])->name('site.myProfile');
    Route::get('site-settings', [GeneralController::class, 'siteSettings'])->name('site.siteSettings');
    Route::post('/site-settings-save', [GeneralController::class, 'save_general_settings'])->name('site_settings_save');    
});
