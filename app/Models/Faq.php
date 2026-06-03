<?php

namespace App\Models;

use App\Models\Traits\Translations;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Faq extends BaseModel
{
    use AsSource;
    use Translations;

    protected $fillable = [
        'page_id',
        'group',
        'sort',
        'active',
    ];

    protected $with = ['translations'];

    public function translations()
    {
        return $this->hasMany(FaqTranslation::class);
    }

    public function scopeGroup($query, $group)
    {
        return $query->where('group', $group);

    }

    public static function getFaq(string $group=null, int $count=0)
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

}
