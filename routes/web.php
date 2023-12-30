<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;


use App\Http\Controllers\Employe\EmployeeController;


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
    // Login Routes
    Route::get('/', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login/submit', [LoginController::class, 'login'])->name('admin.login.submit');
    // after login routes
    Route::middleware('admin')->group(function () {
        // dashboard
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
        // Logout Routes
        Route::get('/logout/submit', [LoginController::class, 'logout'])->name('admin.logout.submit');
    });
});

Route::get('/', [EmployeeController::class, 'showLoginForm'])->name('employe.login');
