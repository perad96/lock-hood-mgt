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

        // Manage employees.
        Route::prefix('employees')->group(function () {
            Route::post('add', [\App\Http\Controllers\Admin\EmployeesController::class,'add'])->name('employee-add');
            Route::post('update', [\App\Http\Controllers\Admin\EmployeesController::class,'update'])->name('employee-update');
            Route::get('add', [\App\Http\Controllers\Admin\EmployeesController::class,'addView']);
            Route::get('delete/{id}', [\App\Http\Controllers\Admin\EmployeesController::class,'delete']);
            Route::get('info/{id}', [\App\Http\Controllers\Admin\EmployeesController::class,'infoView']);
            Route::get('all', [\App\Http\Controllers\Admin\EmployeesController::class,'allView']);
            Route::get('export', [\App\Http\Controllers\Admin\EmployeesController::class,'export']);
        });

        // Manage customers.
        Route::prefix('customers')->group(function () {
            Route::post('add', [\App\Http\Controllers\CustomerController::class,'add'])->name('customer-add');
            Route::post('update', [\App\Http\Controllers\CustomerController::class,'update'])->name('customer-update');
            Route::get('add', [\App\Http\Controllers\CustomerController::class,'addView']);
            Route::get('delete/{id}', [\App\Http\Controllers\CustomerController::class,'delete']);
            Route::get('info/{id}', [\App\Http\Controllers\CustomerController::class,'infoView']);
            Route::get('all', [\App\Http\Controllers\CustomerController::class,'allView']);
            Route::get('export', [\App\Http\Controllers\CustomerController::class,'export']);
        });

        // Manage products.
        Route::prefix('products')->group(function () {
            Route::post('add', [\App\Http\Controllers\ProductsController::class,'add'])->name('product-add');
            Route::post('update', [\App\Http\Controllers\ProductsController::class,'update'])->name('product-update');
            Route::get('add', [\App\Http\Controllers\ProductsController::class,'addView']);
            Route::get('delete/{id}', [\App\Http\Controllers\ProductsController::class,'delete']);
            Route::get('info/{id}', [\App\Http\Controllers\ProductsController::class,'infoView']);
            Route::get('all', [\App\Http\Controllers\ProductsController::class,'allView']);
            Route::get('export', [\App\Http\Controllers\ProductsController::class,'export']);
        });

        // Manage customer orders.
        Route::prefix('customer-orders')->group(function () {
            Route::post('add', [\App\Http\Controllers\CustomerOrderController::class,'add'])->name('customer-order-add');
            Route::post('update', [\App\Http\Controllers\CustomerOrderController::class,'update'])->name('customer-order-update');
            Route::get('add', [\App\Http\Controllers\CustomerOrderController::class,'addView']);
            Route::get('delete/{id}', [\App\Http\Controllers\CustomerOrderController::class,'delete']);
            Route::get('info/{id}', [\App\Http\Controllers\CustomerOrderController::class,'infoView']);
            Route::get('all', [\App\Http\Controllers\CustomerOrderController::class,'allView']);
            Route::get('export', [\App\Http\Controllers\CustomerOrderController::class,'export']);
        });

        // Manage tasks.
        Route::prefix('tasks')->group(function () {
            Route::post('add', [\App\Http\Controllers\TaskController::class,'add'])->name('task-add');
            Route::post('update', [\App\Http\Controllers\TaskController::class,'update'])->name('task-update');
            Route::get('add', [\App\Http\Controllers\TaskController::class,'addView']);
            Route::get('delete/{id}', [\App\Http\Controllers\TaskController::class,'delete']);
            Route::get('info/{id}', [\App\Http\Controllers\TaskController::class,'infoView']);
            Route::get('all', [\App\Http\Controllers\TaskController::class,'allView']);
            Route::get('export', [\App\Http\Controllers\TaskController::class,'export']);
        });

        // Reports.
        Route::prefix('reports')->group(function () {
            Route::get('export-income', [\App\Http\Controllers\Admin\ReportsController::class,'incomeExport']);
            Route::get('export-task', [\App\Http\Controllers\Admin\ReportsController::class,'taskExport']);
            Route::get('export-top-selling-product', [\App\Http\Controllers\Admin\ReportsController::class,'topSellingProductExport']);
            Route::get('export-most-wanted-material', [\App\Http\Controllers\Admin\ReportsController::class,'mostWantedMaterialExport']);
            Route::get('export-order-delivery-cost', [\App\Http\Controllers\Admin\ReportsController::class,'orderDeliveryCostExport']);
            Route::get('export-most-issued-task', [\App\Http\Controllers\Admin\ReportsController::class,'mostIssuedTaskExport']);

            Route::get('view-income', [\App\Http\Controllers\Admin\ReportsController::class,'incomeView']);
            Route::get('view-task', [\App\Http\Controllers\Admin\ReportsController::class,'taskView']);
            Route::get('view-top-selling-product', [\App\Http\Controllers\Admin\ReportsController::class,'topSellingProductView']);
            Route::get('view-most-wanted-material', [\App\Http\Controllers\Admin\ReportsController::class,'mostWantedMaterialView']);
            Route::get('view-order-delivery-cost', [\App\Http\Controllers\Admin\ReportsController::class,'orderDeliveryCostView']);
            Route::get('view-most-issued-task', [\App\Http\Controllers\Admin\ReportsController::class,'mostIssuedTaskView']);

            Route::get('all', [\App\Http\Controllers\Admin\ReportsController::class,'index']);
        });

        Route::get('', [\App\Http\Controllers\Admin\DashboardController::class, 'index']);
    });
});


