<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
// admin
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\NoticeController;


//  employe
use App\Http\Controllers\Employe\EmpLoginController;
use App\Http\Controllers\Employe\EmpDashboardController;
use App\Http\Controllers\Employe\EmpTaskController;


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


Route::get('/dashboard1', [HomeController::class, 'dashboard'])->name('dashboard');
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
        Route::get('/employee/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
        Route::delete('/employee/delete/{id}', [EmployeeController::class, 'delete'])->name('employee.delete');
        Route::post('/employee/add', [EmployeeController::class, 'add'])->name('employee.add');
        Route::post('/employee/update', [EmployeeController::class, 'update'])->name('employee.update');

        //Employee
        Route::get('/project', [ProjectController::class, 'index'])->name('project.list');
        Route::get('/project/edit/{id}', [ProjectController::class, 'edit'])->name('project.edit');
        Route::delete('/project/delete/{id}', [ProjectController::class, 'delete'])->name('project.delete');
        Route::post('/project/add', [ProjectController::class, 'add'])->name('project.add');
        Route::post('/project/update', [ProjectController::class, 'update'])->name('project.update');

        //Notice
        Route::get('/notice', [NoticeController::class, 'index'])->name('notice.list');
        Route::post('/notice/add', [NoticeController::class, 'add'])->name('notice.add');
        Route::get('/notice/edit/{id}', [NoticeController::class, 'edit'])->name('notice.edit');
        Route::delete('/notice/delete/{id}', [NoticeController::class, 'delete'])->name('notice.delete');
        Route::post('/notice/update', [NoticeController::class, 'update'])->name('notice.update');


    //         // task
    // Route::get('/task', [EmpTaskController::class, 'index'])->name('employe.task.list');
    // Route::post('/task/add', [EmpTaskController::class, 'add'])->name('employe.task.add');
    // Route::get('/task/edit/{id}', [EmpTaskController::class, 'edit'])->name('employe.task.edit');
    // Route::post('/task/update', [EmpTaskController::class, 'update'])->name('employee.task.update');

        // Logout Routes
        Route::get('/logout/submit', [LoginController::class, 'logout'])->name('admin.logout.submit');
    });
});


// login and dashboard
Route::get('/', [EmpDashboardController::class, 'dashboard'])->name('employe.dashboard');
Route::post('/login/submit', [EmpLoginController::class, 'login'])->name('employe.login.submit');
// after employe login routes
Route::middleware('employe')->group(function () {
    // task
    // Route::get('/task', [EmpTaskController::class, 'index'])->name('employe.task.list');
    // Route::post('/task/add', [EmpTaskController::class, 'add'])->name('employe.task.add');
    // Route::get('/task/edit/{id}', [EmpTaskController::class, 'edit'])->name('employe.task.edit');
    // Route::post('/task/update', [EmpTaskController::class, 'update'])->name('employee.task.update');

    // Logout Routes
    Route::get('/logout/submit', [EmpLoginController::class, 'logout'])->name('employe.logout.submit');
    // note
    Route::get('/notice/view/{id}', [EmpDashboardController::class, 'view'])->name('employe.notice.view');
});

// Route::middleware(['admin', 'employe'])->group(function () {
    Route::get('/task', [EmpTaskController::class, 'index'])->name('employe.task.list');
    Route::post('/task/add', [EmpTaskController::class, 'add'])->name('employe.task.add');
    Route::get('/task/edit/{id}', [EmpTaskController::class, 'edit'])->name('employe.task.edit');
    Route::post('/task/update', [EmpTaskController::class, 'update'])->name('employee.task.update');
    Route::delete('/task/delete/{id}', [EmpTaskController::class, 'delete'])->name('employee.task.delete');

// });

// note disable
Route::get('/emp_note/{id}', [EmpDashboardController::class, 'emp_note']);
Route::get('/update_password/{id}', [EmpDashboardController::class, 'update_password'])->name('update_password');


