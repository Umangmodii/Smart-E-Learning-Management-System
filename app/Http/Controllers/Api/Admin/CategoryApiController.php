<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminCategory;
class CategoryApiController extends Controller
{
    // Fetch Categories
    public function index(){
            $categories = AdminCategory::with(['children' => function($query) {
                $query->where('status', 1)->orderBy('order_priority', 'asc');
            }])
            ->whereNull('parent_id') // Only Root Categories
            ->where('status', 1)    // Only Active (Admin '1' status)
            ->orderBy('order_priority', 'asc')
            ->get();

            return response()->json([
                'status' => 'success',
                'count'   => 'Categories retrieved successfully',
                'data' => $categories
            ],200);
    }
}
