<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $table = 'contact_infos';

    protected $fillable = [
        'language',
        'title',
        'company_name',
        'phone',
        'mobile',
        'email',
        'address',
        'qr_code',
    ];
}
