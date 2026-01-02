<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsModel extends Model
{
    protected $table = 'tbl_products';

    protected $fillable = [
        'category_id',
        'name',
        'image',
        'description',
        'link',
        'status',
        'is_top',
    ];

    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id');
    }
}
