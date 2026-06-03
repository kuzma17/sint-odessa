<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;

class Brand extends BaseModel
{
    use AsSource;
    use Attachable;


    protected $fillable = [
        'title',
        'group',
        'sort',
        'active',
    ];

    protected $with = ['attachments'];

    public function scopeGroup($query, $group)
    {
        return $query->where('group', $group);

    }

    public static function getBrands(string $group=null, int $count=0)
    {
        $query = self::query()->active();

        if ($group) {
            $query->where('group', $group);
        }

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
