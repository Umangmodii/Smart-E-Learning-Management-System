<?php
namespace App\Livewire;

use Livewire\Component;
use Exception;
use Livewire\WithFileUploads;

class EditProfile extends Component
{
    public $breadcrumbs = [];

    use WithFileUploads;
    public $dob, $gender, $country, $city, $language, $bio, $avatar, $phone;

    public function mount()
    {
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Edit Profile', 'url' => null],
        ];

        if (auth()->check()) {
        $profile = auth()->user()->profile; 

        if ($profile) {
            $this->fill($profile->toArray());
        }
        } else {
            return redirect()->route('login');
        }
    }

    public function updateProfile()
    {
        try {
            // $this->validate([
            //     'avatar' => 'nullable|image|max:1024'
            // ]);   

            $data = $this->only([
                'dob', 'gender', 'country', 'city', 'language', 'bio', 'phone','avatar'
            ]);

            if ($this->avatar && !is_string($this->avatar)) {
                // This stores the file in storage/app/public/images
                $data['avatar'] = $this->avatar->store('images', 'public');
            }

            // dd($data);

            auth()->user()->profile()->updateOrCreate(
                ['user_id' => auth()->id()],
                $data
            );

            session()->flash('success', 'Profile updated successfully!');
        } catch (Exception $e) {
            session()->flash('error', 'Error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.dashboard')
            ->layout('layouts.app',['title' => 'Profile']);
    }
}