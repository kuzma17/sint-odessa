<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Review extends BaseModel
{
    use AsSource;

    protected $fillable = [
        'locale',
        'author',
        'avatar',
        'location',
        'content',
        'group',
        'rating',
        'sort',
        'active',
    ];


    public static function getReviews(string $group=null, int $count=0)
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
