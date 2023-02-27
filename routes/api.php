<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PackageController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/token', function () {
    return csrf_token(); 
});
Route::post('package',[PackageController::class, 'create']);
Route::get('package',[PackageController::class, 'getList']);
Route::get('package/{id}',[PackageController::class, 'getDetail']);
Route::put('package/{id}',[PackageController::class, 'update']);
Route::patch('package/{id}',[PackageController::class, 'updatePatch']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
