<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Profile extends Model
{
   use HasFactory;

   protected $table = 'users_profile';
   protected $fillable = [
        'user_id',
        'role_id',
        'dob',
        'gender',
        'country',
        'city',
        'language',
        'bio',
        'avatar',
        'phone'
    ];

    // One profile belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
