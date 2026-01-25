<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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

    //  Authorization Helpers
    public function isSuperAdmin()
    {
        // Use ?-> to prevent crashes if role is missing
        return $this->role?->name === 'super_admin';
    }

    public function isInstructor()
    {
        return $this->role?->name === 'instructor';
    }

    public function isStudent()
    {
        return $this->role?->name === 'student';
    }
}