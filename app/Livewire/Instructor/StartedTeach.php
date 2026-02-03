<?php

namespace App\Livewire\Instructor;

use Livewire\Component;

class StartedTeach extends Component
{
    public $breadcrumbs = [];
    // Constructor livewire loaded
    public function mount()
    {
        // Define your breadcrumbs here dynamically
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Become a Instructor', 'url' => null],
        ];
    }
    public function render()
    {
        return view('livewire.instructor.started_teach')
            ->layout('layouts.instructor.main', ['title' => 'Become an Instructor']);
    }
}