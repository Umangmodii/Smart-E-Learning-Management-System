<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Course;
class NewCourseUploaded extends Mailable
{
    use Queueable, SerializesModels;
    public $course;
    public function __construct(Course $course)
    {
        $this->course = $course;
    }
  
    public function build()
    {
        return $this->subject('New Course Uploaded: ' . $this->course->title)
                    ->view('emails.new_course');
    }
}
