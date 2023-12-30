<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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


Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/form', [HomeController::class, 'form'])->name('form');
Route::get('/bootstrap_table', [HomeController::class, 'bootstrap_table'])->name('bootstrap_table');
Route::get('/sign_in', [HomeController::class, 'sign_in'])->name('sign_in');
Route::get('/sign_up', [HomeController::class, 'sign_up'])->name('sign_up');
Route::get('/sample_page', [HomeController::class, 'sample_page'])->name('sample_page');


// Auth::routes();
