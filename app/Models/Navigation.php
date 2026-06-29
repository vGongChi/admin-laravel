<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    protected $table = 'navigations';

    protected $fillable = [
        'language',
        'parent_id',
        'name',
        'name_en',
        'url',
        'sort',
        'status',
        'content',
        'image'
    ];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
