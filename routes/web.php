<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Booking;
use App\Models\Studio;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    $studios = Studio::where('status', 'Tersedia')
        ->with('facilities')
        ->orderBy('jenis')
        ->orderBy('nama_studio')
        ->get();

    return view('dashboard', compact('studios'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/history', function () {
    $bookings = Booking::with('studio')
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('history', compact('bookings'));
})->middleware(['auth', 'verified'])->name('history');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('bookings', BookingController::class)
    ->only(['create', 'store']);

    Route::get('/booking/{booking}/payment', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/booking/{booking}/payment', [PaymentController::class, 'process'])->name('payment.process');
    Route::post('/booking/{booking}/konfirmasi-metode', [BookingController::class, 'konfirmasiMetode'])->name('bookings.konfirmasiMetode');
    Route::get('/booking/{booking}/receipt', [ReceiptController::class, 'download'])->name('receipt.download');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
    Route::delete('/profile/photo', [ProfileController::class, 'destroyPhoto'])->name('profile.photo.destroy');

    // routes/web.php
Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

            Route::resource('studios', StudioController::class);

            Route::resource('facilities', FacilityController::class);

        Route::get('/bookings', [BookingController::class, 'index'])
            ->name('bookings.index');

        Route::patch('/bookings/{booking}/approve', [BookingController::class, 'approve'])
            ->name('bookings.approve');
        
        Route::patch('/bookings/{booking}/reject', [BookingController::class, 'reject'])
            ->name('bookings.reject');

        Route::patch('/bookings/{booking}/verify', [BookingController::class, 'verify'])
            ->name('bookings.verify');
        
        Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
        Route::post('/profile/photo', [AdminProfileController::class, 'updatePhoto'])->name('profile.photo.update');
        Route::delete('/profile/photo', [AdminProfileController::class, 'destroyPhoto'])->name('profile.photo.destroy');

        Route::get('/laporan/export-pdf', [DashboardController::class, 'exportPdf'])
            ->name('laporan.export');
    });

require __DIR__.'/auth.php';