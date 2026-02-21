<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class About extends Component
{
    public function render()
    {
        return view('livewire.pages.about')
            ->layout('layouts.app', [
                'title' => 'About Us | Smart E-Learning Platform',
                'metaDescription' => 'Learn about Smart E-Learning, our mission, vision and commitment to providing high-quality online education in web development, programming and business.',
            ]);
    }
}
