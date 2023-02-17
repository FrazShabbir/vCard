<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Member\StatsController;
use App\Http\Controllers\Member\ProfileController;

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


Route::group(['middleware' => ['role:Member','auth'], 'prefix' => 'auth/member',],function () {
    Route::get('/', [DashboardController::class, 'memberDashboard'])->name('member.dashboard');
    Route::get('stats', [StatsController::class, 'stats'])->name('member.stats');

    Route::get('my-profile', [ProfileController::class, 'myProfile'])->name('user.profile');

});
