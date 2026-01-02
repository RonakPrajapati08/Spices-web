<?php

namespace App\Livewire\Front;

use App\Models\AboutUsModel;
use Livewire\Component;

class About extends Component
{
    public $aboutUs;

    public function mount()
    {
        // Get the latest About Us record
        $this->aboutUs = AboutUsModel::where('status', 1)->latest()->first();
        
    }

    public function render()
    {
        return view('livewire.front.about');
    }
}
