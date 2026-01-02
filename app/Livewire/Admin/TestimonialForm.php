<?php

// namespace App\Livewire\Admin;

// use App\Models\TestimonialModel;
// use Livewire\Component;
// use Livewire\WithFileUploads;
// use Livewire\WithPagination;

// class TestimonialForm extends Component
// {
//     use WithPagination, WithFileUploads;

//     public $customer_name, $description, $image, $existing_image, $testimonial_id;
//     public $updateMode = false;

//     protected $rules = [
//         'customer_name' => 'required|string|max:255',
//         'description' => 'nullable|string',
//         'image' => 'nullable|image|max:1024',
//     ];

//     public function resetInputFields()
//     {
//         $this->customer_name = '';
//         $this->description = '';
//         $this->image = null;
//         $this->existing_image = null;
//         $this->testimonial_id = null;
//         $this->updateMode = false;
//     }

//     public function store()
//     {
//         $validatedData = $this->validate();

//         if ($this->image) {
//             $validatedData['image'] = $this->image->store('testimonials', 'public');
//         }

//         TestimonialModel::create($validatedData);

//         session()->flash('message', 'Testimonial created successfully.');
//         $this->resetInputFields();
//     }

//     public function edit($id)
//     {
//         $record = TestimonialModel::findOrFail($id);

//         $this->testimonial_id = $id;
//         $this->customer_name = $record->customer_name;
//         $this->description = $record->description;
//         $this->existing_image = $record->image;
//         $this->image = null;
//         $this->updateMode = true;
//     }

//     public function update()
//     {
//         $validatedData = $this->validate();

//         if ($this->image) {
//             $validatedData['image'] = $this->image->store('testimonials', 'public');
//         } else {
//             $validatedData['image'] = $this->existing_image;
//         }

//         if ($this->testimonial_id) {
//             $record = TestimonialModel::find($this->testimonial_id);
//             $record->update($validatedData);

//             session()->flash('message', 'Testimonial updated successfully.');
//             $this->resetInputFields();
//         }
//     }

//     public function delete($id)
//     {
//         if ($id) {
//             $record = TestimonialModel::find($id);
//             $record->delete();

//             session()->flash('message', 'Testimonial deleted successfully.');
//         }
//     }

//     public function render()
//     {
//         $records = TestimonialModel::latest()->paginate(10);

//         return view('livewire.admin.testimonial-form', compact('records'));
//     }
// }

//storage cPanel 

namespace App\Livewire\Admin;

use App\Models\TestimonialModel;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class TestimonialForm extends Component
{
    use WithPagination, WithFileUploads;

    public $customer_name, $description, $image, $existing_image, $testimonial_id;
    public $updateMode = false;

    protected $rules = [
        'customer_name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:1024',
    ];

    public function resetInputFields()
    {
        $this->customer_name = '';
        $this->description = '';
        $this->image = null;
        $this->existing_image = null;
        $this->testimonial_id = null;
        $this->updateMode = false;
    }

    public function store()
    {
        $validatedData = $this->validate();

        if ($this->image) {
            // Upload image via helper
            $validatedData['image'] = imageUpload($this->image, 'testimonials');
        }

        TestimonialModel::create($validatedData);

        session()->flash('message', 'Testimonial created successfully.');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $record = TestimonialModel::findOrFail($id);

        $this->testimonial_id = $id;
        $this->customer_name = $record->customer_name;
        $this->description = $record->description;
        $this->existing_image = $record->image;
        $this->image = null; // Reset temporary upload
        $this->updateMode = true;
    }

    public function update()
    {
        $validatedData = $this->validate();

        if ($this->image) {
            // Delete old image if exists
            if ($this->existing_image && file_exists(public_path('storage/testimonials/'.$this->existing_image))) {
                unlink(public_path('storage/testimonials/'.$this->existing_image));
            }

            // Upload new image via helper
            $validatedData['image'] = imageUpload($this->image, 'testimonials');
        } else {
            $validatedData['image'] = $this->existing_image;
        }

        if ($this->testimonial_id) {
            $record = TestimonialModel::find($this->testimonial_id);
            $record->update($validatedData);

            session()->flash('message', 'Testimonial updated successfully.');
            $this->resetInputFields();
        }
    }

    public function delete($id)
    {
        if ($id) {
            $record = TestimonialModel::find($id);

            // Delete image from storage
            if ($record->image && file_exists(public_path('storage/testimonials/'.$record->image))) {
                unlink(public_path('storage/testimonials/'.$record->image));
            }

            $record->delete();

            session()->flash('message', 'Testimonial deleted successfully.');
        }
    }

    public function render()
    {
        $records = TestimonialModel::latest()->paginate(10);

        return view('livewire.admin.testimonial-form', compact('records'));
    }
}
