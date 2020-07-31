<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Company;
use App\Http\Requests\Admin\CompanyRequest;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::with(['user'])->get();
        return view('admin.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.companies.create', [
            "users" => $this->getUsers($request->user),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $obj = Company::create($request->validated());

        if(!$obj){
            return redirect()->back()->withInput()->withErrors();
        }

        return redirect()->route('admin.companies.create')
            ->with(['color' => 'green', 'message' => 'Empresa inserida com sucesso!']);
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
    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company') + [
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
    public function update(CompanyRequest $request, Company $company)
    {
        $company->fill($request->validated());

        if(!$company->save()){
            return redirect()->back()->withInput()->withErrors();
        }

        return redirect()->route('admin.companies.edit', $company->id)
            ->with(['color' => 'green', 'message' => 'Empresa atualizada com sucesso!']);
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

    private function getUsers(?int $user = null)
    {
        if($user) {
            return User::where('id', $user)->get();
        } else {
            return User::all();
        }
    }
}
