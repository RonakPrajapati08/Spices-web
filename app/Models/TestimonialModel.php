<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestimonialModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_testimonials';

    protected $fillable = [
        'customer_name',
        'description',
        'image',
    ];
}
