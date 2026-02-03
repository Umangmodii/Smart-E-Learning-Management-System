<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Instructor;
use App\Mail\InstructorApprovedMail;
use Illuminate\Support\Facades\Mail;

class PendingRequests extends Component
{
    public $breadcrumbs = [];
    public function mount()
    {
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Admin Pending Request ', 'url' => null],
        ];
    }
    public function render()
    {
        $pendingInstructors = Instructor::with('details')
            ->where('status', '0')
            ->latest()
            ->get();

       return view('livewire.admin.pending_requests', [
            'instructors' => $pendingInstructors
        ])->layout('layouts.admin.main', ['title' => 'Admin Pending Request']);
    }
    public function approve($id)
    {
        $instructor = Instructor::findOrFail($id);
        $instructor->update(['status' => '1']);

        try{

            // Here is where you would trigger the Approval Email
            Mail::to($instructor->email)->send(new InstructorApprovedMail($instructor));

            session()->flash('success', 'Instructor approved and welcome email sent!');

            $this->dispatch('swal:toast', [
            'type'    => 'success',
            'title'   => 'Instructor Approved!',
            'text'    => "Success! A welcome email has been sent to {$instructor->name}.",
        ]);
        }
        catch(Exception $e){
                $this->dispatch('swal:toast', [
                'type'    => 'warning',
                'title'   => 'Approved with Warning',
                'text'    => 'Status updated, but the email could not be sent.',
            ]);
        }
    }
    
    public function reject($id)
    {
        $instructor = Instructor::findOrFail($id);
        $instructor->update(['status' => '2']);

        session()->flash('error', 'Instructor application rejected.');
    }
}
