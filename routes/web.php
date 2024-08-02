<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
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

Route::group(
    array(
        'middleware' => [ 'auth', 'profile' ]
    ),
    function () {
        Route::group(
            array(
                'prefix' => 'profile'
            ),
            function () {
                Route::get('/', [ ProfileController::class, 'index' ])->name('profile');
                Route::put('/', [ ProfileController::class, 'update' ])->name('profile.update');
            }
        );

        Route::group(
            array(
                'prefix' => 'tags'
            ),
            function () {
                Route::get('/', [ TagController::class, 'index' ])->name('tags');
                Route::get('/create', [ TagController::class, 'create' ])->name('tag.create');
                Route::post('/create', [ TagController::class, 'store' ])->name('tag.store');
                Route::delete('/delete/{tag}', [ TagController::class, 'destroy' ])->name('tag.destroy');
            }
        );
        Route::group(
            array(
                'prefix' => 'product'
            ),
            function () {
                Route::get('/', [ ProductController::class, 'index' ])->name('product');
                Route::get('/show/{product}', [ ProductController::class, 'show' ])->name('product.show');
                Route::get('/edit/{product}', [ ProductController::class, 'edit' ])->name('product.edit');
                Route::get('/create', [ ProductController::class, 'create' ])->name('product.create');
                Route::put('/edit/{product}', [ ProductController::class, 'update' ])->name('product.update');
                Route::post('/create', [ ProductController::class, 'store' ])->name('product.store');
                Route::delete('/delete/{product}', [ ProductController::class, 'destroy' ])->name('product.destroy');
            }
        );

        Route::group(
            array(
                'prefix' => 'users'
            ),
            function () {
                Route::get('/', [ UserController::class, 'index' ])->name('users');
                Route::get('/show/{user}', [ UserController::class, 'show' ])->name('user.show');
                Route::get('/edit/{user}', [ UserController::class, 'edit' ])->name('user.edit');
                Route::get('/create', [ UserController::class, 'create' ])->name('user.create');
                Route::put('/edit/{user}', [ UserController::class, 'update' ])->name('user.update');
                Route::post('/create', [ UserController::class, 'store' ])->name('user.store');
                Route::delete('/delete/{user}', [ UserController::class, 'destroy' ])->name('user.destroy');
            }
        );

        Route::get('user/products/{user}', [ ProductController::class, 'users' ])->name('get.users');
    }
);
