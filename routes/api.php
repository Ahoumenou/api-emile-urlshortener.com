<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LinkController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::get('/user', [Controller::class, 'show']);
Route::post('/user', [Controller::class, 'store']);
Route::put('/user', [Controller::class, 'update']);
Route::delete('/user', [Controller::class, 'destroy']);


Route::get('/links/{smig_path}', [LinkController::class, 'show']);
Route::post('/links', [LinkController::class, 'store']);
Route::put('/links/{smig_path}', [LinkController::class, 'update']);
Route::delete('/links/{smig_path}', [LinkController::class, 'destroy']);

