<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Course;
class Search extends Component
{
    public $search = '';
    public function render()
    {
        $results = [];

        if (strlen($this->search) >= 2) {
            $results = Course::where('title', 'like', '%' . $this->search . '%')
                ->where('status', 2) // Assuming 2 = Published
                ->with(['category', 'instructor'])
                ->take(6)
                ->get();
        }

        return view('livewire.search', [
            'results' => $results
        ]);
    }
}