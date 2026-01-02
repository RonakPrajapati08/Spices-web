<?php

// namespace App\Livewire\Admin;

// use App\Models\WhyChooseModel;
// use Livewire\Component;
// use Livewire\WithFileUploads;
// use Livewire\WithPagination;

// class WhyChooseForm extends Component
// {
//     use WithPagination, WithFileUploads;

//     public $title, $subtitle, $main_image, $bg_img, $status = 1, $whychoose_id;
//     public $existing_main_image, $existing_bg_img;

//     public $updateMode = false;

//     protected $rules = [
//         'title' => 'required|string|max:255',
//         'subtitle' => 'nullable|string',
//         'main_image' => 'nullable|image|max:1024',
//         'bg_img' => 'nullable|image|max:1024',
//         'status' => 'required|boolean',
//     ];

//     public function resetInputFields()
//     {
//         $this->title = '';
//         $this->subtitle = '';
//         $this->main_image = null;
//         $this->bg_img = null;
//         $this->existing_main_image = null;
//         $this->existing_bg_img = null;
//         $this->status = 1;
//         $this->whychoose_id = null;
//         $this->updateMode = false;
//     }

//     public function store()
//     {
//         $validatedData = $this->validate();

//         if ($this->main_image) {
//             $validatedData['main_image'] = $this->main_image->store('whychoose', 'public');
//         }
//         if ($this->bg_img) {
//             $validatedData['bg_img'] = $this->bg_img->store('whychoose', 'public');
//         }

//         WhyChooseModel::create($validatedData);

//         session()->flash('message', 'Why Choose created successfully.');
//         $this->resetInputFields();
//     }

//     public function edit($id)
//     {
//         $record = WhyChooseModel::findOrFail($id);

//         $this->whychoose_id = $id;
//         $this->title = $record->title;
//         $this->subtitle = $record->subtitle;
//         $this->status = $record->status;
//         $this->existing_main_image = $record->main_image; // database main_image
//         $this->existing_bg_img = $record->bg_img;
//         $this->updateMode = true;
//     }

//     public function update()
//     {
//         $validatedData = $this->validate();

//         if ($this->main_image) {
//             $validatedData['main_image'] = $this->main_image->store('whychoose', 'public');
//         } else {
//             $validatedData['main_image'] = $this->existing_main_image;
//         }

//         if ($this->bg_img) {
//             $validatedData['bg_img'] = $this->bg_img->store('whychoose', 'public');
//         } else {
//             $validatedData['bg_img'] = $this->existing_bg_img;
//         }

//         if ($this->whychoose_id) {
//             $record = WhyChooseModel::find($this->whychoose_id);
//             $record->update($validatedData);
//             session()->flash('message', 'Why Choose updated successfully.');
//             $this->resetInputFields();
//         }
//     }

//     public function delete($id)
//     {
//         if ($id) {
//             $record = WhyChooseModel::find($id);
//             $record->delete();
//             session()->flash('message', 'Why Choose deleted successfully.');
//         }
//     }
//     public function render()
//     {
//         $records = WhyChooseModel::latest()->paginate(10);
//         return view('livewire.admin.why-choose-form', compact('records'));
//     }
// }

//storage cPanel

namespace App\Livewire\Admin;

use App\Models\WhyChooseModel;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class WhyChooseForm extends Component
{
    use WithPagination, WithFileUploads;

    public $title, $subtitle, $main_image, $bg_img, $status = 1, $whychoose_id;
    public $existing_main_image, $existing_bg_img;

    public $updateMode = false;

    protected $rules = [
        'title' => 'required|string|max:255',
        'subtitle' => 'nullable|string',
        'main_image' => 'nullable|image|max:1024',
        'bg_img' => 'nullable|image|max:1024',
        'status' => 'required|boolean',
    ];

    public function resetInputFields()
    {
        $this->title = '';
        $this->subtitle = '';
        $this->main_image = null;
        $this->bg_img = null;
        $this->existing_main_image = null;
        $this->existing_bg_img = null;
        $this->status = 1;
        $this->whychoose_id = null;
        $this->updateMode = false;
    }

    public function store()
    {
        $validatedData = $this->validate();

        if ($this->main_image) {
            $validatedData['main_image'] = imageUpload($this->main_image, 'whychoose');
        }
        if ($this->bg_img) {
            $validatedData['bg_img'] = imageUpload($this->bg_img, 'whychoose');
        }

        WhyChooseModel::create($validatedData);

        session()->flash('message', 'Why Choose created successfully.');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $record = WhyChooseModel::findOrFail($id);

        $this->whychoose_id = $id;
        $this->title = $record->title;
        $this->subtitle = $record->subtitle;
        $this->status = $record->status;
        $this->existing_main_image = $record->main_image; // database main_image
        $this->existing_bg_img = $record->bg_img;
        $this->main_image = null; // reset temporary upload
        $this->bg_img = null;
        $this->updateMode = true;
    }

    public function update()
    {
        $validatedData = $this->validate();

        // Main Image
        if ($this->main_image) {
            // Delete old main image
            if ($this->existing_main_image && file_exists(public_path('storage/whychoose/' . $this->existing_main_image))) {
                unlink(public_path('storage/whychoose/' . $this->existing_main_image));
            }
            $validatedData['main_image'] = imageUpload($this->main_image, 'whychoose');
        } else {
            $validatedData['main_image'] = $this->existing_main_image;
        }

        // Background Image
        if ($this->bg_img) {
            // Delete old bg image
            if ($this->existing_bg_img && file_exists(public_path('storage/whychoose/' . $this->existing_bg_img))) {
                unlink(public_path('storage/whychoose/' . $this->existing_bg_img));
            }
            $validatedData['bg_img'] = imageUpload($this->bg_img, 'whychoose');
        } else {
            $validatedData['bg_img'] = $this->existing_bg_img;
        }

        if ($this->whychoose_id) {
            $record = WhyChooseModel::find($this->whychoose_id);
            $record->update($validatedData);
            session()->flash('message', 'Why Choose updated successfully.');
            $this->resetInputFields();
        }
    }

    public function delete($id)
    {
        if ($id) {
            $record = WhyChooseModel::find($id);

            // Delete images from storage
            if ($record->main_image && file_exists(public_path('storage/whychoose/' . $record->main_image))) {
                unlink(public_path('storage/whychoose/' . $record->main_image));
            }
            if ($record->bg_img && file_exists(public_path('storage/whychoose/' . $record->bg_img))) {
                unlink(public_path('storage/whychoose/' . $record->bg_img));
            }

            $record->delete();
            session()->flash('message', 'Why Choose deleted successfully.');
        }
    }

    public function render()
    {
        $records = WhyChooseModel::latest()->paginate(10);
        return view('livewire.admin.why-choose-form', compact('records'));
    }
}
