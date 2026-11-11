<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BidController;

Route::get('/', function () {
    return redirect()->route('projects.index');
});

Route::resource('projects', ProjectController::class);

// Route untuk mengelola penawaran
Route::post('/projects/{project}/bids', [BidController::class, 'store'])
    ->name('bids.store');

Route::put('/bids/{bid}', [BidController::class, 'update'])
    ->name('bids.update');

Route::delete('/bids/{bid}', [BidController::class, 'destroy'])
    ->name('bids.destroy');
