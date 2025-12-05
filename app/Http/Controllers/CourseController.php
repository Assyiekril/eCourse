<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{

    public function create()
    {
        $categories = Category::all();
        return view('courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $request->user()->coursesTaught()->create([
            'title' => $validated['title'],
            'category_id' => $validated['category_id'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'is_active' => true,
        ]);

        return redirect()->route('dashboard')->with('success', 'Kursus berhasil dibuat!');
    }

    public function show(Course $course)
    {

        $course->load(['teacher', 'category', 'contents' => function ($query) {
            $query->orderBy('created_at', 'asc');
        }]);

        $isEnrolled = false;
        if (Auth::check() && Auth::user()->role === 'student') {
            $isEnrolled = \App\Models\Enrollment::where('student_id', Auth::id())
                ->where('course_id', $course->id)
                ->exists();
        }

        return view('courses.show', compact('course', 'isEnrolled'));
    }



    public function edit(Course $course)
    {
        if (Auth::user()->role !== 'admin' && Auth::id() !== $course->teacher_id) {
            abort(403);
        }

        $categories = Category::all();
        return view('courses.edit', compact('course', 'categories'));
    }



    public function update(Request $request, Course $course)
    {
        if (Auth::user()->role !== 'admin' && Auth::id() !== $course->teacher_id) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'boolean',
        ]);

        $course->update($validated);

        return redirect()->route('dashboard')->with('success', 'Kursus berhasil diperbarui!');
    }

    public function destroy(Course $course)
    {

        if (Auth::user()->role !== 'admin' && Auth::id() !== $course->teacher_id) {
            abort(403);
        }

        $course->delete();

        return redirect()->route('dashboard')->with('success', 'Kursus berhasil dihapus.');
    }


    public function join($id)
    {
        $course = \App\Models\Course::findOrFail($id);
        /** @var User $user */
        $user = Auth::user();

        $alreadyJoined = $user->joinedCourses()
            ->where('course_id', $id)
            ->exists();

        if ($alreadyJoined) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar di kursus ini.');
        }

        $user->joinedCourses()->attach($id);

        return redirect()->route('dashboard')->with('success', 'Selamat! Anda berhasil bergabung di kursus ' . $course->title);
    }
}
