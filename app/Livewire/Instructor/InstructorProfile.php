<?php

namespace App\Livewire\Instructor;

use Exception;
use Livewire\Component;
use App\Models\InstructorDetails;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class InstructorProfile extends Component
{
    use WithFileUploads;

    public $avatar, $headline, $bio, $website, $facebook_url, $instagram_url, $linkedin_url, $youtube_url;
    public $current_avatar; 
    public $breadcrumbs = [];

    public function mount()
    {
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/instructor/dashboard')],
            ['label' => 'Profile', 'url' => null],
        ];

        $details = InstructorDetails::where('instructor_id', Auth::guard('instructor')->id())->first();

        if($details){
            $this->fill($details->toArray());
            $this->current_avatar = $details->avatar; 
        }   
    }

    public function instructor_profile()
    {
        try {
            $this->validate([
                'headline' => 'nullable|string|max:255',
                'bio' => 'nullable|string',
                'avatar' => 'nullable|image|max:2048', 
                'website' => 'nullable|url',
                'facebook_url' => 'nullable|url',
                'instagram_url' => 'nullable|url',
                'linkedin_url' => 'nullable|url',
                'youtube_url' => 'nullable|url',
            ]);

            $instructorId = Auth::guard('instructor')->id();

            $data = [
                'headline' => $this->headline,
                'bio' => $this->bio,
                'website' => $this->website,
                'facebook_url' => $this->facebook_url,
                'instagram_url' => $this->instagram_url,
                'linkedin_url' => $this->linkedin_url,
                'youtube_url' => $this->youtube_url,
            ];
            
            if ($this->avatar) {
                $data['avatar'] = $this->avatar->store('images', 'public');
                $this->current_avatar = $data['avatar'];
            }

            InstructorDetails::updateOrCreate(
                ['instructor_id' => $instructorId],
                $data
            );

            session()->flash('success', 'Profile updated successfully!');
            $this->avatar = null;

        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e; 
        } catch (\Exception $e) {
            session()->flash('error', 'Database Error: ' . $e->getMessage());
        }   
    }

    public function render()
    {
        return view('livewire.instructor.profile')
            ->layout('layouts.instructor.dashboard',['title' => 'Instructor Profile']);
    }
}