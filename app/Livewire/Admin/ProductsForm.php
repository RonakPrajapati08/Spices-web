<?php

// namespace App\Livewire\Admin;

// use App\Models\CategoryModel;
// use App\Models\ProductsModel;
// use Livewire\Component;
// use Livewire\WithFileUploads;

// class ProductsForm extends Component
// {
//     use WithFileUploads;

//     public $category_id, $name, $image, $existingImage, $description, $link, $status = 1, $product_id;
//     public $updateMode = false;
//     public $is_top = 1;


//     protected $rules = [
//         'category_id' => 'required',
//         'name' => 'required|string|max:255',
//         'image' => 'nullable|image|max:2048',
//         'status' => 'required|in:0,1',
//         'is_top' => 'required|in:0,1',
//     ];


//     public function save()
//     {
//         $this->validate();

//         $imagePath = $this->existingImage;

//         if ($this->image) {
//             $imagePath = $this->image->store('products', 'public');
//         }

//         ProductsModel::updateOrCreate(
//             ['id' => $this->product_id],
//             [
//                 'category_id' => $this->category_id,
//                 'name' => $this->name,
//                 'image' => $imagePath,
//                 'description' => $this->description,
//                 'link' => $this->link,
//                 'status' => (int) $this->status,
//                 'is_top' => (int) $this->is_top,
//             ]
//         );

//         session()->flash('success', 'Product saved successfully!');
//         $this->resetForm();
//     }


//     public function edit($id)
//     {
//         $p = ProductsModel::findOrFail($id);
//         $this->product_id = $p->id;
//         $this->category_id = $p->category_id;
//         $this->name = $p->name;
//         $this->existingImage = $p->image;
//         $this->description = $p->description;
//         $this->link = $p->link;
//         $this->status = $p->status;
//         $this->updateMode = true;
//         $this->is_top = $p->is_top;
//     }

//     public function delete($id)
//     {
//         ProductsModel::findOrFail($id)->delete();
//         session()->flash('success', 'Product deleted');
//     }

//     public function resetForm()
//     {
//         $this->reset([
//             'category_id',
//             'name',
//             'image',
//             'existingImage',
//             'description',
//             'link',
//             'status',
//             'product_id',
//             'is_top'
//         ]);
//         $this->status = 1;
//         $this->updateMode = false;
//     }
//     public function render()
//     {
//         $products = ProductsModel::with('category')->latest()->get();
//         $categories = CategoryModel::where('status', 1)->get();

//         return view('livewire.admin.products-form', compact('products', 'categories'));
//     }
// }

// storage cPanel

namespace App\Livewire\Admin;

use App\Models\CategoryModel;
use App\Models\ProductsModel;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductsForm extends Component
{
    use WithFileUploads;

    public $category_id, $name, $image, $existingImage, $description, $link, $status = 1, $product_id;
    public $updateMode = false;
    public $is_top = 1;

    protected $rules = [
        'category_id' => 'required',
        'name' => 'required|string|max:255',
        'image' => 'nullable|image|max:2048',
        'status' => 'required|in:0,1',
        'is_top' => 'required|in:0,1',
    ];

    public function save()
    {
        $this->validate();

        $imagePath = $this->existingImage ?? null;

        if ($this->image) {
            // Delete old image if exists
            if ($this->existingImage && file_exists(public_path('storage/products/'.$this->existingImage))) {
                unlink(public_path('storage/products/'.$this->existingImage));
            }

            // Upload new image via helper
            $imagePath = imageUpload($this->image, 'products');
        }

        ProductsModel::updateOrCreate(
            ['id' => $this->product_id],
            [
                'category_id' => $this->category_id,
                'name' => $this->name,
                'image' => $imagePath,
                'description' => $this->description,
                'link' => $this->link,
                'status' => (int) $this->status,
                'is_top' => (int) $this->is_top,
            ]
        );

        session()->flash('success', 'Product saved successfully!');
        $this->resetForm();
    }

    public function edit($id)
    {
        $p = ProductsModel::findOrFail($id);

        $this->product_id = $p->id;
        $this->category_id = $p->category_id;
        $this->name = $p->name;
        $this->existingImage = $p->image;
        $this->image = null; // reset temp upload
        $this->description = $p->description;
        $this->link = $p->link;
        $this->status = $p->status;
        $this->updateMode = true;
        $this->is_top = $p->is_top;
    }

    public function delete($id)
    {
        $p = ProductsModel::findOrFail($id);

        // Delete image from storage
        if ($p->image && file_exists(public_path('storage/products/'.$p->image))) {
            unlink(public_path('storage/products/'.$p->image));
        }

        $p->delete();
        session()->flash('success', 'Product deleted successfully!');
    }

    public function resetForm()
    {
        $this->reset([
            'category_id',
            'name',
            'image',
            'existingImage',
            'description',
            'link',
            'status',
            'product_id',
            'is_top'
        ]);
        $this->status = 1;
        $this->updateMode = false;
    }

    public function render()
    {
        $products = ProductsModel::with('category')->latest()->get();
        $categories = CategoryModel::where('status', 1)->get();

        return view('livewire.admin.products-form', compact('products', 'categories'));
    }
}
