<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lesson_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_id')->constrained('enrollments')->onDelete('cascade');
            $table->foreignId('content_id')->constrained('contents')->onDelete('cascade');
            $table->timestamp('completed_at')->useCurrent();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('lesson_progress');
    }
};