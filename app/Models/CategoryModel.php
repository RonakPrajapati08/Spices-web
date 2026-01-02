<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    protected $table = 'tbl_categories';

    protected $fillable = ['name', 'status', 'image'];

    public function products()
    {
        return $this->hasMany(ProductsModel::class, 'category_id');
    }
}
