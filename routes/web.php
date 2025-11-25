<?php

use App\Http\Controllers\ProfileController;
use App\Models\Course;
use Illuminate\Support\Facades\Route;
use App\Models\User; // Pastikan ini ada

Route::get('/', function () {

    $courses = Course::with(['teacher', 'category'])
        ->where('is_active', true)
        ->latest()
        ->get();

    return view('welcome', compact('courses'));
});


Route::get('/dashboard', function () {
    /** @var User $user */
    $user = Illuminate\Support\Facades\Auth::user();

    $data = [];

    if ($user->role === 'teacher') {
        $data['myCourses'] = $user->coursesTaught()->with('category')->latest()->get();
    }

    return view('dashboard', $data);
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
