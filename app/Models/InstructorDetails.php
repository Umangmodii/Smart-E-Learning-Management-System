<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Instructor;

class InstructorDetails extends Model
{
    protected $table = 'instructor_details';

    protected $fillable = [
        'instructor_id', 
        'avatar', 
        'headline', 
        'bio', 
        'website', 
        'facebook_url', 
        'instagram_url', 
        'linkedin_url', 
        'youtube_url', 
    ];
    // One to many
    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id', 'id');
    }
}
