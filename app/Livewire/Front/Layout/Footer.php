<?php

namespace App\Livewire\Front\Layout;

use App\Models\ContactPageModel;
use Livewire\Component;

class Footer extends Component
{
    public $contact;

    public function mount()
    {
        // Only active contact page record
        $this->contact = ContactPageModel::where('is_active', 1)->first();
    }
    public function render()
    {
        return view('livewire.front.layout.footer');
    }
}
