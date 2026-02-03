<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    public function index(){
        $banners = Banner::where('status', 1)
        ->orderBy('order_priority', 'asc')
        ->get();

        return view('index', compact('banners'));
    }
}
