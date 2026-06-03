<?php

namespace App\Orchid\Fields;

use Orchid\Screen\Field;

class PhoneRepeater extends Field
{
    protected $view = 'platform.fields.phone-repeater';

    protected $attributes = [
        'value' => [],
        'title' => null,
        'required' => false,
        'help' => null,
        'icon' => null,
    ];

    public function title(string $title): static
    {
        return $this->set('title', $title);
    }

    public function required(bool $required = true): static
    {
        return $this->set('required', $required);
    }

    public function help(string $text): static
    {
        return $this->set('help', $text);
    }

    public function icon(string $icon): static
    {
        return $this->set('icon', $icon);
    }

    // Добавляем поддержку horizontal()
    public function horizontal(): static
    {
        $this->addBeforeRender(function () {
            $this->set('isHorizontal', true);
        });

        return $this;
    }

    // Добавляем поддержку vertical()
    public function vertical(): static
    {
        $this->addBeforeRender(function () {
            $this->set('isHorizontal', false);
        });

        return $this;
    }



}