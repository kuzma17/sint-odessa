<?php

namespace App\Console\Commands;

use App\Services\SiteMapService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:sitemap-generate')]
#[Description('Command description')]
class SitemapGenerate extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(SiteMapService $siteMapService)
    {
        $siteMapService->generateMap();
    }

}
