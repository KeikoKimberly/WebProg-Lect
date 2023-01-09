<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JobController;

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

Route::get('/registerCompany', [UserController::class, 'registerCompany'])->name('registerCompany');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('checkLogIn', [UserController::class, 'userLogIn']);
Route::post('store-form-company', [UserController::class, 'companyRegistration']);

Route::prefix('jobs')->name('job.')->group(function () {
    Route::get('/', [JobController::class, 'index'])->name('index');
    Route::get('/with-filter', [JobController::class, 'indexWithFilter'])->name('indexWithFilter');
    Route::get('create', [JobController::class, 'create'])->name('create');
    Route::get('manage', [JobController::class, 'manage'])->name('manage');
    Route::get('edit/{job}', [JobController::class, 'edit'])->name('edit');
    Route::post('store', [JobController::class, 'store'])->name('store');
    Route::delete('destroy/{job}', [JobController::class, 'destroy'])->name('destroy');
    Route::put('/update/{job}', [JobController::class, 'update'])->name('update');
});
