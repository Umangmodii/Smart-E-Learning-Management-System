<?php

namespace App\Livewire\Instructor;

use Livewire\Component;

class DashboardController extends Component
{
    public $breadcrumbs = [];

    public function mount()
    {
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Dashboard', 'url' => null],
        ];
    }
    public function render()
    {
        return view('livewire.instructor.dashboard')
        ->layout('layouts.instructor.dashboard',['title' => 'Instructor Dashboard']);
    }
}
