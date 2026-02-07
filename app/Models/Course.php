<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\AdminCategory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
       'category_id',
        'user_id',
        'approved_by',
        'title',
        'slug',
        'short_description',
        'description',
        'thumbnail',
        'price',
        'status', // 0:Draft, 1:Pending, 2:Published, 3:Rejected
        'admin_feedback',
        'submitted_at',
        'approved_at'
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    /**
     * The Instructor who created the course.
     */
    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'user_id');
    }

    /**
     * The Category this course belongs to.
     */
     public function category()
    {
        return $this->belongsTo(AdminCategory::class, 'category_id');
    }

    /**
    * The Admin who approved the course.
    */
    public function approver()
    {
        return $this->belongsTo(Admin::class, 'approved_by');
    }

    // For status scopes
    public function scopePublished($query)
    {
        return $query->where('status', 2);
    }
    public function scopePending($query)
    {
        return $query->where('status', 1);
    }
    
    // Accessor for status badge
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            0 => 'secondary', // Draft
            1 => 'warning',   // Pending
            2 => 'success',   // Published
            3 => 'danger',    // Rejected
            default => 'dark',
        };
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            0 => 'Draft',
            1 => 'Review',
            2 => 'Live',
            3 => 'Rejected',
            default => 'Unknown',
        };
    }
}
