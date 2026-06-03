<?php

namespace App\Models;

use App\Models\Traits\Translations;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;

class Slide extends BaseModel
{
    use AsSource;
    use Attachable;
    use Translations;

    protected $fillable = [
        'sort',
        'active',
    ];

    protected $with = ['translations', 'attachments'];

    public function translations()
    {
        return $this->hasMany(SlideTranslation::class);
    }

    public static function getSlider($count=null, $locale=null)
    {
        $query = self::query()->active();

        if ($count) {
          $query->take($count);
        }

        return $query->sort()
            ->get();
    }

    public function getImageAttribute()
    {
        return $this->attachments
            ->first()
            ?->url();
    }


}
