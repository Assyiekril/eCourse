<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Course;
use App\Models\Content;
use App\Models\Enrollment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {   

        $admin = User::create([
            'username' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        $teacher = User::create([
            'username' => 'Teacher1',
            'email' => 'teacher@example.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
            'is_active' => true,
        ]);

        $teacher2 = User::create([
            'username' => 'Teacher2',
            'email' => 'teacher2@example.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
            'is_active' => true,
        ]);


        $student = User::create([
            'username' => 'Student',
            'email' => 'student@example.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'is_active' => true,
        ]);


        $catWeb = Category::create([
            'name' => 'Web Development',
            'description' => 'Belajar membuat website modern.',
        ]);

        $catData = Category::create([
            'name' => 'Data Science',
            'description' => 'Analisis data dan machine learning.',
        ]);


        $courseLaravel = Course::create([
            'teacher_id' => $teacher->id,
            'category_id' => $catWeb->id,
            'title' => 'Mastering Laravel 12',
            'description' => 'Panduan lengkap Laravel dari nol sampai mahir.',
            'start_date' => now(),
            'end_date' => now()->addMonths(3),
            'is_active' => true,
        ]);

        
        Course::create([
            'teacher_id' => $teacher2->id,
            'category_id' => $catData->id,
            'title' => 'Dasar Data Science',
            'description' => 'Pengenalan Python untuk data.',
            'start_date' => now(),
            'end_date' => now()->addMonths(2),
            'is_active' => true,
        ]);


        Content::create([
            'course_id' => $courseLaravel->id,
            'title' => 'Pengenalan Laravel',
            'body' => 'Laravel adalah framework PHP yang ekspresif dan elegan...',
        ]);

        Content::create([
            'course_id' => $courseLaravel->id,
            'title' => 'Instalasi & Konfigurasi',
            'body' => 'Cara install via Composer: composer create-project laravel/laravel...',
        ]);


        Enrollment::create([
            'student_id' => $student->id,
            'course_id' => $courseLaravel->id,
            'enrolled_at' => now(),
        ]);
    }
}