// Supervisor routes.
Route::group(['middleware' => ['role:SUPERVISOR']], function () {
    Route::prefix('supervisor')->group(function () {

        // Manage tasks.
        Route::prefix('tasks')->group(function () {
            Route::post('add', [\App\Http\Controllers\Supervisor\TaskController::class,'add'])->name('task-add-supervisor');
            Route::post('update', [\App\Http\Controllers\Supervisor\TaskController::class,'update'])->name('task-update-supervisor');
            Route::get('add', [\App\Http\Controllers\Supervisor\TaskController::class,'addView']);
            Route::get('delete/{id}', [\App\Http\Controllers\Supervisor\TaskController::class,'delete']);
            Route::get('info/{id}', [\App\Http\Controllers\Supervisor\TaskController::class,'infoView']);
            Route::get('all', [\App\Http\Controllers\Supervisor\TaskController::class,'allView']);
            Route::get('export', [\App\Http\Controllers\Supervisor\TaskController::class,'export']);
        });

        // Reports.
        Route::prefix('reports')->group(function () {
            Route::get('export-income', [\App\Http\Controllers\Supervisor\ReportsController::class,'incomeExport']);
            Route::get('export-task', [\App\Http\Controllers\Supervisor\ReportsController::class,'taskExport']);
            Route::get('export-top-selling-product', [\App\Http\Controllers\Supervisor\ReportsController::class,'topSellingProductExport']);
            Route::get('export-most-wanted-material', [\App\Http\Controllers\Supervisor\ReportsController::class,'mostWantedMaterialExport']);
            Route::get('export-order-delivery-cost', [\App\Http\Controllers\Supervisor\ReportsController::class,'orderDeliveryCostExport']);

            Route::get('view-income', [\App\Http\Controllers\Supervisor\ReportsController::class,'incomeView']);
            Route::get('view-task', [\App\Http\Controllers\Supervisor\ReportsController::class,'taskView']);
            Route::get('view-top-selling-product', [\App\Http\Controllers\Supervisor\ReportsController::class,'topSellingProductView']);
            Route::get('view-most-wanted-material', [\App\Http\Controllers\Supervisor\ReportsController::class,'mostWantedMaterialView']);
            Route::get('view-order-delivery-cost', [\App\Http\Controllers\Supervisor\ReportsController::class,'orderDeliveryCostView']);

            Route::get('all', [\App\Http\Controllers\Supervisor\ReportsController::class,'index']);
        });

        Route::get('', [\App\Http\Controllers\Supervisor\DashboardController::class, 'index']);
    });
});

// Manage employees.
Route::prefix('util')->group(function () {
    Route::get('get-job-roles-by-section/{id}', [\App\Http\Controllers\UtilityController::class,'getJobRolesBySectionId']);
    Route::get('get-all-customers', [\App\Http\Controllers\UtilityController::class,'getAllCustomers']);
    Route::get('get-raw-material/{id}', [\App\Http\Controllers\UtilityController::class,'getRawMaterialById']);
    Route::get('get-material-by-listed-task/{id}', [\App\Http\Controllers\UtilityController::class,'getRawMaterialsByListedTask']);
    Route::get('get-all-tasks-calender', [\App\Http\Controllers\UtilityController::class,'getAllTasks']);
    Route::get('get-all-tasks-calender-supervisor', [\App\Http\Controllers\UtilityController::class,'getAllTasksSupervisor']);
    Route::get('get-all-orders-calender', [\App\Http\Controllers\UtilityController::class,'getAllOrders']);
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
