<?php

namespace App\Orchid\Layouts\Blocks;

use App\Orchid\Fields\Repeater;
use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;

class AdvantagesLayout extends Rows
{

    protected function fields(): iterable
    {
        return [
            Repeater::make('model.blocks.advantages')
                ->fields([
                    [
                        'key' => 'title',
                        'label' => 'Title',
                        'translatable' => true,
                    ],
                    [
                        'key' => 'description',
                        'label' => 'Description',
                        'translatable' => true,
                    ],
                    [
                        'key' => 'icon',
                        'label' => 'Icon',
                    ],
                ])->help('Для поле Icons используются  Font Awesome Icons v7.2  Пример  "fa-user-tie"'),
        ];
    }
}