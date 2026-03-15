<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Course;
use App\Models\CourseReview;
class Cart extends Component
{
    public $breadcrumbs = [];
    public $cart = [];
    public $totalPrice = 0;
    public $recommendedCourses = [];

    public function mount()
    {
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Shopping Cart', 'url' => null],
        ];

        $this->loadCart();

        $this->recommendedCourses = Course::where('status', 2)
            ->with(['instructor', 'category'])
            ->latest()
            ->take(5)
            ->get();
    }
    public function loadCart()
    {
        $this->cart = session()->get('cart', []);

       foreach ($this->cart as $id => $item) {
        $courseData = Course::with(['sections.lectures', 'reviews'])
            ->find($id);

        if ($courseData) {
            $approvedReviews = $courseData->reviews->where('status', 1);
            $this->cart[$id]['avg_rating'] = number_format($approvedReviews->avg('rating') ?: 0, 1);
            $this->cart[$id]['review_count'] = $approvedReviews->count();

            $this->cart[$id]['lecture_count'] = $courseData->sections->flatMap->lectures->count();

            $totalMinutes = $courseData->sections->flatMap->lectures->sum('duration');
            $this->cart[$id]['total_duration'] = round($totalMinutes / 60, 1);
        }
      }
        $this->totalPrice = array_sum(array_column($this->cart, 'price'));
    }
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        
        $this->loadCart();
        $this->dispatch('cartUpdated'); 
    }
    public function render()
    {
        return view('livewire.cart')
            ->layout('layouts.app', [
                'title' => 'Shopping Cart',
                'breadcrumbs' => $this->breadcrumbs
            ]);
    }
}