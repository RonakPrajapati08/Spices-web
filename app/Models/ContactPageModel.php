<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactPageModel extends Model
{
    protected $table = 'tbl_contact_page';

    protected $fillable = [
        'heading',
        'description',
        'address',
        'phone',
        'email',
        'google_map_iframe',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'linkedin_url',
        'youtube_url',
        'is_active',
    ];
}
