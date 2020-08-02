<?php

namespace App\Http\Controllers\Admin;

use App\Contract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContractRequest;
use App\Property;
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
        $results = Contract::with(['owner', 'acquirer'])->get();

        return view('admin.contracts.index', compact('results'));
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
        $obj = Contract::create($request->validated());

        if(!$obj){
            return redirect()->back()->withInput()->withErrors();
        }

        return redirect()->route('admin.companies.create')
            ->with(['color' => 'green', 'message' => 'Contrato inserido com sucesso!']);
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
    public function edit(Contract $contract)
    {
        return view('admin.contracts.edit', compact('contract') + [
            'lessors' => User::lessors()->get(),
            'lessees' => User::lesseess()->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContractRequest $request, Contract $contract)
    {
        $contract->fill($request->validated());

        if(!$contract->save()){
            return redirect()->back()->withInput()->withErrors();
        }

        return redirect()->route('admin.contracts.edit', $contract->id)
            ->with(['color' => 'green', 'message' => 'Contrato atualizado com sucesso!']);
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
        $resultProperties = $request->name == 'owner_id' ? User::find($request->user)->properties : [];
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
