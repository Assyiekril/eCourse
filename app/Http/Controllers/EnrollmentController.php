<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function store(Request $request, Course $course)
    {
        $user = Auth::user();

        if ($user->role !== 'student') {
            abort(403, 'Hanya siswa yang boleh mendaftar.');
        }

        $exists = Enrollment::where('student_id', $user->id)
                            ->where('course_id', $course->id)
                            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar di kursus ini.');
        }

        Enrollment::create([
            'student_id' => $user->id,
            'course_id' => $course->id,
            'enrolled_at' => now(),
        ]);

        return redirect()->route('courses.show', $course->id)
                         ->with('success', 'Selamat! Anda berhasil bergabung di kursus ini.');
    }
}