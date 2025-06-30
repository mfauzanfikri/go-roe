<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TutorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::get('/register/tutor', [AuthController::class, 'showTutorRegistrationForm'])->name('register.tutor');

Route::group(['prefix' => 'tutors'], function() {
    Route::get('/', [TutorController::class, 'index'])->name('tutors.index');
    // use id later
    Route::get('/details', [TutorController::class, 'details'])->name('tutors.details');
});

Route::group(['prefix' => 'orders'], function() {
    Route::get('/', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/create', [OrderController::class, 'newOrder'])->name('orders.new-order');
});
