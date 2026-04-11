<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Orders;

class Orderhistory extends Component
{
    public $breadcrumbs = [];
    public $orders;
    public function mount()
    {
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Order History', 'url' => null],
        ];
  
        $this->orders = Orders::with('payment')
            ->where('user_id', auth()->id())
            ->get();

        // return compact('orders');

        // echo "<pre>";
        //     print_r($orders->toArray());
        //     die;
        // echo "</pre>";

    }
    public function render()
    {
        return view('livewire.orderhistory')
        ->layout('layouts.app',['title' => 'Order History']);
    }
}
