<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class,'dashboard']);

Route::resource('posts', PostController::class)->middleware('language');

Route::get('setlang/{language}', [HomeController::class,'language']);

Route::middleware(['auth:sanctum', 'verified','language'])->group(function () {
    
    Route::get('/followers', [HomeController::class,'followers'])->name('followers');

    Route::get('/following', [HomeController::class,'following'])->name('following');

    Route::get('/inbox', [HomeController::class,'inbox'])->name('inbox');

    Route::get('/home', [HomeController::class,'home'])->name('home');
    
    Route::resource('comments', CommentController::class);

    Route::get('explore', [HomeController::class,'explore'])->name('explore');

});

Route::get('{username}',[HomeController::class,'index'])->name('user_profile')->middleware('language');

