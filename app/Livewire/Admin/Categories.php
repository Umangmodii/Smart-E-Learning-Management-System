<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Computed; // ADD THIS
use App\Models\AdminCategory as Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Categories extends Component
{
    public $activeTab = 'manage'; 
    public $name, $parent_id, $status = 1, $order_priority = 0;
    public $editing_id = null;
    public $breadcrumbs = [];

    public function mount(){
        $this->breadcrumbs = [
            ['label' => 'Dashboard', 'url' => url('/dashboard')],
            ['label' => 'Admin Categories', 'url' => null],
        ];
    }

    // FIX: Add Computed Attribute so you can use $this->parent_name in Blade
    #[Computed]
    public function parent_name()
    {
        return $this->parent_id ? Category::find($this->parent_id)?->name : '';
    }

    #[Computed]
    public function parent_slug()
    {
        return $this->parent_id ? Category::find($this->parent_id)?->slug : '';
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        if($tab !== 'edit') {
            $this->reset(['name', 'parent_id', 'editing_id', 'order_priority', 'status']);
        }
        $this->resetValidation();
    }
    
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->editing_id = $category->id;
        $this->name = $category->name;
        $this->parent_id = $category->parent_id;
        $this->order_priority = $category->order_priority;
        $this->status = $category->status;
        
        $this->activeTab = 'edit';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $this->editing_id,
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        try {
            $data = [
                'name'           => $this->name,
                'slug'           => Str::slug($this->name),
                'parent_id'      => $this->parent_id ?: null, 
                'status'         => $this->status,
                'order_priority' => $this->order_priority,
            ];

            if ($this->editing_id) {
                Category::find($this->editing_id)->update($data);
                session()->flash('success', 'Category updated successfully!');
            } else {
                $data['created_by'] = Auth::guard('admin')->id();
                Category::create($data);
                session()->flash('success', 'New category deployed successfully!');
            }

            $this->switchTab('manage');
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function toggleStatus($id)
    {
        $category = Category::findOrFail($id);
        $category->status = !$category->status;
        $category->save();
        session()->flash('success', 'Status updated.');
    }

    public function render()
    {
        return view('livewire.admin.categories', [
            'categories' => Category::with('children')
                ->whereNull('parent_id')
                ->orderBy('order_priority', 'asc')
                ->get(),
            'parentCategories' => Category::whereNull('parent_id')
                ->when($this->editing_id, fn($q) => $q->where('id', '!=', $this->editing_id))
                ->get(),
        ])->layout('layouts.admin.main', ['title' => 'Admin Categories']);
    }
}