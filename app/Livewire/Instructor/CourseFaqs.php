<?php

namespace App\Livewire\Instructor;

use Livewire\Component;
use App\Models\CourseFaq;
class CourseFaqs extends Component
{  
    public $breadcrumbs = [];
    public $approvedFaqs;
    public $pendingFaqs;
    public $answer;
    public $faqId;
    public function mount()
    {
        $this->loadFaqs();
        
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Manage Course FAQs', 'url' => null],
        ];
    }
    public function loadFaqs()
    {
        $this->approvedFaqs = CourseFaq::with('course')->where('status', 1)->latest()->get();
        $this->pendingFaqs  = CourseFaq::with('course')->where('status', 0)->latest()->get();
    }

    public function reply($id)
    {
        $faq = CourseFaq::findOrFail($id);

        $this->faqId = $faq->id;
        $this->answer = $faq->answer;
    }

    public function approve()
    {
        $this->validate([
            'answer' => 'required|min:5'
        ]);

        $faq = CourseFaq::findOrFail($this->faqId);
        $faq->answer = $this->answer;
        $faq->status = 1;
        $faq->save();

        $this->reset(['answer', 'faqId']);
        $this->loadFaqs();

        session()->flash('message', 'FAQ approved successfully');
    }

    public function reject($id)
    {
        CourseFaq::findOrFail($id)->delete();

        $this->loadFaqs();

        session()->flash('message','FAQ rejected');
    }
    public function render()
    {
        return view('livewire.instructor.course-faqs')
        ->layout('layouts.instructor.dashboard',['title' => 'Course FAQs']);
    }
}
