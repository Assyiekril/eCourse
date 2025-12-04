<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{

    public function create(Course $course)
    {
        $user = Auth::user();

        if ($user->role !== 'admin' && $user->id !== $course->teacher_id) {
            abort(403, 'Anda tidak berhak menambah materi di kursus ini.');
        }

        return view('contents.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $user = Auth::user();

        if ($user->role !== 'admin' && $user->id !== $course->teacher_id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $course->contents()->create([
            'title' => $validated['title'],
            'body' => $validated['body'],
        ]);

        return redirect()->route('courses.show', $course->id)
                         ->with('success', 'Materi berhasil ditambahkan!');
    }

    
    public function show(\App\Models\Content $content)
    {
        $course = $content->course;

        $nextContent = $course->contents()
            ->where('created_at', '>', $content->created_at)
            ->orderBy('created_at', 'asc')->first();

        $prevContent = $course->contents()
            ->where('created_at', '<', $content->created_at)
            ->orderBy('created_at', 'desc')->first();

        $isCompleted = false;
        if (Auth::check() && Auth::user()->role === 'student') {

            $enrollment = \App\Models\Enrollment::where('student_id', Auth::id())
                            ->where('course_id', $course->id)
                            ->first();
            
            if ($enrollment) {
                $isCompleted = \App\Models\LessonProgress::where('enrollment_id', $enrollment->id)
                                ->where('content_id', $content->id)
                                ->exists();
            }
        }

        return view('contents.show', compact('content', 'course', 'nextContent', 'prevContent', 'isCompleted'));
    }

    
    public function edit(Content $content)
    {
        $user = Auth::user();
        $course = $content->course;

        if ($user->role !== 'admin' && $user->id !== $course->teacher_id) {
            abort(403, 'Anda tidak berhak mengedit materi ini.');
        }

        return view('contents.edit', compact('content'));
    }

    public function update(Request $request, Content $content)
    {
        $user = Auth::user();
        $course = $content->course;

        if ($user->role !== 'admin' && $user->id !== $course->teacher_id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $content->update([
            'title' => $validated['title'],
            'body' => $validated['body'],
        ]);

        return redirect()->route('contents.show', $content->id)
                         ->with('success', 'Materi berhasil diperbarui!');
    }
}