<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
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
Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home.home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/add-patient', [PatientController::class, 'create'])->name('patient.form');
Route::post('/add-patient', [PatientController::class, 'store'])->name('store.patient');
Route::get('/list-patients', [PatientController::class, 'index'])->name('list.patients');
