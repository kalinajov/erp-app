<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Models\TimeLog;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {

    $user = auth()->user();

    $totalTasks = Task::where('user_id', $user->id)->count();
    $todoTasks = Task::where('user_id', $user->id)->where('status', 'todo')->count();
    $inProgressTasks = Task::where('user_id', $user->id)->where('status', 'in_progress')->count();
    $doneTasks = Task::where('user_id', $user->id)->where('status', 'done')->count();

    $isClockedIn = $user->timeLogs()->whereNull('clock_out')->exists();

    return view('dashboard', compact(
        'totalTasks',
        'todoTasks',
        'inProgressTasks',
        'doneTasks',
        'isClockedIn'
    ));

})->middleware(['auth'])->name('dashboard');


Route::middleware('auth')->group(function () {

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


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

    Route::resource('tasks', TaskController::class);
});

require __DIR__.'/auth.php';