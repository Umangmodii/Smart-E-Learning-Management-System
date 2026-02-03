<?php

namespace App\Http\Controllers\Api\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InstructorDetails;

class InstructorProfile extends Controller
{
    public function getallprofile(){
        $profiles = InstructorDetails::with('instructor')->get();

        if ($profiles->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No instructor profiles found'
            ], 404);
        }

        $formatdata = $profiles->map(function ($profile) {
            return [
                'id' => $profile->id,
                'instructor_id' => $profile->instructor_id,
                'instructor_name' => $profile->instructor->name,
                'avatar' => $profile->avatar,
                'headline' => $profile->headline,
                'bio' => $profile->bio,
                'website' => $profile->website,
                'facebook_url' => $profile->facebook_url,
                'instagram_url' => $profile->instagram_url,
                'linkedin_url' => $profile->linkedin_url,
                'youtube_url' => $profile->youtube_url,
            ];
        });

        // echo "<pre>";
        //     print_r($formatdata);
        //     die;    
        // echo "</pre>";

        return response()->json([
            'status' => 'success',
            'count'   => $formatdata->count(),
            'records' => $formatdata
        ],200);
    }

    public function getinstructorprofile(Request $request, $instructor_id){
        $profile = InstructorDetails::with('instructor')->where('instructor_id', $instructor_id)->first();

        if (!$profile) {
            return response()->json([
                'status' => 'error',
                'message' => 'Instructor profile not found'
            ], 404);
        }

        $data = [
            'id' => $profile->id,
            'instructor_id' => $profile->instructor_id,
            'instructor_name' => $profile->instructor->name,
            'avatar' => $profile->avatar,
            'headline' => $profile->headline,
            'bio' => $profile->bio,
            'website' => $profile->website,
            'facebook_url' => $profile->facebook_url,
            'instagram_url' => $profile->instagram_url,
            'linkedin_url' => $profile->linkedin_url,
            'youtube_url' => $profile->youtube_url,
        ];

        return response()->json([
            'status' => 'success',
            'message' => $data
        ], 200);
    }
}
