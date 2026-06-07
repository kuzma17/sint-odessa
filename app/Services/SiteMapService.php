<?php

namespace App\Services;

use App\Models\Page;
use App\Models\Service;
use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SiteMapService
{

    protected function pages($map)
    {
        $pages = Page::active()->get(['id', 'slug']);

        foreach ($pages as $page){
            $route = lroute($page->slug, [], 'ru');
            $map->add(Url::create($route)
                ->addAlternate(lroute($page->slug, [], 'ua'), 'uk')
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.5));

        }

        return $map;
    }

    protected function services($map)
    {
        $pages = Service::active()->get(['id', 'slug']);

        foreach ($pages as $page){
            $route = lroute('service', ['service' => $page->slug], 'ru');
            $map->add(Url::create($route)
                ->addAlternate(lroute('service', ['service' => $page->slug], 'ua'), 'uk')
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.5));

        }

        return $map;
    }

    public function generateMap()
    {
        $map = Sitemap::create();
        $map = $this->pages($map);
        $map = $this->services($map);

        $map->writeToFile(public_path('sitemap.xml'));

    }

}