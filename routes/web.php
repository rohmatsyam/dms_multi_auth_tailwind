<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::group(['middleware' => 'auth' ],function(){
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::view('profile','profile')->name('profile');
    Route::put('profile',[\App\Http\Controllers\ProfileController::class,'update'])->name('profile.update');
});

require __DIR__.'/auth.php';

Route::group(['middleware' => 'auth:admin'],function(){
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', function () {            
                return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::view('profile','admin.profile')->name('admin.profile');
        Route::put('profile',[\App\Http\Controllers\ProfileController::class,'update'])->name('admin.profile.update');
    });    
});

require __DIR__.'/adminauth.php';



