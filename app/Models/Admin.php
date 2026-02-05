<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;
class Admin extends Authenticatable
{
    use Notifiable, HasFactory, HasApiTokens;
    protected $table = 'admin';
    protected $fillable = ['name', 'email', 'password', 'role_id'];
    protected $hidden = ['password'];

    // Check if this admin has the Super Admin role
    public function isSuperAdmin()
    {
        return $this->role_id === 1;
    }
    public function profile(): HasOne
    {
        // Adjust 'admin_id' if your profile table uses a different foreign key
        return $this->hasOne(User_Profile::class, 'user_id')->where('role_id', 1);
    }
}
