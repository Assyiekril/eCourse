<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    $courses = Course::with(['teacher', 'category'])
        ->where('is_active', true)
        ->latest()
        ->get();
    return view('welcome', compact('courses'));
});


Route::get('/course/{course}', [CourseController::class, 'show'])->name('courses.show');


Route::get('/dashboard', function () {
    /** @var User $user */
    $user = Auth::user();

    $data = [];

    if ($user->role === 'teacher') {
        $data['myCourses'] = $user->coursesTaught()
            ->with('category')
            ->latest()
            ->get();
    }

    return view('dashboard', $data);
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{course}/edit', [App\Http\Controllers\CourseController::class, 'edit'])->name('courses.edit');
    Route::put('/courses/{course}', [App\Http\Controllers\CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{course}', [App\Http\Controllers\CourseController::class, 'destroy'])->name('courses.destroy');


    Route::get('/courses/{course}/contents/create', [App\Http\Controllers\ContentController::class, 'create'])
        ->name('contents.create');
    Route::post('/courses/{course}/contents', [App\Http\Controllers\ContentController::class, 'store'])
        ->name('contents.store');
    Route::get('/lessons/{content}', [App\Http\Controllers\ContentController::class, 'show'])
        ->name('contents.show');
    Route::get('/contents/{content}/edit', [App\Http\Controllers\ContentController::class, 'edit'])
        ->name('contents.edit');
    Route::put('/contents/{content}', [App\Http\Controllers\ContentController::class, 'update'])
        ->name('contents.update');


    Route::post('/courses/{course}/join', [App\Http\Controllers\EnrollmentController::class, 'store'])
        ->name('courses.join');

        
    Route::post('/lessons/{content}/toggle-progress', [App\Http\Controllers\LessonProgressController::class, 'toggle'])
        ->name('lessons.toggle');
});


require __DIR__ . '/auth.php';
