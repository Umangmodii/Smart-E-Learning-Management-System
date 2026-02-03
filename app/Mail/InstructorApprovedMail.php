<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Instructor;

class InstructorApprovedMail extends Mailable
{
    use Queueable, SerializesModels;
    public $instructor;

    public function __construct(Instructor $instructor)
    {
        $this->instructor = $instructor;
    }
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to Smart LMS - Application Approved!',
        );
    }   
    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.instructor_approved',
            with: [
                'instructorName' => $this->instructor->name,
            ],
        );
        
    }
}
