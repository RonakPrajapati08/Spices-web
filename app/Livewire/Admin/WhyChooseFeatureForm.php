<?php

// namespace App\Livewire\Admin;

// use App\Models\WhyChooseFeatureModel;
// use App\Models\WhyChooseModel;
// use Livewire\Component;
// use Livewire\WithPagination;
// use Livewire\WithFileUploads;

// class WhyChooseFeatureForm extends Component
// {
//     use WithPagination, WithFileUploads;

//     public $why_section_id;
//     public $icon_image;            // For new uploads
//     public $existing_icon_image;   // For existing DB image
//     public $title;
//     public $description;
//     public $sort_order = 0;
//     public $status = 1;
//     public $feature_id;
//     public $updateMode = false;

//     protected $rules = [
//         'why_section_id' => 'required|exists:tbl_main_whychoose,id',
//         'icon_image' => 'nullable|image|max:1024',
//         'title' => 'required|string|max:255',
//         'description' => 'nullable|string',
//         'sort_order' => 'required|integer',
//         'status' => 'required|boolean',
//     ];

//     public function resetInputFields()
//     {
//         $this->why_section_id = null;
//         $this->icon_image = null;
//         $this->existing_icon_image = null;
//         $this->title = '';
//         $this->description = '';
//         $this->sort_order = 0;
//         $this->status = 1;
//         $this->feature_id = null;
//         $this->updateMode = false;
//     }

//     public function store()
//     {
//         $validatedData = $this->validate();

//         if ($this->icon_image) {
//             $validatedData['icon'] = $this->icon_image->store('whychoose_features', 'public');
//         }

//         WhyChooseFeatureModel::create($validatedData);

//         session()->flash('message', 'Feature created successfully.');
//         $this->resetInputFields();
//     }

//     public function edit($id)
//     {
//         $record = WhyChooseFeatureModel::findOrFail($id);

//         $this->feature_id = $id;
//         $this->why_section_id = $record->why_section_id;
//         $this->existing_icon_image = $record->icon;
//         $this->icon_image = null; // reset temporary upload
//         $this->title = $record->title;
//         $this->description = $record->description;
//         $this->sort_order = $record->sort_order;
//         $this->status = $record->status;
//         $this->updateMode = true;
//     }

//     public function update()
//     {
//         $validatedData = $this->validate();

//         if ($this->icon_image) {
//             $validatedData['icon'] = $this->icon_image->store('whychoose_features', 'public');
//         } else {
//             $validatedData['icon'] = $this->existing_icon_image;
//         }

//         if ($this->feature_id) {
//             $record = WhyChooseFeatureModel::find($this->feature_id);
//             $record->update($validatedData);

//             session()->flash('message', 'Feature updated successfully.');
//             $this->resetInputFields();
//         }
//     }

//     public function delete($id)
//     {
//         if ($id) {
//             $record = WhyChooseFeatureModel::find($id);
//             $record->delete();

//             session()->flash('message', 'Feature deleted successfully.');
//         }
//     }

//     public function render()
//     {
//         $records = WhyChooseFeatureModel::latest()->paginate(10);
//         $sections = WhyChooseModel::where('status', 1)->get();

//         return view('livewire.admin.why-choose-feature-form', compact('records', 'sections'));
//     }
// }

//storage cPanel

namespace App\Livewire\Admin;

use App\Models\WhyChooseFeatureModel;
use App\Models\WhyChooseModel;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class WhyChooseFeatureForm extends Component
{
    use WithPagination, WithFileUploads;

    public $why_section_id;
    public $icon_image;            // For new uploads
    public $existing_icon_image;   // For existing DB image
    public $title;
    public $description;
    public $sort_order = 0;
    public $status = 1;
    public $feature_id;
    public $updateMode = false;

    protected $rules = [
        'why_section_id' => 'required|exists:tbl_main_whychoose,id',
        'icon_image' => 'nullable|image|max:1024',
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'sort_order' => 'required|integer',
        'status' => 'required|boolean',
    ];

    public function resetInputFields()
    {
        $this->why_section_id = null;
        $this->icon_image = null;
        $this->existing_icon_image = null;
        $this->title = '';
        $this->description = '';
        $this->sort_order = 0;
        $this->status = 1;
        $this->feature_id = null;
        $this->updateMode = false;
    }

    public function store()
    {
        $validatedData = $this->validate();

        if ($this->icon_image) {
            // Upload new icon using helper
            $validatedData['icon'] = imageUpload($this->icon_image, 'whychoose_features');
        }

        WhyChooseFeatureModel::create($validatedData);

        session()->flash('message', 'Feature created successfully.');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $record = WhyChooseFeatureModel::findOrFail($id);

        $this->feature_id = $id;
        $this->why_section_id = $record->why_section_id;
        $this->existing_icon_image = $record->icon;
        $this->icon_image = null; // reset temporary upload
        $this->title = $record->title;
        $this->description = $record->description;
        $this->sort_order = $record->sort_order;
        $this->status = $record->status;
        $this->updateMode = true;
    }

    public function update()
    {
        $validatedData = $this->validate();

        if ($this->icon_image) {
            // Delete old icon if exists
            if ($this->existing_icon_image && file_exists(public_path('storage/whychoose_features/' . $this->existing_icon_image))) {
                unlink(public_path('storage/whychoose_features/' . $this->existing_icon_image));
            }

            // Upload new icon via helper
            $validatedData['icon'] = imageUpload($this->icon_image, 'whychoose_features');
        } else {
            $validatedData['icon'] = $this->existing_icon_image;
        }

        if ($this->feature_id) {
            $record = WhyChooseFeatureModel::find($this->feature_id);
            $record->update($validatedData);

            session()->flash('message', 'Feature updated successfully.');
            $this->resetInputFields();
        }
    }

    public function delete($id)
    {
        if ($id) {
            $record = WhyChooseFeatureModel::find($id);

            // Delete icon file if exists
            if ($record->icon && file_exists(public_path('storage/whychoose_features/' . $record->icon))) {
                unlink(public_path('storage/whychoose_features/' . $record->icon));
            }

            $record->delete();

            session()->flash('message', 'Feature deleted successfully.');
        }
    }

    public function render()
    {
        $records = WhyChooseFeatureModel::latest()->paginate(10);
        $sections = WhyChooseModel::where('status', 1)->get();

        return view('livewire.admin.why-choose-feature-form', compact('records', 'sections'));
    }
}
