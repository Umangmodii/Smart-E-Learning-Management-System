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
        'approved_at',
        'short_description',
        'description',
        'price',
        'discount_price',
        'level',
        'language',
        'meta_keywords',
        'video_promo_path',~
        'total_duration',
        'is_published',
    ];
    
    protected $casts = [
        'submitted_at' => 'datetime',
        'approved_at' => 'datetime',
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'total_duration' => 'integer',
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

    // Course has many sections
    public function sections()
    {
        return $this->hasMany(CourseSection::class)->orderBy('order', 'asc');
    }

    // Course has many reviews
    public function reviews()
    {
        return $this->hasMany(CourseReview::class);
    }
}
