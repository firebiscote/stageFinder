<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Company,
};
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Route;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::withTrashed()->oldest('name')->paginate(10);
        return view('companies/index', compact('companies'));
    }

    public function search(Request $request) 
    {

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies/create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $companyRequest)
    {
        $company = Company::create($companyRequest->all());
        $company->localities()->attach($companyRequest->locas);
        return redirect()->route('companies.index')->with('info', __('The company have been created'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $company->with('localities')->get();
        return view('companies/show', compact('company'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies/edit', compact('company'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $companyRequest, Company $company)
    {
        $company->update($companyRequest->all());
        $company->localities()->sync($companyRequest->locas);
        return redirect()->route('companies.index')->with('info', __('The company have been modified'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->forceDelete();
        return back()->with('info', __('The company have been deleted'));
    }
}
