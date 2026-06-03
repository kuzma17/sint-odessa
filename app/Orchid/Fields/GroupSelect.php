<?php

namespace App\Orchid\Fields;

use Orchid\Screen\Fields\Select;

class GroupSelect
{
    public static function make(string $name = 'group'): Select
    {
        return Select::make($name)
            ->options([
                'home' => 'Home',
                'services' => 'Services',
                'service_refill' => 'Cartridge refill',
                'service_printer_repair' => 'Printer repair',
                'service_pc_repair' => 'PC repair',
            ])
            ->title('Группа')
            ->help('Где рекомендовано показывать')->horizontal();
    }

}