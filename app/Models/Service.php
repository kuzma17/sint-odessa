<?php

namespace App\Models;

use App\Models\Traits\Blocks;
use App\Models\Traits\Translations;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;

class Service extends BaseModel
{
    use AsSource;
    use Attachable;
    use Translations;
    use Blocks;

    protected $fillable = [
        'slug',
        'blocks',
        'active',
        'sort'
    ];

    protected $casts = [
        'blocks' => 'array',
        'active' => 'boolean',
    ];

    protected $with = ['translations', 'attachments'];

    public function translations()
    {
        return $this->hasMany(ServiceTranslation::class);
    }

    public static function getServices()
    {
        return self::query()
            ->active()
            ->sort()
            ->get();
    }

    public static function getService($slug)
    {
        return self::where('slug', $slug)->first();
    }

    public function getImageAttribute()
    {
        return $this->attachments->where('group', 'content')->first()?->url() ?? '';
    }

    public function getImageCardAttribute()
    {
        return $this->attachments->where('group', 'card')->first()?->url() ?? '';
    }

    //    public function getImageOgAttribute()
//    {
//        return $this->attachments?->where('group', 'og')->first()->url() ?? '';
//    }



}
