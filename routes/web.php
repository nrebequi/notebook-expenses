<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExpenseTypeController;
use App\Http\Controllers\CostCenterController; 
use App\Http\Controllers\ExpenseController;

// Redirect root to dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Add this new section for Tools
    Route::prefix('tools')->group(function () {
        Route::resource('expense-types', ExpenseTypeController::class);
        Route::resource('cost-centers', CostCenterController::class);
        Route::resource('expenses', ExpenseController::class);
    });

});

require __DIR__.'/auth.php';