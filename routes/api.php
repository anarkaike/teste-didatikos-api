<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('/v1')->group(function() {
    Route::post(uri: '/login', action: [AuthController::class, 'login']);
    Route::post(uri: '/register', action: [AuthController::class, 'register']);

    Route::middleware('auth:sanctum')->group(function() {
        Route::post(uri: '/logout', action: [AuthController::class, 'logout']);
        Route::apiResource(name: 'users', controller: UserController::class);
        Route::apiResource(name: 'products', controller: ProductController::class);
        Route::apiResource(name: 'brands', controller: BrandController::class);
        Route::apiResource(name: 'cities', controller: CityController::class);
    });
});
