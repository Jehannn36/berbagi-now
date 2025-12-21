<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VolunteerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app.landing');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/profile/{id}', [ProfileController::class, 'index'])->middleware("auth");
Route::put('/profile/{id}', [ProfileController::class, 'update'])->middleware("auth");

Route::get('/donate', [LandingController::class, 'index']);
Route::get('/donate-detail/{id}', [LandingController::class, 'show']);
Route::post('/donate-detail/{id}', [LandingController::class, 'store']);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
    Route::get('/admin/volunteer', [AdminController::class, 'volunteer']);
    Route::get('/admin/volunteer-detail/{id}', [AdminController::class, 'show']);
});

Route::middleware(['auth', 'role:volunteer'])->group(function () {
    Route::get('/volunteer/dashboard', [VolunteerController::class, 'index']);
    Route::get('/volunteer/donasi', [VolunteerController::class, 'donasi']);
    Route::get('/volunteer/donasi/create', [VolunteerController::class, 'create']);
    Route::post('/volunteer/donasi', [VolunteerController::class, 'store']);
    Route::get('/volunteer/donasi-detail/{id}', [VolunteerController::class, 'donasiDetail']);
});

Route::post('/payment', [PaymentController::class, 'createPayment'])
    ->middleware('auth')
    ->name('payment.create');
Route::post('/midtrans/webhook', [PaymentController::class, 'verifyPayment']);
