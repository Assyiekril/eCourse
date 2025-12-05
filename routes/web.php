<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;
use App\Models\Course;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function (Request $request) {

    $popularCourses = Course::withCount('students')
                        ->with(['category', 'teacher'])
                        ->where('is_active', true)
                        ->orderBy('students_count', 'desc')
                        ->take(5)
                        ->get();

    $query = Course::with(['teacher', 'category'])
                ->where('is_active', true);

    if ($request->has('search') && $request->search != '') {
        $query->where(function($q) use ($request) {
            $q->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('description', 'like', '%' . $request->search . '%');
        });
    }

    if ($request->has('category') && $request->category != '') {
        $query->where('category_id', $request->category);
    }

    $courses = $query->latest()->get();
    
    $categories = Category::all();

    return view('welcome', compact('popularCourses', 'courses', 'categories'));
});


Route::get('/course/{course}', [CourseController::class, 'show'])->name('courses.show');


Route::get('/dashboard', function () {
    /** @var User $user */
    $user = Auth::user();
    $myCourses = [];

    if ($user->role === 'teacher') {
        $myCourses = \App\Models\Course::where('teacher_id', $user->id)->get();
    } 
    elseif ($user->role === 'student') {
        $myCourses = $user->joinedCourses()->with('teacher')->get();
    }

    return view('dashboard', compact('myCourses'));
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


    Route::get('/courses/{course}/contents/create', [App\Http\Controllers\ContentController::class, 'create'])->name('contents.create');
    Route::post('/courses/{course}/contents', [App\Http\Controllers\ContentController::class, 'store'])->name('contents.store');
    Route::get('/lessons/{content}', [App\Http\Controllers\ContentController::class, 'show'])->name('contents.show');
    Route::get('/contents/{content}/edit', [App\Http\Controllers\ContentController::class, 'edit'])->name('contents.edit');
    Route::put('/contents/{content}', [App\Http\Controllers\ContentController::class, 'update'])->name('contents.update');


    Route::post('/courses/{course}/join', [App\Http\Controllers\EnrollmentController::class, 'store'])->name('courses.join');

        
    Route::post('/lessons/{content}/toggle-progress', [App\Http\Controllers\LessonProgressController::class, 'toggle'])->name('lessons.toggle');


    Route::resource('categories', App\Http\Controllers\CategoryController::class)->except(['create', 'edit', 'show']);


    Route::resource('users', App\Http\Controllers\UserController::class);

    Route::post('/courses/{id}/join', [CourseController::class, 'join'])->name('courses.join');
});


require __DIR__ . '/auth.php';
