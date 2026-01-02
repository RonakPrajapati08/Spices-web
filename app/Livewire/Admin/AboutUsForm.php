<?php

// namespace App\Livewire\Admin;

// use App\Models\AboutUsModel;
// use Livewire\Component;
// use Livewire\WithFileUploads;
// use Livewire\WithPagination;

// class AboutUsForm extends Component
// {
//     use WithFileUploads, WithPagination;

//     public $hero_bg_image, $existing_hero_bg_image;
//     public $about_heading, $small_descri, $about_full_desc;
//     public $mission_description, $vision_description;
//     public $status = 1;
//     public $aboutus_id;
//     public $updateMode = false;

//     protected $rules = [
//         'hero_bg_image' => 'nullable|image|max:1024',
//         'about_heading' => 'nullable|string|max:150',
//         'small_descri' => 'nullable|string',
//         'about_full_desc' => 'nullable|string',
//         'mission_description' => 'nullable|string',
//         'vision_description' => 'nullable|string',
//         'status' => 'required|boolean',
//     ];

//     public function resetInputFields()
//     {
//         $this->hero_bg_image = null;
//         $this->existing_hero_bg_image = null;
//         $this->about_heading = '';
//         $this->small_descri = '';
//         $this->about_full_desc = '';
//         $this->mission_description = '';
//         $this->vision_description = '';
//         $this->status = 1;
//         $this->aboutus_id = null;
//         $this->updateMode = false;
//     }

//     public function store()
//     {
//         $validatedData = $this->validate();

//         if ($this->hero_bg_image) {
//             $validatedData['hero_bg_image'] = $this->hero_bg_image->store('aboutus', 'public');
//         }

//         AboutUsModel::create($validatedData);

//         session()->flash('message', 'About Us created successfully.');
//         $this->resetInputFields();
//     }

//     public function edit($id)
//     {
//         $record = AboutUsModel::findOrFail($id);

//         $this->aboutus_id = $id;
//         $this->hero_bg_image = null;
//         $this->existing_hero_bg_image = $record->hero_bg_image;
//         $this->about_heading = $record->about_heading;
//         $this->small_descri = $record->small_descri;
//         $this->about_full_desc = $record->about_full_desc;
//         $this->mission_description = $record->mission_description;
//         $this->vision_description = $record->vision_description;
//         $this->status = $record->status;
//         $this->updateMode = true;
//     }

//     public function update()
//     {
//         $validatedData = $this->validate();

//         if ($this->hero_bg_image) {
//             $validatedData['hero_bg_image'] = $this->hero_bg_image->store('aboutus', 'public');
//         } else {
//             $validatedData['hero_bg_image'] = $this->existing_hero_bg_image;
//         }

//         if ($this->aboutus_id) {
//             $record = AboutUsModel::find($this->aboutus_id);
//             $record->update($validatedData);

//             session()->flash('message', 'About Us updated successfully.');
//             $this->resetInputFields();
//         }
//     }

//     public function delete($id)
//     {
//         if ($id) {
//             $record = AboutUsModel::find($id);
//             $record->delete();

//             session()->flash('message', 'About Us deleted successfully.');
//         }
//     }

//     public function render()
//     {
//         $records = AboutUsModel::latest()->paginate(10);
//         return view('livewire.admin.about-us-form', compact('records'));
//     }
// }


namespace App\Livewire\Admin;

use App\Models\AboutUsModel;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AboutUsForm extends Component
{
    use WithFileUploads, WithPagination;

    public $hero_bg_image, $existing_hero_bg_image;
    public $about_heading, $small_descri, $about_full_desc;
    public $mission_description, $vision_description;
    public $status = 1;
    public $aboutus_id;
    public $updateMode = false;

    protected $rules = [
        'hero_bg_image' => 'nullable|image|max:1024',
        'about_heading' => 'nullable|string|max:150',
        'small_descri' => 'nullable|string',
        'about_full_desc' => 'nullable|string',
        'mission_description' => 'nullable|string',
        'vision_description' => 'nullable|string',
        'status' => 'required|boolean',
    ];

    public function resetInputFields()
    {
        $this->hero_bg_image = null;
        $this->existing_hero_bg_image = null;
        $this->about_heading = '';
        $this->small_descri = '';
        $this->about_full_desc = '';
        $this->mission_description = '';
        $this->vision_description = '';
        $this->status = 1;
        $this->aboutus_id = null;
        $this->updateMode = false;
    }

    public function store()
    {
        $validatedData = $this->validate();

        if ($this->hero_bg_image) {
            // Using helper function to upload image
            $validatedData['hero_bg_image'] = imageUpload($this->hero_bg_image, 'aboutus');
        }

        AboutUsModel::create($validatedData);

        session()->flash('message', 'About Us created successfully.');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $record = AboutUsModel::findOrFail($id);

        $this->aboutus_id = $id;
        $this->hero_bg_image = null;
        $this->existing_hero_bg_image = $record->hero_bg_image;
        $this->about_heading = $record->about_heading;
        $this->small_descri = $record->small_descri;
        $this->about_full_desc = $record->about_full_desc;
        $this->mission_description = $record->mission_description;
        $this->vision_description = $record->vision_description;
        $this->status = $record->status;
        $this->updateMode = true;
    }

    public function update()
    {
        $validatedData = $this->validate();

        if ($this->hero_bg_image) {
            // Delete old image if exists
            if ($this->existing_hero_bg_image && file_exists(public_path('storage/aboutus/' . $this->existing_hero_bg_image))) {
                unlink(public_path('storage/aboutus/' . $this->existing_hero_bg_image));
            }

            // Upload new image via helper
            $validatedData['hero_bg_image'] = imageUpload($this->hero_bg_image, 'aboutus');
        } else {
            // Keep existing image
            $validatedData['hero_bg_image'] = $this->existing_hero_bg_image;
        }

        if ($this->aboutus_id) {
            $record = AboutUsModel::find($this->aboutus_id);
            $record->update($validatedData);

            session()->flash('message', 'About Us updated successfully.');
            $this->resetInputFields();
        }
    }

    public function delete($id)
    {
        if ($id) {
            $record = AboutUsModel::find($id);

            // Delete image from storage if exists
            if ($record->hero_bg_image && file_exists(public_path('storage/aboutus/' . $record->hero_bg_image))) {
                unlink(public_path('storage/aboutus/' . $record->hero_bg_image));
            }

            $record->delete();

            session()->flash('message', 'About Us deleted successfully.');
        }
    }

    public function render()
    {
        $records = AboutUsModel::latest()->paginate(10);
        return view('livewire.admin.about-us-form', compact('records'));
    }
}
