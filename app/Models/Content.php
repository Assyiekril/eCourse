<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'body',
    ];


    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }


    public function completions(): HasMany
    {
        return $this->hasMany(LessonProgress::class);
    }
}