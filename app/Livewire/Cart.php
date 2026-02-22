<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Course;

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

        $this->recommendedCourses = Course::where('status', 2) // Assuming 2 is active/published
            ->with(['instructor', 'category'])
            ->latest()
            ->take(5)
            ->get();
    }
    public function loadCart()
    {
        $this->cart = session()->get('cart', []);
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