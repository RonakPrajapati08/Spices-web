<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhyChooseFeatureModel extends Model
{
    protected $table = 'tbl_whychoose_features';

    protected $fillable = [
        'why_section_id',
        'icon',
        'title',
        'description',
        'sort_order',
        'status',
    ];

    // Optional: relation to main section
    public function mainWhyChoose()
    {
        return $this->belongsTo(WhyChooseModel::class, 'why_section_id');
    }
}
