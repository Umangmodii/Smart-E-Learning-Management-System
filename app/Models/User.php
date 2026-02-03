<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'provider',
        'provider_id',
        'oauth_token',
        'oauth_refresh_token',
        'avatar',
        'status',         
        'marketing_opt_in',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Automatic Role Assignment
     * This ensures no user ever has a NULL role_id.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (empty($user->role_id)) {
                $user->role_id = 3; // Default to Student (ID 3)
            }

            // if($user->role_id == 2){
            //     $user->status = self::STATUS_PENDING;
            // }
            // else{
            //     $user->status = self::STATUS_APPROVED;
            // }
        });
    }

    //  Relationship: A User belongs to ONE Role
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    //  Relationship: One User has one Profile
    public function profile()
    {   
        return $this->hasOne(User_Profile::class, 'user_id');
    }
    // For instructor and admin
    // public function instructorProfile()
    // {
    //     return $this->hasOne(InstructorProfile::class, 'user_id');
    // }
    public function isStudent()
    {
        return $this->role?->name === 'student';
    }
}