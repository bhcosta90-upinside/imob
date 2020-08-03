<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Property;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function home()
    {
        $propertiesSale = Property::sale()->available()->limit(3)->get();
        $propertiesRent = Property::rent()->available()->limit(3)->get();

        return view('web.home', compact('propertiesSale', 'propertiesRent'));
    }

    public function contact()
    {
        return view('web.contact');
    }

    public function filter()
    {
        return view('web.filter');
    }

    public function buy()
    {
        return view('web.filter');
    }

    public function buyProperty(Request $request, string $slug)
    {
        dd($request, $slug);
    }

    public function rent()
    {
        return view('web.filter');
    }

    public function rentProperty(Request $request, string $slug)
    {
        $property = Property::whereSlug($slug)->first();
        return view('web.property', compact('property'));
    }
}
