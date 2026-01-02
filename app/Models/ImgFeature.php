<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImgFeature extends Model
{
    protected $table = 'tbl_img_features';

    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'is_active',
    ];
}
