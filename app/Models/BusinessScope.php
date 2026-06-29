<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessScope extends Model
{
    protected $table = 'business_scopes';

    protected $fillable = [
        'language',
        'title',
        'title_en',
        'description',
        'link',
        'image',
        'sort',
        'content',
        'status',
    ];
}
