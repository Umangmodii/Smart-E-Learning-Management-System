<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Validator;

class BannerApiController extends Controller
{
    // Fetch all active banners
    public function fetch_banner(){
        $banner_list = Banner::where('status', 1);
        $banners = $banner_list->orderBy('order_priority', 'asc')->get();

        if ($banners->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No active banners found'
            ], 404);
        }

        else{
            return response()->json([
                'status' => 'success',
                'count'   => $banners->count(),
                'data' => $banners
            ],200);
        }
    }

    // Store a new banner
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            // 'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'order_priority' => 'required|integer',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('banners', 'public');
        }

        $banner = Banner::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            // 'image' => $path, 
            'button_text' => $request->button_text,
            'button_url' => $request->button_url,
            'order_priority' => $request->order_priority,
            'status' => $request->status
        ]);

        return response()->json([
            'message' => 'Banner Created Successfully', 
            'data' => $banner
        ], 201);
    }
}