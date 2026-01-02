<?php

namespace App\Livewire\Admin;

use App\Models\ContactInquiriesModel;
use App\Models\HomeSliderModel;
use App\Models\ProductsModel;
use App\Models\TestimonialModel;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $sliderCount;
    public $productsCount;
    public $testimonialsCount;
    public $inquiriesCount;
    public function mount()
    {
        $this->sliderCount = HomeSliderModel::count();

        $this->productsCount = ProductsModel::with(['category'])->where('status', 1)->latest()->count();

        $this->testimonialsCount = TestimonialModel::latest()->count();

        $this->inquiriesCount = ContactInquiriesModel::latest()->count();
    }
    public function delete($id)
    {
        ContactInquiriesModel::findOrFail($id)->delete();
        session()->flash('message', 'Inquery has been deleted successfully.');
    }
    public function render()
    {

        $inquiries = ContactInquiriesModel::latest()->paginate(10);

        return view('livewire.admin.dashboard', compact('inquiries'));
    }
}
