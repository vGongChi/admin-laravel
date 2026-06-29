<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $table = 'company_profiles';

    protected $fillable = [
        'language',
        'title',
        'title_en',
        'description',
        'link',
        'image',
        'content'
    ];
}
