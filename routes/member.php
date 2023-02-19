<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Member\StatsController;
use App\Http\Controllers\Member\ProfileController;
use App\Http\Controllers\Member\CardController;

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

    // Route::group(['middleware' => ['CheckProfile']],function () {


    Route::get('stats', [StatsController::class, 'stats'])->name('member.stats');

    Route::get('my-profile', [ProfileController::class, 'myProfile'])->name('user.profile');
    Route::put('my-profile/save', [ProfileController::class, 'myProfileSave'])->name('user.profile.save');
    
    Route::get('my-card', [CardController::class, 'index'])->name('user.card');
    Route::put('my-card/save', [CardController::class, 'update'])->name('user.card.save');

});
// });