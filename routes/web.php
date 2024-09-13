<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

// Auth::routes();


// routes/web.php

Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');





// Route::middleware(['web'])->group(function () {
//     // Login Routes
//     Route::get('/login', [AuthController::class, 'getLoginPage'])->name('auth.getLoginPage');
//     Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.login')->middleware('guest');
//     Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('auth');
    
    
//     Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.getRegisterPage');
//     Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
    
    
//     Route::get('/forgot-password',[AuthController::class, 'getForgotPasswordPage'])->name('auth.getForgotPasswordPage')->middleware('guest');
//     Route::post('/forgot-password',[AuthController::class, 'requestForgotPasswordLink'])->name('auth.requestForgotPasswordLink')->middleware('guest');
    
//     Route::get('/reset-password/{token}',[AuthController::class, 'getPasswordResetPage'])->name('password.reset')->middleware('guest');
//     Route::post('/reset-password',[AuthController::class, 'resetPassword'])->name('auth.resetPassword')->middleware('guest');
    
// });



// Route::post('/login', [AuthController::class, 'login'])->name('auth.login');


Route::get('/login', [AuthController::class, 'getLoginPage'])->name('auth.getLoginPage');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('getRegisterPage');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');


// Forgot Password Form (GET)
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('auth.forgotPassword');

// Send Reset Link Email (POST)
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])
    ->name('password.email');

// Reset Password Form (GET)
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])
    ->name('password.reset');

// Reset Password (POST)
Route::post('/reset-password', [AuthController::class, 'resetPassword'])
    ->name('password.update');
// use App\Http\Controllers\Auth\PasswordResetController;


Route::middleware(['auth'])->group(function () {
    // Routes accessible to both admins and superadmins
    Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
});
