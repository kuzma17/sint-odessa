<?php

namespace App\Orchid\Layouts\Page;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class TitleLayout extends Rows
{

    protected function fields(): iterable
    {
        return [
            Input::make('translations.ru.title')
                ->title('Title RU')
                ->required()
                ->horizontal(),
            Input::make('translations.ua.title')
                ->title('Title UA')
                ->required()
                ->horizontal(),
            TextArea::make('translations.ru.subtitle')
                ->title('Sub Title RU')
                ->rows(4)
                ->max(255)
                ->horizontal(),
            TextArea::make('translations.ua.subtitle')
                ->title('Sub Title UA')
                ->rows(4)
                ->max(255)
                ->horizontal(),
        ];
    }
}