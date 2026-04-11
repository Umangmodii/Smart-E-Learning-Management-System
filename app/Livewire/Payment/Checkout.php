<?php

namespace App\Livewire\Payment;

use Livewire\Component;
use Nnjeim\World\World;
use Razorpay\Api\Api;
use App\Models\Orders;
use App\Models\Payments;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
class Checkout extends Component
{
    public $breadcrumbs = [];    
    public $country_id;
    public $state_id;
    public $city_id;
    public $countries = [];
    public $states = [];
    public $cities = [];
    public $cart = [];
    public $totalPrice = 0;
    public $course_id;
    public function mount()
    {
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Checkout', 'url' => null],
        ];

        $this->countries = World::countries()->data->toArray();
        $this->loadCart();

        if (!empty($this->cart)) {
        $this->course_id = $this->cart[0]['id']; 
    }
    }

    public function loadCart()
    {
        $sessionCart = session()->get('cart', []);
        
        $this->cart = [];
        $this->totalPrice = 0;

        if (!empty($sessionCart)) {
            $courseIds = array_keys($sessionCart);
            $courses = Course::whereIn('id', $courseIds)->get();

            foreach ($courses as $course) {
                $this->cart[] = [
                    'id' => $course->id,
                    'name' => $course->course_title, 
                    'price' => $sessionCart[$course->id]['price'] ?? $course->selling_price,
                ];
            }

            // echo '<pre>';
            // print_r($this->cart);
            // echo '</pre>';

            $this->totalPrice = array_sum(array_column($this->cart, 'price'));
        }
    }

    public function updatedCountryId($value)
    {
        if (!$value) {
            $this->reset(['states', 'cities', 'state_id', 'city_id']);
            return;
        }

        $this->states = World::states([
            'filters' => ['country_id' => $value]
        ])->data->toArray();
        
        $this->cities = [];
        $this->state_id = null;
        $this->city_id = null;
    }

    public function updatedStateId($value)
    {
        if (!$value) {
            $this->cities = [];
            $this->city_id = null;
            return;
        }

        $this->cities = World::cities([
            'filters' => ['state_id' => $value]
        ])->data->toArray();
        
        $this->city_id = null;
    }
   public function processPayment()
{
    $user = Auth::user();
    $course = Course::findOrFail($this->course_id);

    if (!$this->country_id || !$this->state_id || !$this->city_id) {
        $this->dispatch('error', message: 'Please select address');
        return;
    }

    $exists = Orders::where('user_id', $user->id)
        ->where('course_id', $course->id)
        ->whereHas('payment', fn($q) => $q->where('status', 'success'))
        ->exists();

    if ($exists) {
        $this->dispatch('error', message: 'Already purchased');
        return;
    }

    try {
        $api = new Api(config('razorpay.key'), config('razorpay.secret'));

        $sessionCart = session()->get('cart', []);
        
        $finalPrice = isset($sessionCart[$course->id]['price']) 
                      ? $sessionCart[$course->id]['price'] 
                      : ($course->selling_price ?? $course->price);
    
        $amountInPaise = $finalPrice * 100;

        $razorpayOrder = $api->order->create([
            'receipt' => 'order_' . time(),
            'amount' => $amountInPaise,
            'currency' => 'INR'
        ]);

        $order = Orders::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'country' => $this->country_id,
            'state' => $this->state_id,
            'city' => $this->city_id,
        ]);

        Payments::create([
            'order_id' => $order->id,
            'payment_method' => 'razorpay',
            'transaction_id' => $razorpayOrder['id'],
            'amount' => $finalPrice,
            'status' => 'pending'
        ]);

        // echo '<pre>';
        //     print_r($razorpayOrder);
        // echo '</pre>';
        // die;

        $this->dispatch('startRazorpay', [
            'key' => config('razorpay.key'),
            'amount' => $amountInPaise,
            'order_id' => $razorpayOrder['id'],
            'name' => $course->course_title 
        ]);
        
    } catch (\Exception $e) {
        $this->dispatch('error', message: 'Razorpay Error: ' . $e->getMessage());
    }
}
    public function render()
    {
        return view('livewire.payment.checkout')
            ->layout('layouts.app');
    }
}