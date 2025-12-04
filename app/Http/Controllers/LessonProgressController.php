<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Enrollment;
use App\Models\LessonProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonProgressController extends Controller
{
    public function toggle(Content $content)
    {
        $user = Auth::user();

        $enrollment = Enrollment::where('student_id', $user->id)
                                ->where('course_id', $content->course_id)
                                ->first();

        if (!$enrollment) {
            return redirect()->back()->with('error', 'Anda belum terdaftar di kursus ini.');
        }

        $progress = LessonProgress::where('enrollment_id', $enrollment->id)
                                  ->where('content_id', $content->id)
                                  ->first();

        if ($progress) {

            $progress->delete();
            $message = 'Status penyelesaian dibatalkan.';
        } else {
            
            LessonProgress::create([
                'enrollment_id' => $enrollment->id,
                'content_id' => $content->id,
                'completed_at' => now(),
            ]);
            $message = 'Materi berhasil ditandai selesai!';
        }

        return redirect()->back()->with('success', $message);
    }
}