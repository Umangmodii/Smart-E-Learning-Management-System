<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseSection extends Model
{
    use hasFactory;
    protected $fillable = [
        'course_id',
        'title',
        'order',
    ];

    // Relationship to get the Course this section belongs to
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Section has many lectures
    public function lectures()
    {
        return $this->hasMany(CourseLecture::class)->orderBy('order', 'asc');
    } 
}
