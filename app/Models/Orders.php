<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'course_id',
        'country',
        'state',
        'city'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function payment()
    {
        return $this->hasOne(Payments::class,'order_id');
    }
    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }
}
