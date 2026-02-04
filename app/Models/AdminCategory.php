<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class AdminCategory extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'name', 'slug', 'parent_id', 'created_by', 'status', 'order_priority'
    ];

    // Relationship to get the Parent Category   
    public function parent()
    {
        return $this->belongsTo(AdminCategory::class, 'parent_id');
    }

    // Relationship to get Child Categories
    public function children()
    {
        return $this->hasMany(AdminCategory::class, 'parent_id')
        ->orderBy('order_priority', 'asc')
        ->where('status', 1);
    }
    
    // Relationship to get the Admin who created the category
    public function creator()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    // Relationship to get courses under this category
    public function courses()
    {
        return $this->hasMany(Course::class, 'category_id');
    }
}
