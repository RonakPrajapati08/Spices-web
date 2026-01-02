<?php

// namespace App\Livewire\Admin;

// use App\Models\ProductPageHeroModel;
// use Livewire\Component;
// use Livewire\WithFileUploads;
// use Livewire\WithPagination;

// class ProductPageHeroForm extends Component
// {
//     use WithFileUploads, WithPagination;

//     public $hero_id;
//     public $bg_image, $existing_bg_image;
//     public $intro_img, $existing_intro_img;
//     public $heading, $description;
//     public $is_active = 1;
//     public $updateMode = false;

//     protected $rules = [
//         'heading' => 'required|string|max:150',
//         'description' => 'nullable|string',
//         'bg_image' => 'nullable|image|max:2048',
//         'intro_img' => 'nullable|image|max:2048',
//         'is_active' => 'required|boolean',
//     ];

//     public function resetFields()
//     {
//         $this->hero_id = null;
//         $this->bg_image = null;
//         $this->intro_img = null;
//         $this->existing_bg_image = null;
//         $this->existing_intro_img = null;
//         $this->heading = '';
//         $this->description = '';
//         $this->is_active = 1;
//         $this->updateMode = false;
//     }

//     public function store()
//     {
//         $data = $this->validate();

//         if ($this->is_active) {
//             ProductPageHeroModel::where('is_active', 1)->update(['is_active' => 0]);
//         }

//         if ($this->bg_image) {
//             $data['bg_image'] = $this->bg_image->store('product-hero', 'public');
//         }

//         if ($this->intro_img) {
//             $data['intro_img'] = $this->intro_img->store('product-hero', 'public');
//         }

//         ProductPageHeroModel::create($data);

//         session()->flash('message', 'Hero section created successfully.');
//         $this->resetFields();
//     }

//     public function edit($id)
//     {
//         $hero = ProductPageHeroModel::findOrFail($id);

//         $this->hero_id = $id;
//         $this->heading = $hero->heading;
//         $this->description = $hero->description;
//         $this->is_active = $hero->is_active;
//         $this->existing_bg_image = $hero->bg_image;
//         $this->existing_intro_img = $hero->intro_img;
//         $this->updateMode = true;
//     }

//     public function update()
//     {
//         $data = $this->validate();

//         if ($this->is_active) {
//             ProductPageHeroModel::where('is_active', 1)
//                 ->where('id', '!=', $this->hero_id)
//                 ->update(['is_active' => 0]);
//         }

//         if ($this->bg_image) {
//             $data['bg_image'] = $this->bg_image->store('product-hero', 'public');
//         } else {
//             $data['bg_image'] = $this->existing_bg_image;
//         }

//         if ($this->intro_img) {
//             $data['intro_img'] = $this->intro_img->store('product-hero', 'public');
//         } else {
//             $data['intro_img'] = $this->existing_intro_img;
//         }

//         ProductPageHeroModel::find($this->hero_id)->update($data);

//         session()->flash('message', 'Hero section updated successfully.');
//         $this->resetFields();
//     }

//     public function delete($id)
//     {
//         ProductPageHeroModel::find($id)->delete();
//         session()->flash('message', 'Hero deleted successfully.');
//     }
//     public function render()
//     {
//         $heros = ProductPageHeroModel::orderByDesc('created_at')->paginate(10);

//         return view('livewire.admin.product-page-hero-form', compact('heros'));
//     }
// }

// storage cPanel 

namespace App\Livewire\Admin;

use App\Models\ProductPageHeroModel;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ProductPageHeroForm extends Component
{
    use WithFileUploads, WithPagination;

    public $hero_id;
    public $bg_image, $existing_bg_image;
    public $intro_img, $existing_intro_img;
    public $heading, $description;
    public $is_active = 1;
    public $updateMode = false;

    protected $rules = [
        'heading' => 'required|string|max:150',
        'description' => 'nullable|string',
        'bg_image' => 'nullable|image|max:2048',
        'intro_img' => 'nullable|image|max:2048',
        'is_active' => 'required|boolean',
    ];

    public function resetFields()
    {
        $this->hero_id = null;
        $this->bg_image = null;
        $this->intro_img = null;
        $this->existing_bg_image = null;
        $this->existing_intro_img = null;
        $this->heading = '';
        $this->description = '';
        $this->is_active = 1;
        $this->updateMode = false;
    }

    public function store()
    {
        $data = $this->validate();

        // Only one active hero at a time
        if ($this->is_active) {
            ProductPageHeroModel::where('is_active', 1)->update(['is_active' => 0]);
        }

        // Upload images via helper
        if ($this->bg_image) {
            $data['bg_image'] = imageUpload($this->bg_image, 'product-hero');
        }

        if ($this->intro_img) {
            $data['intro_img'] = imageUpload($this->intro_img, 'product-hero');
        }

        ProductPageHeroModel::create($data);

        session()->flash('message', 'Hero section created successfully.');
        $this->resetFields();
    }

    public function edit($id)
    {
        $hero = ProductPageHeroModel::findOrFail($id);

        $this->hero_id = $id;
        $this->heading = $hero->heading;
        $this->description = $hero->description;
        $this->is_active = $hero->is_active;
        $this->existing_bg_image = $hero->bg_image;
        $this->existing_intro_img = $hero->intro_img;
        $this->bg_image = null;     // reset temp upload
        $this->intro_img = null;    // reset temp upload
        $this->updateMode = true;
    }

    public function update()
    {
        $data = $this->validate();

        // Only one active hero at a time
        if ($this->is_active) {
            ProductPageHeroModel::where('is_active', 1)
                ->where('id', '!=', $this->hero_id)
                ->update(['is_active' => 0]);
        }

        // Handle bg_image upload/update
        if ($this->bg_image) {
            // Delete old image
            if ($this->existing_bg_image && file_exists(public_path('storage/product-hero/'.$this->existing_bg_image))) {
                unlink(public_path('storage/product-hero/'.$this->existing_bg_image));
            }
            $data['bg_image'] = imageUpload($this->bg_image, 'product-hero');
        } else {
            $data['bg_image'] = $this->existing_bg_image;
        }

        // Handle intro_img upload/update
        if ($this->intro_img) {
            // Delete old image
            if ($this->existing_intro_img && file_exists(public_path('storage/product-hero/'.$this->existing_intro_img))) {
                unlink(public_path('storage/product-hero/'.$this->existing_intro_img));
            }
            $data['intro_img'] = imageUpload($this->intro_img, 'product-hero');
        } else {
            $data['intro_img'] = $this->existing_intro_img;
        }

        ProductPageHeroModel::find($this->hero_id)->update($data);

        session()->flash('message', 'Hero section updated successfully.');
        $this->resetFields();
    }

    public function delete($id)
    {
        $hero = ProductPageHeroModel::findOrFail($id);

        // Delete images from storage
        if ($hero->bg_image && file_exists(public_path('storage/product-hero/'.$hero->bg_image))) {
            unlink(public_path('storage/product-hero/'.$hero->bg_image));
        }
        if ($hero->intro_img && file_exists(public_path('storage/product-hero/'.$hero->intro_img))) {
            unlink(public_path('storage/product-hero/'.$hero->intro_img));
        }

        $hero->delete();

        session()->flash('message', 'Hero deleted successfully.');
    }

    public function render()
    {
        $heros = ProductPageHeroModel::orderByDesc('created_at')->paginate(10);

        return view('livewire.admin.product-page-hero-form', compact('heros'));
    }
}

