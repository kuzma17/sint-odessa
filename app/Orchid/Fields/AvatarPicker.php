<?php

namespace App\Orchid\Fields;

use Orchid\Screen\Field;

class AvatarPicker extends Field
{
    protected $view = 'platform.fields.avatar-picker';

    protected $attributes = [
        'title' => null,
        'value' => null,
        'avatars' => [],
        'required' => false,
        'help' => null,
        'icon' => null,
    ];

    public function avatars(array $avatars): static
    {
        return $this->set('avatars', $avatars);
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

}