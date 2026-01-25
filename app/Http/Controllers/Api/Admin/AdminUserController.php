<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    // Access Token for Admin
    public function adminLogin(Request $request){
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email',$request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Admin Login Credentials'
            ], 401);
        }

        // Create the Bearer Token
        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Admin Logged In Successfully.',
            'token' => $token,
            'user' => $user,
        ], 200);
    }

    // For fetched only admin users
    public function admin_users()
    {
        if(!auth('sanctum')->user()->isSuperAdmin()) {
            return response()->json([
                'status' => false,
                'message' => 'Access Denied.'
            ], 403);
        }

        $admins = User::where('role_id', 1)
            ->latest()
            ->get();

        return response()->json([
            'status' => 'true',
            'message' => 'Admin Staff Fetched Successfully.',
            'data' => $admins
        ], 200);
    }
}
