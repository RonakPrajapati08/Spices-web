<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntroductionModel extends Model
{
    protected $table = 'tbl_introductions';

    protected $fillable = [
        'heading',
        'sub_heading',
        'description',
        'image',
    ];
}
