<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function contactUs(Request $request)
    {
        if ($request->has('name')) {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'message' => 'required'
            ]);
            $contactUs = TRUE;
            if ($contactUs) {
                #todo-send email to admin
                session()->flash('success', 'Thank you for contacting us!');

                return redirect(url('contact-us'));
            }

            session()->flash('error', 'Something went wrong, Please try again.');

            return redirect(url('contact-us'));
        }
        view()->share('page_title', 'Contact US');

        return view('frontend.pages.contact_us');
    }

    public function aboutUs()
    {
        view()->share('page_title', 'About US');
        $page = Page::whereType(1)->first();

        return view('frontend.pages.about_us', compact('page'));
    }

    public function termsConditions()
    {
        view()->share('page_title', 'Terms & Conditions');
        $page = Page::whereType(3)->first();

        return view('frontend.pages.terms_conditions', compact('page'));
    }

    public function helpFaqs()
    {
        view()->share('page_title', 'Help & FAQs');
        $page = Page::whereType(4)->first();

        return view('frontend.pages.faq', compact('page'));
    }
}
