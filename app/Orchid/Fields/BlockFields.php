<?php

namespace App\Orchid\Fields;

use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;

class BlockFields
{
    public static function make(
        string $block,
        string $title,
        int $defaultCount = 1
    ): array {

        return [

            CheckBox::make("model.blocks.{$block}_show")
                ->title("Показывать {$title}")
                ->id("{$block}_show")
                ->horizontal(),

            Input::make("model.blocks.{$block}_count")
                ->type('number')
                ->title("Количество {$title}")
                ->id("{$block}_count")
                ->value($defaultCount)
                ->horizontal(),

        ];
    }
}