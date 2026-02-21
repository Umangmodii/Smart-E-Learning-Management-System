<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Contact extends Component
{
    public function render()
    {
        return view('livewire.pages.contact')
            ->layout('layouts.app', [
                'title' => 'Contact Us | Smart E-Learning Platform',
                'metaDescription' => 'Get in touch with Smart E-Learning for course support, business inquiries and general assistance. We are here to help you grow.',
            ]);
    }
}
