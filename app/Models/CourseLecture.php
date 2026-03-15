<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class CourseLecture extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_section_id',
        'title',
        'video_path',
        'duration',
        'is_preview',
        'order',
    ];

    protected $casts = [
        'is_preview' => 'boolean',
    ];

    // Lecture belongs to a section
    public function section()
    {
        return $this->belongsTo(CourseSection::class, 'course_section_id');
    }
    // Optional: Access course directly through section
    public function course()
    {
        return $this->section->course();
    }
    // Format duration (seconds → mm:ss)
    public function getFormattedDurationAttribute()
    {
        return gmdate("i:s", $this->duration);
    }
}
