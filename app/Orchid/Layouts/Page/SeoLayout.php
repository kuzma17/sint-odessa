<?php

namespace App\Orchid\Layouts\Page;

use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;

class SeoLayout
{
    public static function make(): iterable
    {
        return [

            Layout::rows([
//                Group::make([
                Input::make('translations.ru.seo_title')->title('SEO Title RU')->horizontal(),
                Input::make('translations.ua.seo_title')->title('SEO Title UA')->horizontal(),
//                    ]),
//                Group::make([
                TextArea::make('translations.ru.seo_description')->title('SEO Description RU')->rows(5)->horizontal(),
                TextArea::make('translations.ua.seo_description')->title('SEO Description UA')->rows(5)->horizontal(),
//                ]),
//
//                Group::make([
                TextArea::make('translations.ru.seo_keywords')->title('SEO Keywords RU')->rows(5)->horizontal(),
                TextArea::make('translations.ua.seo_keywords')->title('SEO Keywords UA')->rows(5)->horizontal(),
//                ]),
            ]),

            Layout::rows([
//                Upload::make('image_og')
//                    ->title('OG Image')
//                    ->groups('og')
//                    ->acceptedFiles('image/*')
//                    ->maxFiles(1)
//                    ->storage('public')
//                    ->path('tmp'),
//                Group::make([
                Input::make('translations.ru.og_title')->title('OG Title RU')->horizontal(),
                Input::make('translations.ua.og_title')->title('OG Title UA')->horizontal(),
//                    ]),
//
//                Group::make([
                TextArea::make('translations.ru.og_description')->title('OG Description RU')->rows(5)->horizontal(),
                TextArea::make('translations.ua.og_description')->title('OG Description UA')->rows(5)->horizontal(),

//                ]),
            ]),
        ];
    }
}