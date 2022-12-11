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
    return redirect('/login');
});

//Auth::routes();
Auth::routes(['register' => false]);

// Admin routes.
Route::group(['middleware' => ['role:ADMIN']], function () {
    Route::prefix('admin')->group(function () {


        Route::get('', [\App\Http\Controllers\Admin\DashboardController::class, 'index']);
    });
});


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
