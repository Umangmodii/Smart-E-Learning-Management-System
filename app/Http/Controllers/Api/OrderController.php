<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
class OrderController extends Controller
{
    // For GET Request 
    public function getCustomerOrder(Request $request)
    {
        $orders = Orders::with('payment')
        ->where('user_id', auth()->id())
        ->get();

        if ($orders) {
            return response()->json([
                'status' => true,
                'message' => 'Course already purchased',
                'orders' => $orders
            ]);
        } else {
            return response()->json([
                'status' => false,
                'orders' => $orders,
                'message' => 'No orders found for this user'
            ]);
        }
    }
}
