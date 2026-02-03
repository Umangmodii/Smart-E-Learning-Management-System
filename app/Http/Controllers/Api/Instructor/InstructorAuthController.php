<?php

namespace App\Http\Controllers\Api\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Instructor;

class InstructorAuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:instructor',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $instructor = Instructor::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role_id'  => 2, // Instructor Role
            'status'   => 0, // Pending Approval
        ]);

        $instructor->details()->create([
            'headline' => 'New Instructor at Smart LMS'
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Registration successful. Please wait for admin approval.',
            'data'    => $instructor
        ],201);
    }

    public function login(Request $request){
        $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ]);

        $instructor = Instructor::where('email', $request->email)->first();

        if (!$instructor || !Hash::check($request->password, $instructor->password)) {
            return response()->json([
                'status'  => false,
                'message' => 'Invalid email or password.',
            ], 401);
        }

        if ($instructor->status != 1) {
            return response()->json([
                'status'  => false,
                'message' => 'Your account is not approved yet. Please wait for admin approval.',
            ], 403);
        }

        $token = $instructor->createToken('instructor_token')->plainTextToken;

        return response()->json([
            'status'  => true,
            'message' => 'Login successful.',
            'data'    => [
                'instructor' => $instructor,
                'token'      => $token,
            ],
        ], 200);
    }
}
