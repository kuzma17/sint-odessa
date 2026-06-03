<?php

namespace App\Models;

use App\Models\Traits\Translations;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;

class Office extends BaseModel
{
    use AsSource;
    use Attachable;
    use Translations;

    protected $fillable = [
        'phones',
        'email',
        'viber',
        'telegram',
        'map',
        'worktime',
        'sort',
        'active'
    ];

    protected $casts = [
        'phones' => 'array',
        'map' => 'array',
    ];

    protected $with = ['translations', 'attachments'];

    public function translations()
    {
        return $this->hasMany(OfficeTranslation::class);
    }

    public static function getOffices()
    {
        return self::query()
            ->active()
            ->sort()
            ->get();
    }

    public function getPhoneAttribute(){
        if (empty($this->phones) || !is_array($this->phones)) {
            return null;
        }
        return $this->phones[0];
    }

    public function getImageAttribute()
    {
        return $this->attachments->first()?->url() ?? '';
    }



}
