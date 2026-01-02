<?php

// namespace App\Livewire\Admin;

// use App\Models\ImgFeature;
// use Livewire\Component;
// use Livewire\WithFileUploads;

// class ImgFeatureFrom extends Component
// {
//     use WithFileUploads;

//     public $title, $subtitle, $image, $feature_id, $existingImage;
//     public $is_active = 1;
//     public $updateMode = false;

//     protected $rules = [
//         'title' => 'required|string|max:255',
//         'subtitle' => 'nullable|string|max:255',
//         'image' => 'nullable|image|max:2048',
//         'is_active' => 'required|boolean',
//     ];

//     public function save()
//     {
//         $this->validate();

//         $imagePath = $this->existingImage;

//         if ($this->image) {
//             $imagePath = $this->image->store('features', 'public');
//         }

//         ImgFeature::updateOrCreate(
//             ['id' => $this->feature_id],
//             [
//                 'title' => $this->title,
//                 'subtitle' => $this->subtitle,
//                 'image' => $imagePath,
//                 'is_active' => $this->is_active,
//             ]
//         );

//         session()->flash('success', 'Feature saved successfully');
//         $this->resetForm();
//     }

//     public function edit($id)
//     {
//         $feature = ImgFeature::findOrFail($id);

//         $this->feature_id = $feature->id;
//         $this->title = $feature->title;
//         $this->subtitle = $feature->subtitle;
//         $this->existingImage = $feature->image;
//         $this->is_active = $feature->is_active;
//         $this->updateMode = true;
//     }

//     public function delete($id)
//     {
//         ImgFeature::findOrFail($id)->delete();
//         session()->flash('success', 'Feature deleted successfully');
//     }

//     public function resetForm()
//     {
//         $this->reset([
//             'title',
//             'subtitle',
//             'image',
//             'feature_id',
//             'existingImage',
//             'is_active'
//         ]);

//         $this->is_active = 1;
//         $this->updateMode = false;
//     }

//     public function render()
//     {
//         $features = ImgFeature::get();
//         return view('livewire.admin.img-feature-from', compact('features'));
//     }
// }

//new code updated by storage link cPanel

namespace App\Livewire\Admin;

use App\Models\ImgFeature;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImgFeatureFrom extends Component
{
    use WithFileUploads;

    public $title, $subtitle, $image, $feature_id, $existingImage;
    public $is_active = 1;
    public $updateMode = false;

    protected $rules = [
        'title' => 'required|string|max:255',
        'subtitle' => 'nullable|string|max:255',
        'image' => 'nullable|image|max:2048',
        'is_active' => 'required|boolean',
    ];

    public function save()
    {
        $this->validate();

        $imagePath = $this->existingImage;

        if ($this->image) {
            // Delete old image if exists
            if ($this->existingImage && file_exists(public_path('storage/features/'.$this->existingImage))) {
                unlink(public_path('storage/features/'.$this->existingImage));
            }

            // Upload new image via helper
            $imagePath = imageUpload($this->image, 'features');
        }

        ImgFeature::updateOrCreate(
            ['id' => $this->feature_id],
            [
                'title' => $this->title,
                'subtitle' => $this->subtitle,
                'image' => $imagePath,
                'is_active' => $this->is_active,
            ]
        );

        session()->flash('success', 'Feature saved successfully');
        $this->resetForm();
    }

    public function edit($id)
    {
        $feature = ImgFeature::findOrFail($id);

        $this->feature_id = $feature->id;
        $this->title = $feature->title;
        $this->subtitle = $feature->subtitle;
        $this->existingImage = $feature->image;
        $this->image = null; // reset temporary upload
        $this->is_active = $feature->is_active;
        $this->updateMode = true;
    }

    public function delete($id)
    {
        $feature = ImgFeature::findOrFail($id);

        // Delete image from storage if exists
        if ($feature->image && file_exists(public_path('storage/features/'.$feature->image))) {
            unlink(public_path('storage/features/'.$feature->image));
        }

        $feature->delete();
        session()->flash('success', 'Feature deleted successfully');
    }

    public function resetForm()
    {
        $this->reset([
            'title',
            'subtitle',
            'image',
            'feature_id',
            'existingImage',
            'is_active',
            'updateMode'
        ]);

        $this->is_active = 1;
        $this->updateMode = false;
    }

    public function render()
    {
        $features = ImgFeature::latest()->get();
        return view('livewire.admin.img-feature-from', compact('features'));
    }
}
