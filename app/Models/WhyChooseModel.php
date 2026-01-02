<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhyChooseModel extends Model
{
    protected $table = 'tbl_main_whychoose'; // link with your table

    protected $fillable = [
        'title',
        'subtitle',
        'main_image',
        'bg_img',
        'status',
    ];

    public function features()
    {
        return $this->hasMany(WhyChooseFeatureModel::class, 'why_section_id')
            ->orderBy('sort_order');
    }
}
