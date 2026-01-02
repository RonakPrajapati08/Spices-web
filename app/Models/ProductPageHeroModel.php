<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPageHeroModel extends Model
{
    protected $table = 'tbl_product_page_hero';

    protected $fillable = [
        'bg_image',
        'heading',
        'description',
        'intro_img',
        'is_active',
    ];
}
