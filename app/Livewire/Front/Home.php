<?php

namespace App\Livewire\Front;

use App\Models\HomeSliderModel;
use App\Models\ImgFeature;
use App\Models\IntroductionModel;
use App\Models\ProductsModel;
use App\Models\TestimonialModel;
use App\Models\WhyChooseModel;
use Livewire\Component;

class Home extends Component
{
    public $sliders;
    public $intro;
    public $imgFeature;
    public $products;
    public $topProducts;
    public $whyChoose;
    public $testimonials;
    public function mount()
    {
        $this->sliders = HomeSliderModel::where('is_active', 1)->get();

        $this->intro = IntroductionModel::latest()->first();

        $this->imgFeature = ImgFeature::where('is_active', 1)->first();

        $this->products = ProductsModel::with(['category' => function ($q) {
            $q->where('status', 1);
        }])
            ->where('status', 1)
            ->get();


        // Only top products (separate section)
        $this->topProducts = ProductsModel::with('category')
            ->where('status', 1)
            ->where('is_top', 1)
            ->latest()
            ->take(2)
            ->get();

        // ✅ WHY CHOOSE + FEATURES (MAIN THING)
        $this->whyChoose = WhyChooseModel::with('features')
            ->where('status', 1)
            ->latest()
            ->first();

        $this->testimonials = TestimonialModel::latest()->get();
    }

    public function render()
    {
        return view('livewire.front.home');
    }
}
