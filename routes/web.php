<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TutorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/register/tutor', [AuthController::class, 'showTutorRegistrationForm'])->name('register.tutor');
Route::post('/register/tutor', [AuthController::class, 'tutorRegister'])->name('register.tutor');

Route::group(['prefix' => 'tutors'], function() {
    Route::get('/', [TutorController::class, 'index'])->name('tutors.index');
    // use id later
    Route::get('/details', [TutorController::class, 'details'])->name('tutors.details');
});

Route::middleware('auth')->group(function() {
    Route::group(['prefix' => 'orders'], function() {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/create', [OrderController::class, 'newOrder'])->name('orders.new-order');

        Route::post('/midtrans/token', [OrderController::class, 'getMidtransToken'])->name('midtrans.token');

        Route::post('/process/cod', [OrderController::class, 'processCod'])->name('orders.process-cod');
        Route::post('/process/midtrans', [OrderController::class, 'processMidtrans'])->name('orders.process-midtrans');

        Route::post('/{order}/fee-token', [OrderController::class, 'getFeeSnapToken'])->name('orders.fee-token');
        Route::post('/{order}/fee-callback', [OrderController::class, 'feeCallback'])->name('orders.fee-callback');

        Route::post('/{order}/start', [OrderController::class, 'start'])->name('orders.start');
        Route::post('/{order}/complete', [OrderController::class, 'complete'])->name('orders.complete');

    });

    Route::post('/api/available-tutors', [OrderController::class, 'getAvailableTutors'])->name('api.available-tutors');
});



