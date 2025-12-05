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

        $teacher1 = User::create([
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

        $catDesign = Category::create([
            'name' => 'UI/UX Design',
            'description' => 'Desain antarmuka aplikasi dan pengalaman pengguna.',
        ]);

        $catMarketing = Category::create([
            'name' => 'Digital Marketing',
            'description' => 'Strategi pemasaran digital dan SEO.',
        ]);

        $catSoftSkills = Category::create([
            'name' => 'Soft Skills',
            'description' => 'Pengembangan diri dan komunikasi.',
        ]);

        $courseLaravelOld = Course::create([
            'teacher_id' => $teacher1->id,
            'category_id' => $catWeb->id,
            'title' => 'Mastering Laravel 12',
            'description' => 'Panduan lengkap Laravel dari nol sampai mahir.',
            'start_date' => now(),
            'end_date' => now()->addMonths(3),
            'is_active' => true,
        ]);

        Content::create([
            'course_id' => $courseLaravelOld->id,
            'title' => 'Pengenalan Laravel',
            'body' => 'Laravel adalah framework PHP yang ekspresif dan elegan...',
        ]);

        Content::create([
            'course_id' => $courseLaravelOld->id,
            'title' => 'Instalasi & Konfigurasi',
            'body' => 'Cara install via Composer: composer create-project laravel/laravel...',
        ]);

        Enrollment::create([
            'student_id' => $student->id,
            'course_id' => $courseLaravelOld->id,
            'enrolled_at' => now(),
        ]);

        $newCourses = [
            [
                'title' => 'Mastering Laravel 11: From Zero to Hero',
                'category_id' => $catWeb->id,
                'description' => 'Pelajari framework PHP paling populer dengan studi kasus nyata membuat aplikasi e-learning lengkap.',
                'contents' => [
                    ['title' => 'Instalasi Environment', 'body' => 'Cara install XAMPP, Composer, dan setup project Laravel baru.'],
                    ['title' => 'Konsep MVC', 'body' => 'Penjelasan detail tentang Model, View, dan Controller serta alur routing.'],
                    ['title' => 'Database Migration & Eloquent', 'body' => 'Membuat tabel database tanpa menyentuh SQL manual menggunakan Migration.'],
                ]
            ],
            [
                'title' => 'Python for Data Analysis',
                'category_id' => $catData->id,
                'description' => 'Panduan lengkap menggunakan Python, Pandas, dan Matplotlib untuk mengolah data mentah.',
                'contents' => [
                    ['title' => 'Pengenalan Syntax Python Dasar', 'body' => 'Variabel, Tipe Data, Looping, dan Conditional Statement di Python.'],
                    ['title' => 'Manipulasi Data dengan Pandas', 'body' => 'Cara membaca file CSV, cleaning data, dan filtering dataframe.'],
                    ['title' => 'Visualisasi Data Dasar', 'body' => 'Membuat grafik batang dan garis menggunakan library Matplotlib.'],
                ]
            ],
            [
                'title' => 'Figma Masterclass: Desain Interface Modern',
                'category_id' => $catDesign->id,
                'description' => 'Belajar membuat desain aplikasi mobile yang user-friendly dan estetis menggunakan tools industri standar.',
                'contents' => [
                    ['title' => 'Prinsip Dasar Desain Visual', 'body' => 'Typography, Color Theory, dan Spacing system dalam desain UI.'],
                    ['title' => 'Wireframing & Prototyping', 'body' => 'Membuat kerangka kasar aplikasi dan menghubungkannya menjadi prototype yang bisa diklik.'],
                ]
            ],
            [
                'title' => 'SEO Fundamental 2025',
                'category_id' => $catMarketing->id,
                'description' => 'Teknik optimasi website agar muncul di halaman pertama Google tanpa harus membayar iklan.',
                'contents' => [
                    ['title' => 'Cara Kerja Search Engine', 'body' => 'Bagaimana Google melakukan crawling, indexing, dan ranking website.'],
                    ['title' => 'On-Page SEO Checklist', 'body' => 'Optimasi Judul, Meta Description, dan struktur Heading (H1-H6).'],
                ]
            ],
            [
                'title' => 'Public Speaking & Presentasi Efektif',
                'category_id' => $catSoftSkills->id,
                'description' => 'Hilangkan rasa gugup dan pelajari teknik menyusun materi presentasi yang memukau audiens.',
                'contents' => [
                    ['title' => 'Mengatasi Demam Panggung', 'body' => 'Teknik pernapasan dan mindset untuk mengubah gugup menjadi antusiasme.'],
                    ['title' => 'Struktur Presentasi yang Menjual', 'body' => 'Menggunakan teknik "Hook, Story, Offer" dalam menyusun slide.'],
                ]
            ],
        ];

        foreach ($newCourses as $index => $data) {
            
            $assignedTeacherId = ($index % 2 == 0) ? $teacher1->id : $teacher2->id;

            $course = Course::create([
                'teacher_id' => $assignedTeacherId, 
                'category_id' => $data['category_id'],
                'title' => $data['title'],
                'description' => $data['description'],
                'start_date' => now(),
                'end_date' => now()->addMonths(3),
                'is_active' => true,
            ]);

            foreach ($data['contents'] as $contentData) {
                Content::create([
                    'course_id' => $course->id,
                    'title' => $contentData['title'],
                    'body' => $contentData['body'],
                ]);
            }
        }
    }
}