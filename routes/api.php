<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LoginController as ApiLoginController;
use App\Http\Controllers\API\LogoutController as ApiLogoutController;
use App\Http\Controllers\API\RegistrationController as RegController;
use App\Http\Controllers\API\User\UserApiController;
use App\Http\Controllers\API\Tag\TagApiController;
use App\Http\Controllers\API\ProductApiController;

/*
|
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum'])
   ->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
        Route::middleware(array( 'auth.gate' ))
            ->group(
                function () {
                    Route::post('/logout', ApiLogoutController::class);
                    Route::group(
                        array( 'prefix' => 'user' ),
                        function () {
                            Route::get('/all', array( UserApiController::class, 'index' ));
                            Route::get('/show/{user}', array( UserApiController::class, 'show' ));
                            Route::post('/create', array( UserApiController::class, 'store' ));
                            Route::put('/update/{user}', array( UserApiController::class, 'update' ));
                            Route::delete('/delete/{user}', array( UserApiController::class, 'destroy' ));
                        }
                    );

                    Route::group(
                        array( 'prefix' => 'product' ),
                        function () {
                            Route::get('/all', array( ProductApiController::class, 'index' ));
                            //Route::get('/show/{product}', array( ProductApiController::class, 'show' ));
                            Route::post('/create', array( ProductApiController::class, 'store' ));
                            Route::put('/update/{product}', array( ProductApiController::class, 'update' ));
                            Route::delete('/delete/{product}', array( ProductApiController::class, 'destroy' ));
                        }
                    );
                    Route::group(
                        array( 'prefix' => 'tag' ),
                        function () {
                            Route::get('/all', array( TagApiController::class, 'index' ));
                            Route::post('/create', array( TagApiController::class, 'store' ));
                            Route::delete('/delete/{tag}', array( TagApiController::class, 'destroy' ));
                        }
                    );
                }
            );
   });

Route::post('/login', ApiLoginController::class);
Route::post('/register', RegController::class);
