<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function contactUs()
    {
        return view('frontend.pages.contact_us');
    }

    public function aboutUs()
    {
        return view('frontend.pages.about_us');
    }

    public function termsConditions()
    {
        return view('frontend.pages.terms_conditions');
    }

    public function helpFaqs()
    {
        return view('frontend.pages.faq');
    }
}
