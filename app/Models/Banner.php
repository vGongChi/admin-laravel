<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';

    protected $fillable = [
        'language',
        'title',
        'image_large',
        'image_small',
        'link',
        'sort',
        'status',
    ];
}
