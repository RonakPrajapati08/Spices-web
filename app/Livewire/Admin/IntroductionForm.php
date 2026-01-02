<?php

// namespace App\Livewire\Admin;

// use App\Models\IntroductionModel;
// use Livewire\Component;
// use Livewire\WithFileUploads;

// class IntroductionForm extends Component
// {
//     use WithFileUploads;

//     public $heading, $sub_heading, $description, $image, $intro_id;
//     public $image_temp;
//     public $updateMode = false;

//     public function resetInputFields()
//     {
//         $this->heading = '';
//         $this->sub_heading = '';
//         $this->description = '';
//         $this->image = null;
//         $this->intro_id = null;
//         $this->image_temp = null;
//     }

//     public function store()
//     {
//         $validatedData = $this->validate([
//             'heading' => 'required|string|max:255',
//             'sub_heading' => 'nullable|string|max:255',
//             'description' => 'nullable|string',
//             'image_temp' => 'nullable|image|max:2048',
//         ]);

//         if ($this->image_temp) {
//             $imagePath = $this->image_temp->store('introductions', 'public');
//             $validatedData['image'] = $imagePath;
//         }

//         IntroductionModel::create($validatedData);

//         session()->flash('message', 'Introduction Created Successfully.');

//         $this->resetInputFields();
//     }

//     public function edit($id)
//     {
//         $intro = IntroductionModel::findOrFail($id);
//         $this->intro_id = $id;
//         $this->heading = $intro->heading;
//         $this->sub_heading = $intro->sub_heading;
//         $this->description = $intro->description;
//         $this->image = $intro->image;
//         $this->updateMode = true;
//     }

//     public function update()
//     {
//         $validatedData = $this->validate([
//             'heading' => 'required|string|max:255',
//             'sub_heading' => 'nullable|string|max:255',
//             'description' => 'nullable|string',
//             'image_temp' => 'nullable|image|max:2048',
//         ]);

//         $intro = IntroductionModel::find($this->intro_id);

//         if ($this->image_temp) {
//             $imagePath = $this->image_temp->store('introductions', 'public');
//             $validatedData['image'] = $imagePath;
//         } else {
//             $validatedData['image'] = $intro->image;
//         }

//         $intro->update($validatedData);

//         session()->flash('message', 'Introduction Updated Successfully.');

//         $this->resetInputFields();
//         $this->updateMode = false;
//     }

//     public function delete($id)
//     {
//         $intro = IntroductionModel::find($id);
//         $intro->delete();
//         session()->flash('message', 'Introduction Deleted Successfully.');
//     }

//     public function cancel()
//     {
//         $this->resetInputFields();
//         $this->updateMode = false;
//     }
//     public function render()
//     {
//         $introductions = IntroductionModel::latest()->get();

//         return view('livewire.admin.introduction-form', compact('introductions'));
//     }
// }

// storage cPanel according

namespace App\Livewire\Admin;

use App\Models\IntroductionModel;
use Livewire\Component;
use Livewire\WithFileUploads;

class IntroductionForm extends Component
{
    use WithFileUploads;

    public $heading, $sub_heading, $description, $image, $intro_id;
    public $image_temp;
    public $updateMode = false;

    protected $rules = [
        'heading' => 'required|string|max:255',
        'sub_heading' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'image_temp' => 'nullable|image|max:2048',
    ];

    public function resetInputFields()
    {
        $this->heading = '';
        $this->sub_heading = '';
        $this->description = '';
        $this->image = null;
        $this->intro_id = null;
        $this->image_temp = null;
        $this->updateMode = false;
    }

    public function store()
    {
        $validatedData = $this->validate();

        if ($this->image_temp) {
            $validatedData['image'] = imageUpload($this->image_temp, 'introductions');
        }

        IntroductionModel::create($validatedData);

        session()->flash('message', 'Introduction Created Successfully.');

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $intro = IntroductionModel::findOrFail($id);
        $this->intro_id = $intro->id;
        $this->heading = $intro->heading;
        $this->sub_heading = $intro->sub_heading;
        $this->description = $intro->description;
        $this->image = $intro->image; // existing image
        $this->image_temp = null; // reset temporary upload
        $this->updateMode = true;
    }

    public function update()
    {
        $validatedData = $this->validate();

        $intro = IntroductionModel::findOrFail($this->intro_id);

        if ($this->image_temp) {
            // Delete old image if exists
            if ($intro->image && file_exists(public_path('storage/introductions/'.$intro->image))) {
                unlink(public_path('storage/introductions/'.$intro->image));
            }

            // Upload new image via helper
            $validatedData['image'] = imageUpload($this->image_temp, 'introductions');
        } else {
            // Keep existing image
            $validatedData['image'] = $intro->image;
        }

        $intro->update($validatedData);

        session()->flash('message', 'Introduction Updated Successfully.');

        $this->resetInputFields();
    }

    public function delete($id)
    {
        $intro = IntroductionModel::findOrFail($id);

        // Delete image from storage if exists
        if ($intro->image && file_exists(public_path('storage/introductions/'.$intro->image))) {
            unlink(public_path('storage/introductions/'.$intro->image));
        }

        $intro->delete();

        session()->flash('message', 'Introduction Deleted Successfully.');
    }

    public function cancel()
    {
        $this->resetInputFields();
    }

    public function render()
    {
        $introductions = IntroductionModel::latest()->get();
        return view('livewire.admin.introduction-form', compact('introductions'));
    }
}
