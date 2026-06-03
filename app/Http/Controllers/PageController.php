<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfficeRequest;
use App\Models\Brand;
use App\Models\Faq;
use App\Models\Office;
use App\Models\Page;
use App\Models\Review;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Slide;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function page(Page $page)
    {
        $template = 'page/'.$page->template;

        return view($template, compact('page'));
    }
    
     public function home(){

        $page = Page::getPage('home');
        $sliders  = Slide::getSlider();
        $services = Service::getServices();
        $brands  = Brand::getBrands('home', 8);
        $faqs = Faq::getFaq('home', 3);
        $reviews = Review::getReviews('home', 3);
        $offices = Office::getOffices();
        $advantages_digital = $page->jsonBlock('advantages-digital');
        $workflow = $page->jsonBlock('workflow');

        return view('pages/home', compact('page', 'sliders', 'services', 'brands', 'faqs', 'reviews', 'offices', 'advantages_digital', 'workflow'));
    }

    public function about()
    {
        $page = Page::getPage('about');
        $history_items = $page->jsonBlock('history');
        $advantages = $page->jsonBlock('advantages');
        return view('pages/about', compact('page', 'history_items', 'advantages'));
    }

    public function delivery()
    {
        $page = Page::getPage('delivery');
        $workflow = $page->jsonBlock('workflow');
        return view('pages/delivery', compact('page', 'workflow'));
    }

    public function contacts()
    {
        $page = Page::getPage('contacts');
        $offices = Office::getOffices();
        return view('pages/contacts', compact('page', 'offices'));
    }

    public function faq()
    {
        $page = Page::getPage('faq');
        $faqs = Faq::getFaq();
        return view('pages/faq-list', compact('page', 'faqs'));
    }

    public function reviews()
    {
      $page = Page::getPage('reviews');
      $reviews = Review::getReviews();
      return view('pages/reviews-list', compact('page', 'reviews'));
    }

}
