<?php

use App\Http\Controllers\Admin\ContactInquiriesController;
use App\Livewire\Admin\AboutUsForm;
use App\Livewire\Admin\Auth\Login;
use App\Livewire\Admin\CategoryForm;
use App\Livewire\Admin\ContactPageForm;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\HomeSlider;
use App\Livewire\Admin\ImgFeatureFrom;
use App\Livewire\Admin\IntroductionForm;
use App\Livewire\Admin\ProductPageHeroForm;
use App\Livewire\Admin\ProductsForm;
use App\Livewire\Admin\TestimonialForm;
use App\Livewire\Admin\WhyChooseFeatureForm;
use App\Livewire\Admin\WhyChooseForm;
use App\Livewire\Front\About;
use App\Livewire\Front\ContactUs;
use App\Livewire\Front\Home;
use App\Livewire\Front\Products;
use App\Livewire\Front\ProductsDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', Home::class)->name('home');
Route::get('/about-us', About::class)->name(name: 'AboutUs');
Route::get('/products', Products::class)->name(name: 'Products');
// Route::get('/products-detail', ProductsDetail::class)->name(name: 'ProductsDetail');
Route::get('/product-detail/{id}', ProductsDetail::class)->name('product.details');
Route::get('/contact-us', ContactUs::class)->name(name: 'ContactUs');

//login
Route::get('/admin/login', Login::class)->name('admin.login');

Route::post('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/admin/login');
})->name('logout');

Route::post('/contact-inquiry', [ContactInquiriesController::class, 'store'])
    ->name('contact.inquiry.store');

/* Admin Protected Routes */

Route::middleware('admin.auth')->prefix('admin')->group(function () {

    Route::get('/dashboard', Dashboard::class)->name('admin.dashboard');
    //Home
    Route::get('/home-slider', HomeSlider::class)->name('admin.home-slider');
    Route::get('/introduction-form', IntroductionForm::class)->name('admin.introduction-form');
    Route::get('/img-feature-form', ImgFeatureFrom::class)->name('admin.img-feature-form');
    Route::get('/category-form', CategoryForm::class)->name('admin.category-form');
    Route::get('/products-form', ProductsForm::class)->name('admin.products-form');
    Route::get('/why-choose-form', WhyChooseForm::class)->name('admin.why-choose-form');
    Route::get('/whychoose-feature', WhyChooseFeatureForm::class)->name('admin.why-choose-feature');
    Route::get('/testinomial', TestimonialForm::class)->name('admin.testimonial-form');

    //about
    Route::get('/aboutus-form', AboutUsForm::class)->name('admin.about-us-form');

    //products
    Route::get('/products-hero', ProductPageHeroForm::class)->name('admin.product-hero-form');

    //contact us

    Route::get('/contactus-form', ContactPageForm::class)->name('admin.contactus-form');
});
