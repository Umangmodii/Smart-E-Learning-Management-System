<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Admin;
use App\Models\User;
use App\Models\Instructor;
use App\Models\Banner;
use App\Models\AdminCategory;
use App\Models\Course;
class AdminDashboard extends Component
{
    public $breadcrumbs = [];

    public function mount()
    {
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Dashboard', 'url' => null],
        ];
    }

    public function render()
    {
        $total_customer = User::where('role_id', 3)->count();
        $total_admin = Admin::where('role_id', 1)->count();
        $total_instructor = Instructor::where('role_id',2)->count();
        $total_category = AdminCategory::count();
        $total_banner = Banner::count();
        $total_course = Course::count();

         return view('livewire.admin.dashboard', [
            'totalCustomers' => $total_customer,
            'totalAdmin' => $total_admin,
            'totalInstructor' => $total_instructor,
            'totalCategory' => $total_category,
            'totalBanner' => $total_banner,
            'totalCourse' => $total_course,
         ])->layout('layouts.admin.main',['title' => 'Admin Dashboard']);
    }
}
