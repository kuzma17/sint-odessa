<?php

namespace App\Services;

class LocaleService
{
    public static function routeData(): ?array
    {
        $route = request()->route();

        if (!$route || !$route->getName()) {
            return null;
        }

        $name = $route->getName();

        return [
            'name' => self::normalizeRouteName($name),
            'params' => $route->parameters(),
        ];
    }

    public static function normalizeRouteName(string $name): string
    {
        return preg_replace('/^[a-z]{2}\./', '', $name);
    }

    public static function route(string $name, mixed $params = [], ?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        $nameRoute = $locale.'.'.$name;
        return route($nameRoute, $params, false);
    }

    public static function switchLocale(string $locale): string
    {
        $data = self::routeData();

        if (!$data) {
            return url('/');
        }

        return self::route($data['name'], $data['params'], $locale);
    }

//    function switch_locale($locale)
//    {
//        $route = request()->route();
//        $name = $route?->getName();
//        $parameters = $route?->parameters();
//
//        if (!$name) {
//            return url('/');
//        }
//
//        $name = preg_replace('/^[a-z]{2}\./', '', $name);
//        return route($locale . '.' . $name, $parameters);
//    }

    public static function hreflangLinks(): array
    {
        $data = self::routeData();

        if (!$data) {
            return [];
        }

        $links = [];
        $locales = config('app.locales');
        $defaultLocale = config('app.fallback_locale');

        foreach ($locales as $locale) {
            $links[$locale] = self::route(
                $data['name'],
                $data['params'],
                $locale
            );
        }

        $links['x-default'] = self::route(
            $data['name'],
            $data['params'],
            $defaultLocale
        );

        return $links;
    }

}