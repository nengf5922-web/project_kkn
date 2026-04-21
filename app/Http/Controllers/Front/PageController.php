<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller; // Panggil Induk yang sudah dibenarkan di Langkah 1

class PageController extends Controller
{
    public function faq()
    {
        return view('front.pages.faq');
    }

    public function howToOrder()
    {
        return view('front.pages.how_to_order');
    }

    public function location()
    {
        return view('front.pages.location');
    }

    public function contact()
    {
        return view('front.pages.contact');
    }
}