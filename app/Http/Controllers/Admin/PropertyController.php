<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PropertyRequest;
use App\User;
use App\Property;
use App\PropertyImage;
use App\Support\Cropper;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::all();
        return view('admin.properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.properties.create', [
            "users" => $this->getUsers($request->user),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyRequest $request)
    {
        $obj = new Property;
        $obj->fill($request->validated());

        $obj = Property::create($request->validated());

        if ($request->allFiles()) {
            foreach($request->allFiles()['files'] as $rs) {
                $objImage = new PropertyImage();
                $objImage->property_id = $obj->id;
                $objImage->path = $rs->store('properties/' . $obj->id);
                $objImage->save();
                unset($objImage);
            }
        }

        if(!$obj){
            return redirect()->back()->withInput()->withErrors();
        }

        return redirect()->route('admin.properties.create')
            ->with(['color' => 'green', 'message' => 'Imóvel inserido com sucesso!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        return view('admin.properties.edit', compact('property') + [
            "users" => $this->getUsers(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyRequest $request, Property $property)
    {
        $property->fill($request->validated());

        $property->setSaleAttribute($request->sale);
        $property->setRentAttribute($request->rent);
        $property->setAirConditioningAttribute($request->air_conditioning);
        $property->setBarAttribute($request->bar);
        $property->setLibraryAttribute($request->library);
        $property->setBarbecueGrillAttribute($request->barbecue_grill);
        $property->setAmericanKitchenAttribute($request->american_kitchen);
        $property->setFittedKitchenAttribute($request->fitted_kitchen);
        $property->setPantryAttribute($request->pantry);
        $property->setEdiculeAttribute($request->edicule);
        $property->setOfficeAttribute($request->office);
        $property->setBathtubAttribute($request->bathtub);
        $property->setFirePlaceAttribute($request->fireplace);
        $property->setLavatoryAttribute($request->lavatory);
        $property->setFurnishedAttribute($request->furnished);
        $property->setPoolAttribute($request->pool);
        $property->setSteamRoomAttribute($request->steam_room);
        $property->setViewOfTheSeaAttribute($request->view_of_the_sea);

        if(!$property->save()){
            return redirect()->back()->withInput()->withErrors();
        }

        if ($request->allFiles()) {
            foreach($request->allFiles()['files'] as $rs) {
                $objImage = new PropertyImage();
                $objImage->property_id = $property->id;
                $objImage->path = $rs->store('properties/' . $property->id);
                $objImage->save();
                unset($objImage);
            }
        }

        return redirect()->route('admin.properties.edit', $property->id)
            ->with(['color' => 'green', 'message' => 'Imóvel atualizado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function imageSetCover(Request $request)
    {
        $imageSetCover = PropertyImage::find($request->image);
        $allImage = PropertyImage::where('property_id', $imageSetCover->property_id)
            ->where('cover', true)
            ->get();

        foreach($allImage as $image) {
            $image->cover = false;
            $image->save();
        }

        $imageSetCover->cover = true;
        $imageSetCover->save();

        $json = [
            'success' => true
        ];

        return response()->json($json);
    }

    public function imageRemove(Request $request)
    {
        $imageDelete = PropertyImage::find($request->image);

        Storage::delete($imageDelete->path);
        Cropper::flush($imageDelete->path);
        $imageDelete->delete();

        $json = [
            'success' => true
        ];
        return response()->json($json);
    }

    private function getUsers(?int $user = null)
    {
        if($user) {
            return User::where('id', $user)->get();
        } else {
            return User::lessors()->get();
        }
    }
}
