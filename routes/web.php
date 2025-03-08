<?php

use App\Console\Commands\TestSchedulerOutput;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    \Illuminate\Support\Facades\Log::info("okay from web request now");
    return view('welcome');
});

Route::get('/text-x-frame-default', function() {
    return response('default value', 200);
});

Route::get('/text-x-frame-over-ride', function() {
    return response('value: SAMEORIGIN', 200)->withHeaders([
        'X-Frame-Options' => 'SAMEORIGIN',
    ]);
});

Route::get('/text-x-frame-unset', function() {
    return response('value: UNSET', 200)->withHeaders([
        'X-Frame-Options' => 'UNSET',
    ]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
