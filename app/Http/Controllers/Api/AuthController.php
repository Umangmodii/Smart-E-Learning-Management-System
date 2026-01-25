<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
class AuthController extends Controller
{
    // User Registration
    public function register(Request $request): JsonResponse {

        $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Create the Bearer Token

        return response()->json([
            'status' => true,
            'message' => 'User Registered Successfully',
            'user' => $user,
        ],201);
    }

    // User Login
    public function login(Request $request): JsonResponse{
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email',$request->email)->first();

        if (!$user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Login Credentials'
            ], 401);
        }

        // Create the Bearer Token
        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'User Logged In Successfully',
            'token' => $token,
            'user' => $user,
        ], 200);
    }

    // Fetch All Users
    public function fetchUsers() {
        
        $users = User::where('role_id', '!=', 1)->latest()->get();

        if($users->isEmpty()){
            return response()->json([
                'status' => false,
                'message' => 'No students found',
                'users' => []
            ], 404);
        }

        if($users){
            return response()->json([
                'status' => true,
                'message' => 'Users Fetched Successfully',
                'users' => $users
            ], 200);
        }
    }

    // Delete Profile / Logout
     public function logout(Request $request){

        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logged Out Successfully',
        ], 200);
    }
}
