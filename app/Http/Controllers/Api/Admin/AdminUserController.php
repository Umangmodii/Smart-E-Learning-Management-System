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

    // For Admin Fetched Profile 
    public function admin_profile(){
        
        $admin_users = User::with('profile')
        ->where('role_id', '!=', 3)
        ->latest()
        ->get();

        if($admin_users->isEmpty()){
            return response()->json([
                'status' => false,
                'message' => 'Not admin found',
            ], 404);
        }

        if($admin_users){
            return response()->json([
                'status' => true,
                'message' => 'Admin Fetched Successfully',
                'users' => $admin_users
            ], 200);
        }
    }

    // For Admin Update Profile
    public function update_admin_profile(Request $request,$id)
    {   
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email'   => 'required|email|unique:users,email,' . $user->id,
            'phone'   => 'nullable|string|max:20',
            'bio'     => 'nullable|string',
            'avatar'  => 'nullable|image|max:1024', 
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Update Data
        $profileData = $request->only(['dob', 'gender', 'country', 'city', 'language', 'bio', 'phone']);

        // dd($profileData);

        if ($request->hasFile('avatar')) {
            $profileData['avatar'] = $request->file('avatar')->store('images', 'public');
        }

        // Sync with Profile Table
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $profileData
        );

        return response()->json([
            'status' => true,
            'message' => 'Admin Profile Updated Successfully.',
            'user' => $user->load('profile') 
        ], 200);
    }
}
