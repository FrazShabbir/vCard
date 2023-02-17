<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\DashboardController;

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

// Route::group(['middleware' => ['CheckBrowser']], function () {

    Route::group(['middleware' => ['auth']],function () {
        Route::get('check/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('about', [HomeController::class, 'about'])->name('about');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');
Route::get('privacy', [HomeController::class, 'privacy'])->name('privacy');


Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/user/login', [HomeController::class, 'userLogin'])->name('login.user')->middleware('guest');


Route::post('/store/contact', [HomeController::class, 'store'])->name('contact.store');
Route::put('/update/contact/{slug}', [HomeController::class, 'profileUpdate'])->name('contact.update');


Route::get('downloadVCard/{id}', [HomeController::class, 'downloadVCard'])->name('downloadVCard');

Route::get('/{slug}/edit', [HomeController::class, 'profileEdit'])->middleware('auth')->name('editProfile');


Route::get('/auth', function(){
    if(Auth::check()){
        return redirect()->route('dashboard');
    }else{
        return redirect()->route('login');
    }
})->name('check.auth');


Route::get('/dashboard', function(){
    if(Auth::check()){
        return redirect()->route('dashboard');
    }else{
        return redirect()->route('login');
    }
})->name('check.dashboard');

Route::get('auth/register', function(){
    if(Auth::check()){
        return redirect()->route('dashboard');
    }else{
        return redirect()->route('login');
    }
})->name('check.register');
Route::get('register', function(){
    if(Auth::check()){
        return redirect()->route('dashboard');
    }else{
        return redirect()->route('login');
    }
})->name('check.register');


Route::get('/{slug}', [HomeController::class, 'slug'])->name('slug');

// });


require __DIR__.'/auth.php';

