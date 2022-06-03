<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
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

// Route::inertia('/login', 'Auth/Login');
// Route::inertia('/register', 'Auth/Register');
// Route::inertia('/dashboard', 'Dashboard');

// Route::middleware('guest')->group(function () {
//     Route::view('/login', 'auth.login')->name('login');
//     Route::view('/register', 'auth.register')->name('register');
// });

// Route::controller(AuthController::class)->prefix('auth')->group(function() {
//     Route::post('/login', 'login')->name('auth.login');
//     Route::post('/register', 'register')->name('auth.register');
// });

Route::controller(PostController::class)->group(function (){
    Route::get('/', 'index')->name('posts.index');
    Route::get('/posts/{post:slug}', 'show')->name('posts.show');
});


// Route::middleware('auth')->group(function(){
//     Route::get('/dashboard', HomeController::class)->name('dashboard');
//     Route::resource('post', PostController::class)->except(['index', 'show']);
//     Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
// });


