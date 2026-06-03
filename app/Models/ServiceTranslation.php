<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceTranslation extends Model
{
    protected $fillable = [
        'service_id',
        'locale',
        'title',
        'description',
        'subtitle',
        'content',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'og_title',
        'og_description',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
