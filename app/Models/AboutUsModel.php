<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUsModel extends Model
{
    protected $table = 'tbl_aboutus';

    protected $fillable = [
        'hero_bg_image',
        'about_heading',
        'small_descri',
        'about_full_desc',
        'mission_description',
        'vision_description',
        'status',
    ];
}
