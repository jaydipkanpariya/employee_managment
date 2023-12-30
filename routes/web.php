<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
// admin
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;


//  employe
use App\Http\Controllers\Employe\EmpLoginController;
use App\Http\Controllers\Employe\EmpDashboardController;


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


// Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/form', [HomeController::class, 'form'])->name('form');
Route::get('/bootstrap_table', [HomeController::class, 'bootstrap_table'])->name('bootstrap_table');
Route::get('/sign_up', [HomeController::class, 'sign_up'])->name('sign_up');
Route::get('/sample_page', [HomeController::class, 'sample_page'])->name('sample_page');

// employes
Route::get('/sign_in', [HomeController::class, 'sign_in'])->name('sign_in');

// admin panel
Route::group(['prefix' => 'admin'], function () {
    // Login and dashboard
    Route::get('/', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/login/submit', [LoginController::class, 'login'])->name('admin.login.submit');
    // after admin login routes
    Route::middleware('admin')->group(function () {
         //Employee
         Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.list');
        // Logout Routes
        Route::get('/logout/submit', [LoginController::class, 'logout'])->name('admin.logout.submit');
    });
});


// login and dashboard
Route::get('/', [EmpDashboardController::class, 'dashboard'])->name('employe.dashboard');
Route::post('/login/submit', [EmpLoginController::class, 'login'])->name('employe.login.submit');
// after employe login routes
Route::middleware('employe')->group(function () {
    // Logout Routes
    Route::get('/logout/submit', [EmpLoginController::class, 'logout'])->name('employe.logout.submit');
});
