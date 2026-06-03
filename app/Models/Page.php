<?php

namespace App\Models;

use App\Models\Traits\Blocks;
use App\Models\Traits\Translations;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;

class Page extends BaseModel
{
    use AsSource;
    use Attachable;
    use Translations;
    use Blocks;

    protected $fillable = [
        'slug',
        'template',
        'blocks',
        'active',
    ];

    protected $casts = [
        'blocks' => 'array',
        'active' => 'boolean',
    ];

    protected $with = ['translations', 'attachments'];

    public function translations()
    {
        return $this->hasMany(PageTranslation::class);
    }

    public static function getPage($slug): self
    {
        return self::query()
            ->where('slug', $slug)
            ->first();

    }

    public function getImageAttribute()
    {
        return $this->attachments->first()?->url() ?? '';
    }

//    public function getImageOgAttribute()
//    {
//        return $this->attachments?->where('group', 'og')->first()->url() ?? '';
//    }


//    public function faqItems(int $count=1)
//    {
//        if (!$this->hasBlock('faq')) {
//            return null;
//        }
//
//        return Faq::getFaq('home', $count);
//    }
//
//    public function reviewItems(int $count=1)
//    {
//        if (!$this->hasBlock('reviews')) {
//            return null;
//        }
//
//        return Review::getReviews('home', $count);
//    }




}
