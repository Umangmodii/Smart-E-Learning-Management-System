<?php

namespace App\Livewire\Admin;

use App\Models\Instructor;
use Livewire\Component;
use Livewire\WithPagination;
class ActiveInstructors extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $instructors = Instructor::where('status','1')
        ->latest()
        ->paginate(10);

       return view('livewire.admin.active-instructors', [
            'instructors' => $instructors
        ])->layout('layouts.admin.main', ['title' => 'Active Instructors']);
    }
}
