<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class AdminProfile extends Component
{
    public $breadcrumbs = [];
    
    use WithFileUploads;
    public $name, $email, $role_id;
    public $dob, $gender, $country, $city, $language, $bio, $phone, $avatar, $current_avatar;
    public function mount()
    {
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/admin/dashboard')],
            ['label' => 'Admin Profile', 'url' => null],
        ];
  
        $user = Auth::user();

        $this->name = $user->name;
        $this->email = $user->email;
        $this->city = $user->city;
        $this->language = $user->language;
        $this->dob = $user->dob;
        $this->gender = $user->gender;
        $this->role_id = $user->role_id;

        $profile = $user->profile; 

        if($profile){
            $this->fill($profile->toArray());
            $this->current_avatar = $profile->avatar; 
        }
    }

    public function render()
    {
        return view('livewire.admin.admin-profile')
        ->layout('layouts.admin.main',['title' => 'Admin Profile']);
    }

    public function updateProfile(){
         try {
            // $this->validate([
            //     'avatar' => 'nullable|image|max:1024'
            // ]);   

            $admin = Auth::guard('admin')->user();

            $admin->update([
                 'name' => $this->name,
                 'gender' => $this->gender,
                 'dob' => $this->dob,
                 'language' => $this->language,
                 'phone' => $this->phone,
            ]);

            $data = $this->only([
                'dob', 'gender', 'country', 'city', 'language', 'bio', 'phone','avatar'
            ]);

            $data['role_id'] = 1;

            // dd($data);

            if ($this->avatar && !is_string($this->avatar)) {
                // This stores the file in storage/app/public/images
                $data['avatar'] = $this->avatar->store('images', 'public');
            }

            // dd($data);
            $admin->profile()->updateOrCreate(
            [
                'user_id' => $admin->id,
                'role_id' => 1,
                ],
            $data
            );

           $this->dispatch('profile-updated', [
            'message' => 'Admin Profile updated Successfully!',
            'type' => 'success'
        ]);

    } catch (\Exception $e) {
        $this->dispatch('profile-updated', [
            'message' => 'Error: ' . $e->getMessage(),
            'type' => 'error'
        ]);
    }
  }
    public function logout(Request $request) 
    {
        Auth::guard('web')->logout(); 

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login')->with('success', 'You have been logged out.');
    }
}
