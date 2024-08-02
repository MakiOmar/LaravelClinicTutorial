<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DemoController;
use App\Http\Controllers\API\LoginController as ApiLoginController;
use App\Http\Controllers\API\LogoutController as ApiLogoutController;
use App\Http\Controllers\API\RegistrationController as RegController;
use App\Http\Controllers\API\User\UserApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth.gate'])
   ->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
      Route::post('/logout', ApiLogoutController::class);
      Route::group(array('prefix' => 'user'), function () {
            Route::get('/all', [ UserApiController::class, 'index' ]);
            Route::get('/show/{user}', [ UserApiController::class, 'show' ]);
      });
   });

Route::post('/login', ApiLoginController::class);
Route::post('/register', RegController::class);

Route::get('demo', [ DemoController::class, 'exampleMethod' ]);
