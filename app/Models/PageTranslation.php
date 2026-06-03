<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
    protected $fillable = [
        'locale',
        'title',
        'subtitle',
        'content',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'og_title',
        'og_description',
    ];

    protected $casts = [
        'data_blocks' => 'array',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
