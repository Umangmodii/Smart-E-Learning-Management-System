<?php

namespace App\Livewire\Instructor;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Orders;

class Revenue extends Component
{
    public $breadcrumbs = [];
    public $orders = [];
    public $totalRevenue = 0;
    public $totalOrders = 0;
    public $totalStudents = 0;

    public function mount()
    {
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Revenue', 'url' => null],
        ];

        $instructorId = Auth::id();

        $this->orders = Orders::with(['user', 'course', 'payment'])
            ->whereHas('course', function ($q) use ($instructorId) {
                $q->where('user_id', $instructorId);
            })
            ->latest()
            ->get();

        // echo "<pre>";
        //     echo print_r($this->orders->toArray());
        //     die;
        // echo "</pre>";

        $this->totalRevenue = $this->orders->sum(function ($order) {
            return optional($order->payment)->status === 'success'
                ? $order->payment->amount
                : 0;
        });

        $this->totalOrders = $this->orders->count();

        $this->totalStudents = $this->orders
            ->filter(fn($o) => optional($o->payment)->status === 'success')
            ->pluck('user_id')
            ->unique()
            ->count();
    }

    public function render()
    {
    return view('livewire.instructor.revenue')
            ->layout('layouts.instructor.dashboard', ['title' => 'Instructor Revenue']);
    }
}