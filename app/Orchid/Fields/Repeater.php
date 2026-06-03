<?php

namespace App\Orchid\Fields;

use Orchid\Screen\Field;
use Orchid\Support\Facades\Dashboard;

class Repeater extends Field
{
    protected $view = 'platform.fields.repeater';

    protected $attributes = [
        'value' => [],
        'fields' => [],
        'title' => null,
        'required' => false,
        'help' => null,
        'icon' => null,
    ];

    private static $scriptLoaded = false;

    public function fields(array $fields): static
    {
        return $this->set('fields', $fields);
    }

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


    public function render(): string
    {
        // Подключаем скрипт только один раз
        if (!self::$scriptLoaded) {
            Dashboard::registerResource('scripts', '/js/repeater.js');
            self::$scriptLoaded = true;
        }

        return parent::render();
    }



}