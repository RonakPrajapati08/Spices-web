<?php

namespace App\Livewire\Front;

use App\Models\ProductPageHeroModel;
use App\Models\ProductsModel;
use Livewire\Component;

class Products extends Component
{
    public $products = [];
    public $hero;
    public function mount()
    {
        // Active hero section (only one)
        $this->hero = ProductPageHeroModel::where('is_active', 1)->first();

        $this->products = ProductsModel::with(['category'])->where('status', 1)->latest()->get();
    }
    public function render()
    {
        return view('livewire.front.products');
    }
}
