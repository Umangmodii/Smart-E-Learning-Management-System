<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\AdminCategory;
class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with('categories', AdminCategory::with('children')
                ->where(function($query) {
                    $query->whereNull('parent_id')
                        ->orWhere('parent_id', 0)
                        ->orWhere('parent_id', '');
                })
                // ->where('status', 1)
                ->orderBy('order_priority', 'asc')
                ->get());
        });
    }
}
