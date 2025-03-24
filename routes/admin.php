<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\InvoiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index')->name('login');
    Route::get('/login', 'index');
    Route::post('/authenticate', 'authenticate')->name('validate_login');
    Route::get('/logout', 'logout')->name('logout');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::controller(CustomerController::class)->prefix('customer')->name('customer_')->middleware('auth')->group(function () {
    Route::get('/list', 'index')->name('list');
    Route::get('/add', 'add')->name('add');
    Route::post('/add', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
});

Route::controller(InvoiceController::class)->prefix('invoice')->name('invoice_')->middleware('auth')->group(function () {
    Route::get('/list', 'index')->name('list');
    Route::get('/add', 'add')->name('add');
    Route::post('/add', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
});
