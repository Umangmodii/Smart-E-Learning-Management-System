<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User_Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
    // For Fetch the GET Result
    public function show($user_id)
    {
        $profile = User_Profile::where('user_id', $user_id)->first();

        if(!$profile){
            return response()->json([
                'status' => 'error',
                'message' => 'Profile not found'
            ],404);
        }
            return response()->json([
                'status' => 'success',
                'message' => $profile
            ],200);
            
    }
    /**
     * Update profile via API
     */
   public function update(Request $request, $user_Id)
    {
        if (auth()->id() != $user_Id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized. You can only update your own profile.'
            ], 403);
        }

        $validated = $request->validate([
            'bio'    => 'nullable|string|max:500', 
            'dob'    => 'nullable|date',
            'city'   => 'nullable|string|max:100',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', 
        ]);

        $profile = User_Profile::where('user_id', $user_Id)->firstOrFail();

        if ($request->hasFile('avatar')) {
            if ($profile->avatar) {
                Storage::disk('public')->delete($profile->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $profile->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Profile updated successfully',
            'data' => $profile
        ]);
    }
}

