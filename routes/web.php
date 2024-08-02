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

Route::get('/', array( HomeController::class, 'index' ))->name('home.home');
Route::get('/home', array( HomeController::class, 'index' ))->name('home');
/*
Route::get('/add-patient', [PatientController::class, 'create'])->name('patient.form');
Route::post('/add-patient', [PatientController::class, 'store'])->name('store.patient');
Route::get('/list-patients', [PatientController::class, 'index'])->name('list.patients');
*/
Route::group(
    array(
        'middleware' => array( 'auth', 'profile' ),
    ),
    function () {
        Route::group(
            array(
                'prefix' => 'profile',
            ),
            function () {
                Route::get('/', array( ProfileController::class, 'index' ))->name('profile');
                Route::put('/', array( ProfileController::class, 'update' ))->name('profile.update');
            }
        );

        Route::group(
            array(
                'prefix' => 'tags',
            ),
            function () {
                Route::get('/', array( TagController::class, 'index' ))->name('tags');
                Route::get('/create', array( TagController::class, 'create' ))->name('tag.create');
                Route::post('/create', array( TagController::class, 'store' ))->name('tag.store');
                Route::delete('/delete/{tag}', array( TagController::class, 'destroy' ))->name('tag.destroy');
            }
        );
        Route::group(
            array(
                'prefix' => 'product',
            ),
            function () {
                Route::get('/', array( ProductController::class, 'index' ))->name('product');
                Route::get('/show/{product}', array( ProductController::class, 'show' ))->name('product.show');
                Route::get('/edit/{product}', array( ProductController::class, 'edit' ))->name('product.edit');
                Route::get('/create', array( ProductController::class, 'create' ))->name('product.create');
                Route::put('/edit/{product}', array( ProductController::class, 'update' ))->name('product.update');
                Route::post('/create', array( ProductController::class, 'store' ))->name('product.store');
                Route::delete('/delete/{product}', array( ProductController::class, 'destroy' ))->name('product.destroy');
            }
        );

        Route::group(
            array(
                'prefix' => 'users',
            ),
            function () {
                Route::get('/', array( UserController::class, 'index' ))->name('users');
                Route::get('/show/{user}', array( UserController::class, 'show' ))->name('user.show');
                Route::get('/edit/{user}', array( UserController::class, 'edit' ))->name('user.edit');
                Route::get('/create', array( UserController::class, 'create' ))->name('user.create');
                Route::put('/edit/{user}', array( UserController::class, 'update' ))->name('user.update');
                Route::post('/create', array( UserController::class, 'store' ))->name('user.store');
                Route::delete('/delete/{user}', array( UserController::class, 'destroy' ))->name('user.destroy');
            }
        );

        Route::get('user/products/{user}', array( ProductController::class, 'users' ))->name('get.users');
    }
);
