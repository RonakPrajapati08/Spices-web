<?php

namespace App\Livewire\Front;

use App\Models\ProductsModel;
use Livewire\Component;

class ProductsDetail extends Component
{
    public $product;

    public function mount($id)
    {
        $this->product = ProductsModel::with('category')
            ->where('status', 1)
            ->findOrFail($id);
    }
    public function render()
    {
        return view('livewire.front.products-detail');
    }
}
