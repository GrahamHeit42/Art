<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;

class PageController extends Controller
{
    public function contactUs()
    {
        return view('frontend.pages.contact_us');
    }

    public function aboutUs()
    {
        $data = Page::whereType('about-us')->first();
        return view('frontend.pages.about_us', compact('data'));
    }

    public function termsConditions()
    {
        $data = Page::whereType('terms-and-conditions')->first();
        return view('frontend.pages.terms_conditions', compact('data'));
    }

    public function helpFaqs()
    {
        $data = Page::whereType('help-and-faqs')->first();
        return view('frontend.pages.faq', compact('data'));
    }
}
