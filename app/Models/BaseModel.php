<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    protected $casts = [
        'active' => 'boolean',
    ];
    public function scopeActive($query)
    {
        return $query->where('active', true);

    }

    public function scopeSort($query)
    {
        return $query->orderBy('sort');
    }

//    public function scopeLocale($query, $locale = null)
//    {
//        return $query->where('locale', $locale ?? app()->getLocale());
//    }

}
