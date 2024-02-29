<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'v1'], function() {

    Route::group(['prefix' => 'workers'], function() {

        Route::post('/checking', [App\Http\Controllers\Api\Worker\WorkerController::class, 'checking']);
    });

    Route::post('/login', [App\Http\Controllers\Api\Auth\AuthController::class, 'login']);
    Route::post('/validate', [App\Http\Controllers\Api\Auth\AuthController::class, 'validation']);
    Route::get('/worker/image/show/{filename}', [App\Http\Controllers\Api\ImageController::class, 'show']);

    

    Route::middleware(['auth:api'])->group(function () {
        
        Route::get('/dashboard', [App\Http\Controllers\Api\General\DashboardController::class, 'get']);

        Route::group(['prefix' => 'change'], function() {
            Route::post('/password', [App\Http\Controllers\Api\Auth\AuthController::class, 'changePassword']);
            Route::post('/profile', [App\Http\Controllers\Api\Auth\AuthController::class, 'changeProfile']);
        });
        
        Route::get('/filter', [App\Http\Controllers\Api\Worker\WorkerController::class, 'filterList']);
        Route::get('/factory', [App\Http\Controllers\Api\Worker\WorkerController::class, 'factories']);
        Route::get('/branch', [App\Http\Controllers\Api\Worker\WorkerController::class, 'branches']);
        Route::post('/worker/search', [App\Http\Controllers\Api\Worker\WorkerController::class, 'search']);
        Route::get('/worker', [App\Http\Controllers\Api\Worker\WorkerController::class, 'get']);
        Route::get('/worker/{id}', [App\Http\Controllers\Api\Worker\WorkerController::class, 'detail']);
        Route::post('/worker/blacklist', [App\Http\Controllers\Api\Worker\WorkerController::class, 'blackList']);
        Route::post('/worker/takeout', [App\Http\Controllers\Api\Worker\WorkerController::class, 'takeOut']);
        Route::post('/worker/update', [App\Http\Controllers\Api\Worker\WorkerController::class, 'update']);
        Route::post('/worker/doc', [App\Http\Controllers\Api\Worker\WorkerController::class, 'workerDocument']);

        
        Route::post('/worker/image', [App\Http\Controllers\Api\ImageController::class, 'imageStore']);
        Route::post('/worker/image/drop', [App\Http\Controllers\Api\ImageController::class, 'imageDrop']);

        Route::get('/province', [App\Http\Controllers\Api\Worker\PlaceController::class, 'provinces']);
        Route::get('/district', [App\Http\Controllers\Api\Worker\PlaceController::class, 'districts']);
        Route::get('/commune', [App\Http\Controllers\Api\Worker\PlaceController::class, 'communes']);
        Route::get('/village', [App\Http\Controllers\Api\Worker\PlaceController::class, 'villages']); 

        // Route::get('/validcm', [App\Http\Controllers\Api\Worker\PlaceController::class, 'validCommune']); 
        // Route::get('/validvl', [App\Http\Controllers\Api\Worker\PlaceController::class, 'validVillage']); 
    });
});