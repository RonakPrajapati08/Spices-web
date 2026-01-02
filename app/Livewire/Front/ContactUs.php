<?php

namespace App\Livewire\Front;

use App\Models\ContactInquiriesModel;
use App\Models\ContactPageModel;
use Livewire\Component;

class ContactUs extends Component
{
    public $contact;

    public function mount()
    {
        $this->contact = ContactPageModel::where('is_active', 1)->first();
    }

    public function render()
    {
        return view('livewire.front.contact-us');
    }
}
