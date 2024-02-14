<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Middleware\CustomAuthMiddleware;

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

Auth::routes();

Route::get('/contact/add', [ContactController::class,'index'])->middleware(CustomAuthMiddleware::class);
Route::post('/contact/add', [ContactController::class,'add']);
Route::get('/contact/list', [ContactController::class,'list'])->middleware(CustomAuthMiddleware::class);
Route::get('/logout',[ContactController::class,'logout']);
Route::get('/delete/{id}',[ContactController::class,'delete']);
Route::get('/contact/edit/{id}',[ContactController::class,'edit']);
Route::post('/contact/edit', [ContactController::class,'updateData']);
Route::post('/contact/search', [ContactController::class,'search']);
Route::get('/contact/userEdit', [ContactController::class,'userEdit']);
Route::post('/contact/userEdit', [ContactController::class,'changeUser']);