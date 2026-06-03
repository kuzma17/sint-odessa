<?php

use App\Services\LocaleService;

function lroute(string $name, mixed $params = [], string $locale = null)
{
    return LocaleService::route($name, $params, $locale);
}

function switch_locale(string $locale)
{
    return LocaleService::switchLocale($locale);
}

function hreflang_links()
{
    return LocaleService::hreflangLinks();
}

function attachment_path($attachment): string
{
    return $attachment->path .$attachment->name .'.' .$attachment->extension;
}


function settings(string $key = null, $default = null, string $forceLocale = null)
{
    $value = \App\Models\Setting::get($key);

    if ($value === null) {
        return $default;
    }

    if (is_array($value) && (isset($value['ru']) || isset($value['ua'])))
    {
        $lang = $forceLocale ?? app()->getLocale();
        return $value[$lang]
            ?? $value['ru']
            ?? $value['ua']
            ?? $default;
    }

    return $value;
}

function translateField($data, ?string $locale = null)
{
    if (!is_array($data)) {
        return $data;
    }

    // translation array only

    if (
        !array_key_exists('ru', $data) &&
        !array_key_exists('ua', $data)
    ) {
        return $data;
    }

    $locale = $locale ?? app()->getLocale();

    return $data[$locale]
        ?? $data['ru']
        ?? $data['ua']
        ?? null;
}

function formatPhone(?string $phone): ?string
{
    if (!$phone) {
        return null;
    }

    if (strlen($phone) === 12) {
        return preg_replace(
            '/(\d{2})(\d{3})(\d{3})(\d{2})(\d{2})/',
            '+$1 ($2) $3-$4-$5',
            $phone
        );
    }

    return $phone;
}


