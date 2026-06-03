<?php

namespace App\Orchid\Layouts\Page;

use Nakipelo\Orchid\CKEditor\CKEditor;
use Orchid\Screen\Layouts\Rows;

class ContentLayout extends Rows
{
    protected function fields(): iterable
    {
        return [
//            Quill::make('translations.ru.content')->title('Контент RU'),
//            Quill::make('translations.ua.content')->title('Контент UA'),
//            Quill::make('translations.ru.content')->title('Контент RU')->horizontal(),
//            Quill::make('translations.ua.content')->title('Контент UA')->horizontal(),

            CKEditor::make('translations.ru.content')->title('Контент RU')->horizontal(),
            CKEditor::make('translations.ua.content')->title('Контент UA')->horizontal(),

        ];
    }
}