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
        $id = ApiController::createQuery('id')->pluck('id')->toArray();
        if(empty($id)){
            $properties = Property::get();
        }else{
            $properties = Property::whereIn('id', $id)->get();
        }
        return view('web.filter', compact('properties'));
    }

    public function experience()
    {
        ApiController::clearAllData();
        $properties = Property::whereNotNull('experience')->get();
        return view('web.filter', compact('properties'));
    }

    public function spotlight()
    {
        ApiController::clearAllData();
        $properties = Property::whereNotNull('experience')->get();
        return view('web.spotlight', compact('properties'));
    }

    public function experienceCategory(string $slug)
    {
        $properties = new Property;
        switch($slug){
            case 'cobertura':
                $properties = $properties->where('experience', 'Cobertura');
                break;
            case 'alto-padrao':
                $properties = $properties->where('experience', 'Alto Padrão');
                break;
            case 'de-frente-para-o-mar':
                $properties = $properties->where('experience', 'De Frente para o Mar');
                break;
            case 'condominio-fechado':
                $properties = $properties->where('experience', 'Condomínio Fechado');
                break;
            case 'compacto':
                $properties = $properties->where('experience', 'Compacto');
                break;
            case 'lojas-e-salas':
                $properties = $properties->where('experience', 'Lojas e Salas');
                break;
        }
        $properties = $properties->get();
        ApiController::clearAllData();
        return view('web.filter', compact('properties'));
    }

    public function buy()
    {
        ApiController::clearAllData();
        $properties = Property::sale()->get();
        return view('web.filter', compact('properties'));
    }

    public function buyProperty(Request $request, string $slug)
    {
        $property = Property::whereSlug($slug)->first();
        return view('web.property', compact('property'));
    }

    public function rent()
    {
        ApiController::clearAllData();
        $properties = Property::rent()->get();
        return view('web.filter', compact('properties'));
    }

    public function rentProperty(Request $request, string $slug)
    {
        $property = Property::whereSlug($slug)->first();
        return view('web.property', compact('property'));
    }
}
