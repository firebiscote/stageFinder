<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Company,
    Rating,
    Offer,
};
use App\Http\Requests\{
    CompanyRequest,
    RatingRequest,
};
use Illuminate\Support\Facades\{
    Route,
    Auth,
    DB,
};
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->right->SFx2) {return redirect()->route('offers.index')->with('info', __('You cannot do that !'));}
        $companies = Company::withTrashed()->oldest('name')->paginate(10);
        return view('companies/index', compact('companies'));
    }

    public function search(Request $request) 
    {
        if ($request->get('name') == '' && $request->get('line') == '') {
            $companies = Company::query()->withTrashed()
                ->where('trainee', '>=', $request->get('trainee'))
                ->where('confidence', '>=', $request->get('grade'))
                ->where('confidence', '>=', $request->get('confidence'))
                ->oldest('name')->paginate(10);
        } elseif ($request->get('name') != '' && $request->get('line') == '') {
            $companies = Company::query()->withTrashed()
                ->where('trainee', '>=', $request->get('trainee'))
                ->where('confidence', '>=', $request->get('grade'))
                ->where('confidence', '>=', $request->get('confidence'))
                ->where('name', $request->get('name'))
                ->oldest('name')->paginate(10);
        } elseif ($request->get('name') == '' && $request->get('line') != '') {
            $companies = Company::query()->withTrashed()
                ->where('trainee', '>=', $request->get('trainee'))
                ->where('confidence', '>=', $request->get('grade'))
                ->where('confidence', '>=', $request->get('confidence'))
                ->where('line', $request->get('line'))
                ->oldest('name')->paginate(10);
        } else {
            $companies = Company::query()->withTrashed()
                ->where('trainee', '>=', $request->get('trainee'))
                ->where('confidence', '>=', $request->get('grade'))
                ->where('confidence', '>=', $request->get('confidence'))
                ->where('name', $request->get('name'))
                ->where('line', $request->get('line'))
                ->oldest('name')->paginate(10);
        }
        return view('companies/index', compact('companies'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->right->SFx3) {return redirect()->route('offers.index')->with('info', __('You cannot do that !'));}
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
        $company = Company::create(array_merge($companyRequest->all(), ['slug' => Str::slug($companyRequest->get('name'))]));
        $company->localities()->attach($companyRequest->locas);
        return redirect()->route('companies.index')->with('info', __('The company has been created'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        if (!Auth::user()->right->SFx7) {return redirect()->route('offers.index')->with('info', __('You cannot do that !'));}
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
        if (!Auth::user()->right->SFx4) {return redirect()->route('offers.index')->with('info', __('You cannot do that !'));}
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
        $company->update(array_merge($companyRequest->all(), ['slug' => Str::slug($companyRequest->get('name'))]));
        $company->localities()->sync($companyRequest->locas);
        return redirect()->route('companies.index')->with('info', __('The company has been modified'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        if (!Auth::user()->right->SFx6) {return redirect()->route('offers.index')->with('info', __('You cannot do that !'));}
        Offer::query()->where('company_id', $company->id)->forceDelete();
        $company->forceDelete();
        return back()->with('info', __('The company has been deleted'));
    }

    public function rate(RatingRequest $ratingRequest)
    {
        if (!Auth::user()->right->SFx5) {return redirect()->route('offers.index')->with('info', __('You cannot do that !'));}
        $id = $ratingRequest->get('id');
        return view('companies/rate', compact('id'));
    }

    public function storeRating(Request $request)
    {
        if (!Auth::user()->right->SFx5) {return redirect()->route('offers.index')->with('info', __('You cannot do that !'));}
        $rating = Rating::create(array_merge($request->all(), ['user_id' => Auth::user()->id]));
        return redirect()->route('companies.index')->with('info', __('Your opinion has been taken into account'));
    }
}