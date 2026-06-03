<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function services()
    {
        $page = Page::getPage('services');
        $services = Service::getServices();
        return view('services/services', compact('page', 'services'));
    }

    public function service($slug)
    {
        $service = Service::getService($slug);
        $workflow = $service->jsonBlock('workflow');
        $prices = $service->jsonBlock('price');
        $problems = $service->jsonBlock('problems');

        $template = 'service';

        if ($slug === 'cartridge-refill') {
            $template = 'cartridge-refill';
        }
        return view('services/'.$template, compact('service', 'workflow', 'prices', 'problems', 'template'));

    }
}
