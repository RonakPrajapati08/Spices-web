<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInquiriesModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_contact_inquiries';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'status',
    ];
}
