<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;

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
Route::get('/no-auth', function () {
    return response()->json(['msg'=>'Unauthenticated', 'status' => 2]);
})->name('no-auth');



//Sign Up API
Route::post('/signup', [AuthController::class, 'signup']);
//login API
Route::post('/login', [AuthController::class, 'login']);

//chat API
Route::middleware('auth:sanctum')->group( function () {
    Route::post('/chat', [ChatController::class, 'chat']);
});
