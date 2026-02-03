<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\InstructorDetails;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Instructor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'instructor';
    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;
    const STATUS_REJECTED = 2;

    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'role_id', 
        'status', 
        'marketing_opt_in'
    ];

    // Important for security: Hide password and remember_token
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Important for password hashing consistency
    protected $casts = [
        'password' => 'hashed',
        'email_verified_at' => 'datetime',
    ];
    public function isApproved(): bool
    {
        return (int) $this->status === self::STATUS_APPROVED;
    }
    public function isPending(): bool
    {
        return (int) $this->status === self::STATUS_PENDING;
    }
    public function isRejected(): bool
    {
        return (int) $this->status === self::STATUS_REJECTED;
    }
    public function canAccessDashboard()
    {
        return $this->isApproved();
    }

    public function details()
    {
        return $this->hasOne(InstructorDetails::class, 'instructor_id', 'id');
    }
}
