<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSliderModel extends Model
{
    protected $table = 'tbl_hero_sliders';
    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'is_active',
    ];
}
