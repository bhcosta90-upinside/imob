<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContractRequest;
use App\User;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.contracts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contracts.create', [
            'lessors' => User::lessors()->get(),
            'lessees' => User::lesseess()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContractRequest $request)
    {
        dd($request->all(), $request->validated());
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
    public function edit($id)
    {
        return view('admin.contracts.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd($request->all());
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

    public function getDataCompanies(Request $request)
    {
        $companies = User::find($request->user)->companies()->select(['id', 'social_name', 'document_company'])->get()->toArray();
        $resultProperties = $request->name == 'owner' ? User::find($request->user)->properties : [];
        $properties = [];
        
        if (!empty($resultProperties)) {
            foreach ($resultProperties as $property) {
                $properties[] = [
                    "id" => $property->id,
                    "description" => '#' . $property->id . ' ' . $property->street . ', ' .
                        $property->number . ' ' . $property->neighborhood . ' ' .
                        $property->city . '/' . $property->state . ' (' . $property->zipcode . ')',
                    'sale_price' => $property->sale_price,
                    'rent_price' => $property->rent_price,
                    'tribute' => $property->tribute,
                    'condominium' => $property->condominium,
                ];
            }
        }

        return response()->json([
            "companies" => $companies,
            "properties" => $properties,
        ]);
    }
}
