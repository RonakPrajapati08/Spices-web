<?php

// namespace App\Livewire\Admin;

// use App\Models\HomeSliderModel;
// use Livewire\Component;
// use Livewire\WithFileUploads;

// class HomeSlider extends Component
// {
//     use WithFileUploads;

//     public $title, $subtitle, $image, $slider_id, $existingImage;
//     public $is_active = 1;

//     protected $rules = [
//         'title'     => 'required|string|max:255',
//         'subtitle'  => 'nullable|string|max:255',
//         'image'     => 'nullable|image|max:2048',
//         'is_active' => 'required|boolean',
//     ];


//     public function save()
//     {
//         $this->validate();

//         $slider = HomeSliderModel::find($this->slider_id);

//         $imagePath = $slider?->image;

//         if ($this->image) {
//             $imagePath = $this->image->store('sliders', 'public');
//         }

//         HomeSliderModel::updateOrCreate(
//             ['id' => $this->slider_id],
//             [
//                 'title' => $this->title,
//                 'subtitle' => $this->subtitle,
//                 'image' => $imagePath ?? HomeSliderModel::find($this->slider_id)?->image,
//                 'is_active' => $this->is_active
//             ]
//         );

//         $this->resetForm();
//         session()->flash('success', 'Slider saved successfully');
//     }

//     public function edit($id)
//     {
//         $slider = HomeSliderModel::findOrFail($id);

//         $this->slider_id = $slider->id;
//         $this->title = $slider->title;
//         $this->subtitle = $slider->subtitle;
//         $this->is_active = $slider->is_active;
//         $this->existingImage = $slider->image;
//     }

//     public function delete($id)
//     {
//         HomeSliderModel::find($id)->delete();
//         session()->flash('success', 'Slider deleted');
//     }

//     public function resetForm()
//     {
//         $this->reset(['title', 'subtitle', 'image', 'slider_id', 'existingImage']);
//         $this->is_active = 1;
//     }

//     public function render()
//     {
//         $sliders = HomeSliderModel::latest()->get();

//         return view('livewire.admin.home-slider', compact('sliders'));
//     }
// }

//new cPanel with manually setup storage 

namespace App\Livewire\Admin;

use App\Models\HomeSliderModel;
use Livewire\Component;
use Livewire\WithFileUploads;

class HomeSlider extends Component
{
    use WithFileUploads;

    public $title, $subtitle, $image, $slider_id, $existingImage;
    public $is_active = 1;

    protected $rules = [
        'title'     => 'required|string|max:255',
        'subtitle'  => 'nullable|string|max:255',
        'image'     => 'nullable|image|max:2048',
        'is_active' => 'required|boolean',
    ];

    public function save()
    {
        $this->validate();

        $slider = HomeSliderModel::find($this->slider_id);

        $imagePath = $this->existingImage ?? null;

        if ($this->image) {
            // Delete old image if exists
            if ($this->existingImage && file_exists(public_path('storage/sliders/'.$this->existingImage))) {
                unlink(public_path('storage/sliders/'.$this->existingImage));
            }

            // Upload new image via helper
            $imagePath = imageUpload($this->image, 'sliders');
        }

        HomeSliderModel::updateOrCreate(
            ['id' => $this->slider_id],
            [
                'title' => $this->title,
                'subtitle' => $this->subtitle,
                'image' => $imagePath,
                'is_active' => $this->is_active
            ]
        );

        $this->resetForm();
        session()->flash('success', 'Slider saved successfully');
    }

    public function edit($id)
    {
        $slider = HomeSliderModel::findOrFail($id);

        $this->slider_id = $slider->id;
        $this->title = $slider->title;
        $this->subtitle = $slider->subtitle;
        $this->is_active = $slider->is_active;
        $this->existingImage = $slider->image;
        $this->image = null; // reset temporary upload
    }

    public function delete($id)
    {
        $slider = HomeSliderModel::findOrFail($id);

        // Delete image from storage
        if ($slider->image && file_exists(public_path('storage/sliders/'.$slider->image))) {
            unlink(public_path('storage/sliders/'.$slider->image));
        }

        $slider->delete();

        session()->flash('success', 'Slider deleted successfully');
    }

    public function resetForm()
    {
        $this->reset(['title', 'subtitle', 'image', 'slider_id', 'existingImage']);
        $this->is_active = 1;
    }

    public function render()
    {
        $sliders = HomeSliderModel::latest()->get();

        return view('livewire.admin.home-slider', compact('sliders'));
    }
}
