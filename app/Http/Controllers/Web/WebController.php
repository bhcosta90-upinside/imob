<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function home()
    {
        return view('web.home');
    }

    public function contact()
    {
        return view('web.contact');
    }

    public function rent()
    {
        return view('web.filter');
    }

    public function by()
    {
        return view('web.filter');
    }

    public function filter()
    {
        return view('web.filter');
    }

    public function property()
    {
        return view('web.property');
    }
}
