<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DemoController;
use App\Http\Controllers\API\LoginController as ApiLoginController;
use App\Http\Controllers\API\LogoutController as ApiLogoutController;
use App\Http\Controllers\API\RegistrationController as RegController;
use App\Http\Controllers\API\User\UserApiController;

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

Route::middleware(array( 'auth.gate' ))
    ->group(
        function () {
            Route::get(
                '/user',
                function (Request $request) {
                    return $request->user();
                }
            );
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
        }
    );

Route::post('/login', ApiLoginController::class);
Route::post('/register', RegController::class);

Route::get('demo', array( DemoController::class, 'exampleMethod' ));
