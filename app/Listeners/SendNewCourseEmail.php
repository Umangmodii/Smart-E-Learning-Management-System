<?php

namespace App\Listeners;

use App\Events\CourseUploaded;
use App\Mail\NewCourseUploaded;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
class SendNewCourseEmail
{
    public function handle(CourseUploaded $event)
    {
        $course = $event->course;

        User::chunk(100, function ($users) use ($course) {
            foreach ($users as $user) {
                Mail::to($user->email)->queue(new NewCourseUploaded($course));
            }
        });
    }
}