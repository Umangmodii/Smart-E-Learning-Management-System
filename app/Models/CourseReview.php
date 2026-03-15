<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class CourseReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'user_id',
        'rating',
        'review',
        'status',
    ];

    // Review belongs to a course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    
    // Review belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
