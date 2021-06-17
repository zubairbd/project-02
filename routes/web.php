<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/**
 * Admin Routes
 */

Route::prefix('admin')->group(function () {
    
    // Route::middleware(['PreventBackHistory', 'auth'])->group(function () {
        
        Route::get('/', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('admin.dashboard');
        Route::resource('roles', 'App\Http\Controllers\Backend\RolesController', ['names' => 'admin.roles']);
        Route::resource('users', 'App\Http\Controllers\Backend\UsersController', ['names' => 'admin.users']);
        Route::resource('admins', 'App\Http\Controllers\Backend\AdminsController', ['names' => 'admin.admins']);


        // Login Routes
        Route::get('/login', [App\Http\Controllers\Backend\Auth\LoginController::class, 'showLoginForm'])->name('admin.login')->middleware('AlreadyLoggedIn');
        Route::post('/login/submit', [App\Http\Controllers\Backend\Auth\LoginController::class, 'login'])->name('admin.login.submit');

        // Logout Routes
        Route::post('/logout/submit', [App\Http\Controllers\Backend\Auth\LoginController::class, 'logout'])->name('admin.logout.submit');
        
        //Forget Password Routes
        Route::get('/password/reset', [App\Http\Controllers\Backend\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
        Route::post('/password/submit', [App\Http\Controllers\Backend\Auth\ForgotPasswordController::class, 'reset'])->name('admin.password.update');

    // });
});


// SOCIAL LOGIN

// Google login
Route::get('login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);

// Facebook login
Route::get('admin/login/facebook', [App\Http\Controllers\Auth\LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('admin/login/facebook/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleFacebookCallback']);

// Github login
Route::get('login/github', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGithub'])->name('login.github');
Route::get('login/github/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGithubCallback']);