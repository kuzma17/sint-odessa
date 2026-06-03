<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlideTranslation extends Model
{
    protected $fillable = [
        'slide_id',
        'locale',
        'title',
        'description',
    ];

    public function slide()
    {
        return $this->belongsTo(Slide::class);
    }

    public function scopeLocale($query, $locale = null)
    {
        return $query->where('locale', $locale ?? app()->getLocale());
    }
}
