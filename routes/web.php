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

        // Manage system users.
        Route::prefix('system-users')->group(function () {
            Route::post('add', [\App\Http\Controllers\Admin\UsersController::class,'usersAdd'])->name('system-user-add');
            Route::post('update', [\App\Http\Controllers\Admin\UsersController::class,'usersUpdate'])->name('system-user-update');
            Route::get('add', [\App\Http\Controllers\Admin\UsersController::class,'usersAddView']);
            Route::get('delete/{id}', [\App\Http\Controllers\Admin\UsersController::class,'usersDelete']);
            Route::get('info/{id}', [\App\Http\Controllers\Admin\UsersController::class,'usersInfoView']);
            Route::get('all', [\App\Http\Controllers\Admin\UsersController::class,'usersAllView']);
        });

        // Manage raw materials.
        Route::prefix('raw-materials')->group(function () {
            Route::post('add', [\App\Http\Controllers\Admin\RawMaterialsController::class,'add'])->name('raw-material-add');
            Route::post('update', [\App\Http\Controllers\Admin\RawMaterialsController::class,'update'])->name('raw-material-update');
            Route::get('add', [\App\Http\Controllers\Admin\RawMaterialsController::class,'addView']);
            Route::get('delete/{id}', [\App\Http\Controllers\Admin\RawMaterialsController::class,'delete']);
            Route::get('info/{id}', [\App\Http\Controllers\Admin\RawMaterialsController::class,'infoView']);
            Route::get('all', [\App\Http\Controllers\Admin\RawMaterialsController::class,'allView']);
            Route::get('export', [\App\Http\Controllers\Admin\RawMaterialsController::class,'export']);
        });

        Route::get('', [\App\Http\Controllers\Admin\DashboardController::class, 'index']);
    });
});


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
