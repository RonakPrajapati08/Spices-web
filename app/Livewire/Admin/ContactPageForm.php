<?php

namespace App\Livewire\Admin;

use App\Models\ContactPageModel;
use Livewire\Component;
use Livewire\WithPagination;

class ContactPageForm extends Component
{
    use WithPagination;

    public $contact_id;
    public $heading, $description, $address, $phone, $email;
    public $google_map_iframe;
    public $facebook_url, $instagram_url, $twitter_url, $linkedin_url, $youtube_url;
    public $is_active = true; // default value checkbox boolean work etle keep true/false(1/0)
    public $updateMode = false;

    protected $rules = [
        'heading' => 'required|string|max:150',
        'description' => 'nullable|string',
        'address' => 'nullable|string',
        'phone' => 'nullable|string|max:50',
        'email' => 'nullable|email|max:100',
        'google_map_iframe' => 'nullable|string',
        'facebook_url' => 'nullable|url',
        'instagram_url' => 'nullable|url',
        'twitter_url' => 'nullable|url',
        'linkedin_url' => 'nullable|url',
        'youtube_url' => 'nullable|url',
        'is_active' => 'required|boolean',
    ];

    public function resetInput()
    {
        $this->reset([
            'contact_id',
            'heading',
            'description',
            'address',
            'phone',
            'email',
            'google_map_iframe',
            'facebook_url',
            'instagram_url',
            'twitter_url',
            'linkedin_url',
            'youtube_url',
            'is_active',
            'updateMode'
        ]);

        $this->is_active = true;
    }

    public function store()
    {
        $data = $this->validate();

        // only one active record
        if ($this->is_active) {
            ContactPageModel::where('is_active', 1)->update(['is_active' => 0]);
        }

        ContactPageModel::create($data);

        session()->flash('message', 'Contact page saved successfully.');
        $this->resetInput();
    }

    public function edit($id)
    {
        $record = ContactPageModel::findOrFail($id);

        $this->contact_id = $id;
        $this->fill($record->toArray());

        // ✅ IMPORTANT FIX
        $this->is_active = (bool) $record->is_active;

        $this->updateMode = true;
    }

    public function update()
    {
        $data = $this->validate();

        if ($this->is_active) {
            ContactPageModel::where('is_active', 1)
                ->where('id', '!=', $this->contact_id)
                ->update(['is_active' => 0]);
        }

        ContactPageModel::find($this->contact_id)->update($data);

        $this->resetInput();
        session()->flash('message', 'Contact page updated successfully.');
    }

    public function delete($id)
    {
        ContactPageModel::find($id)->delete();
        session()->flash('message', 'Record deleted successfully.');
    }

    public function render()
    {
        $records = ContactPageModel::latest()->paginate(10);

        return view('livewire.admin.contact-page-form', compact('records'));
    }
}
