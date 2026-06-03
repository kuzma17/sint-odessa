<?php

namespace App\Orchid\Traits;

use App\Models\Faq;
use App\Models\Review;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;

Trait HasBlockChecks
{
    private function checkGroupBlock(array $data, string $group):array
    {
        $messages = [];
        if ($data['blocks']['brands_show'] ?? false) {

            $exists = Faq::where('group', $group)->exists();

            if (! $exists) {
                $messages[] = 'Блок Бренды включён, но записей нет. Дла отображения на странице блока создайте несколько Брендов с группой "'.$group.'"';
            }
        }

        if ($data['blocks']['faq_show'] ?? false) {

            $exists = Faq::where('group', $group)->exists();

            if (! $exists) {
                $messages[] = 'Блок FAQ включён, но записей нет. Дла отображения на странице блока создайте несколько FAQ с группой "'.$group.'"';
            }
        }

        if ($data['blocks']['reviews_show'] ?? false) {

            $exists = Review::where('group', $group)->exists();

            if (! $exists) {
                $messages[] = 'Блок Отзывы включён, но записей нет. Дла отображения на странице блока создайте несколько Отзывов с группой "'.$group.'"';
            }
        }

        return $messages;
    }

}