<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Banner as BannerModel;
use Illuminate\Support\Facades\Storage;

class Banner extends Component
{
    use WithFileUploads;

    public $title, $subtitle, $button_text, $button_url, $image, $order_priority = 0, $status = 1;
    public $editing_id = null;
    public $old_image;
    public $activeTab = 'manage';
    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        if($tab == 'manage') {
            $this->reset(['title', 'subtitle', 'button_text', 'button_url', 'image', 'editing_id', 'old_image']);
        }
    }

    public function toggleStatus($id)
    {
        $banner = BannerModel::findOrFail($id);
        $banner->status = !$banner->status;
        $banner->save();
        session()->flash('message', 'Status updated.');
    }

    public function store(){
        $validatedData = $this->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|url|max:255',
            'image' => 'nullable|image|max:2048', 
            'order_priority' => 'nullable|integer',
            'status' => 'boolean',
        ]);

       if ($this->image) {
            if ($this->old_image) {
                Storage::disk('public')->delete($this->old_image);
            }
            $validatedData['image'] = $this->image->store('banners', 'public');
        }

        if ($this->editing_id) {
            BannerModel::find($this->editing_id)->update($validatedData);
            session()->flash('message', 'Banner updated successfully.');
        } else {
            BannerModel::create($validatedData);
            session()->flash('message', 'Banner created successfully.');
        }

        $this->switchTab('manage');
    }

    public function delete($id)
    {
        $banner = BannerModel::findOrFail($id);
        if ($banner->image) {
            Storage::disk('public')->delete($banner->image);
        }
        $banner->delete();
        session()->flash('message', 'Banner deleted successfully.');
    }

    public function edit($id){
        $banner = BannerModel::findOrFail($id);

        $this->editing_id = $banner->id;
        $this->title = $banner->title;
        $this->subtitle = $banner->subtitle;
        $this->button_text = $banner->button_text;
        $this->button_url = $banner->button_url;
        $this->order_priority = $banner->order_priority;
        $this->status = $banner->status;
        $this->old_image = $banner->image;

        $this->activeTab = 'edit';
    }

    public function render()
    {
        return view('livewire.admin.banner', [
            'banners' => BannerModel::orderBy('order_priority', 'asc')->get()
        ])->layout('layouts.admin.main',['title' => 'Admin Banners']);
    }
}
