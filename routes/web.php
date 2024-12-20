<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('/', function () {
    return view('welcome');
});

//login Page
Route::get('/login', function () {
    return view('login');
})->name('login');

//Sign up Page
Route::get('/register', function () {
    return view('register');
})->name('register');

//logout 
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//chat Page
// Route::middleware('auth:sanctum')->group( function () {
    Route::get('/chat', function () {
        return view('chat');
    })->name('chat');
// });