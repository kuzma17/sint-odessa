<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;

class Setting extends Model
{
    use AsSource;
    use Attachable;

    protected $fillable = ['data'];
    protected $casts = [
        'data' => 'array',
    ];

    protected $with = ['attachments'];


    protected static function data()
    {
//        static $data = null;
//
//        if ($data !== null) {
//            return $data;
//        }

        $data = Cache::rememberForever('settings', function () {
            return self::first()?->data ?? [];
        });

        return $data;

    }

    public static function get(string $key = null)
    {
        $data = self::data();

        if ($key === null) {
            return $data;
        }

        if ($key === 'phone'){
            return data_get($data, 'phones.0');
        }

        if ($key === 'image_logo'){
            return self::getAttachments('logo')->first()['url'] ?? null;
        }

        if ($key === 'image_logo_footer'){
            return self::getAttachments('logo_footer')->first()['url'] ?? null;
        }

        if ($key === 'image_og'){
            return self::getAttachments('og')->first()['url'] ?? null;
        }

        return data_get($data, $key);
    }

    protected static function getAllAttachments()
    {
//        static $attachments = null;
//
//        if ($attachments !== null) {
//            return $attachments;
//        }

        $attachments = Cache::rememberForever('settings.attachments', function () {
            return self::first()
                ?->attachments
                ?->map(fn($a) => [
                    'id' => $a->id,
                    'group' => $a->group,
                    'url' => $a->url(),
                    'alt' => $a->alt,
                    'sort' => $a->sort,
                ])
                ?->groupBy('group')
                ->toArray() ?? [];
        });

        return $attachments;

    }

    public static function getAttachments(?string $key = null)
    {
        $attachments = self::getAllAttachments();

        return $key
            ? collect($attachments[$key] ?? [])
            : collect($attachments);
    }

    public static function clearCache(): void
    {
        Cache::forget('settings');
        Cache::forget('settings.attachments');
    }

}
