<?php

namespace App\Orchid\Layouts\Blocks;

use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class FaqBlockLayout extends Rows
{
    protected function fields(): iterable
    {
        return [

            Group::make([

                CheckBox::make('model.blocks.faq_show')
                    ->title('Показывать FAQ')
                    ->id('faq_show'),

                Input::make('model.blocks.faq_count')
                    ->title('Количество FAQ')
                    ->type('number')
                    ->id('faq_count'),

            ]),

        ];
    }

}