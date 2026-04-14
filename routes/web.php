<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Models\TimeLog;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CLOCK IN / OUT
    Route::post('/clock-in', function () {
        $user = auth()->user();

        if ($user->timeLogs()->whereNull('clock_out')->exists()) {
            return back();
        }

        $user->timeLogs()->create([
            'clock_in' => now()
        ]);

        return back();
    });

    Route::post('/clock-out', function () {
        $user = auth()->user();

        $log = $user->timeLogs()->whereNull('clock_out')->latest()->first();

        if ($log) {
            $log->update([
                'clock_out' => now()
            ]);
        }

        return back();
    });

    // TASKS
    Route::resource('tasks', TaskController::class);
});

require __DIR__.'/auth.php';