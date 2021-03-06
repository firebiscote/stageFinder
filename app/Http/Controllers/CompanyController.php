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
     * Display a listing of the companies.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->right->SFx2)
        {
            return redirect()->route('offers.index')->with('info', __('You cannot do that !'));
        }
        $companies = Company::withTrashed()->oldest('name')->paginate(10);
        return view('companies/index', compact('companies'));
    }

    /**
     * Display a listing of the companies with filters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if ($request->get('name') == '' && $request->get('line') == '')
        {
            $companies = Company::query()->withTrashed()
                ->where('trainee', '>=', $request->get('trainee'))
                ->where('confidence', '>=', $request->get('grade'))
                ->where('confidence', '>=', $request->get('confidence'))
                ->oldest('name')->paginate(10);
        } elseif ($request->get('name') != '' && $request->get('line') == '')
        {
            $companies = Company::query()->withTrashed()
                ->where('trainee', '>=', $request->get('trainee'))
                ->where('confidence', '>=', $request->get('grade'))
                ->where('confidence', '>=', $request->get('confidence'))
                ->where('name', $request->get('name'))
                ->oldest('name')->paginate(10);
        } elseif ($request->get('name') == '' && $request->get('line') != '')
        {
            $companies = Company::query()->withTrashed()
                ->where('trainee', '>=', $request->get('trainee'))
                ->where('confidence', '>=', $request->get('grade'))
                ->where('confidence', '>=', $request->get('confidence'))
                ->where('line', $request->get('line'))
                ->oldest('name')->paginate(10);
        } else
        {
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
     * Show the form for creating a new company.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->right->SFx3)
        {
            return redirect()->route('offers.index')->with('info', __('You cannot do that !'));
        }
        return view('companies/create');
    }

    /**
     * Store a newly created company in storage.
     *
     * @param  \Illuminate\Http\Requests\CompanyRequest  $companyRequest
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $companyRequest)
    {
        $company = Company::create(
            array_merge($companyRequest->all(), ['slug' => Str::slug($companyRequest->get('name'))])
        );
        $company->localities()->attach($companyRequest->locas);
        return redirect()->route('companies.index')->with('info', __('The company has been created'));
    }

    /**
     * Display the specified company.
     *
     * @param  \Illuminate\Http\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        if (!Auth::user()->right->SFx7)
        {
            return redirect()->route('offers.index')->with('info', __('You cannot do that !'));
        }
        $company->with('localities')->get();
        return view('companies/show', compact('company'));
    }

    /**
     * Show the form for editing the specified company.
     *
     * @param  \Illuminate\Http\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        if (!Auth::user()->right->SFx4)
        {
            return redirect()->route('offers.index')->with('info', __('You cannot do that !'));
        }
        return view('companies/edit', compact('company'));
    }

    /**
     * Update the specified company in storage.
     *
     * @param  \Illuminate\Http\Requests\CompanyRequest  $companyRequest
     * @param  \Illuminate\Http\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $companyRequest, Company $company)
    {
        $company->update(array_merge($companyRequest->all(), ['slug' => Str::slug($companyRequest->get('name'))]));
        $company->localities()->sync($companyRequest->locas);
        return redirect()->route('companies.index')->with('info', __('The company has been modified'));
    }

    /**
     * Remove the specified company from storage.
     *
     * @param  \Illuminate\Http\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        if (!Auth::user()->right->SFx6)
        {
            return redirect()->route('offers.index')->with('info', __('You cannot do that !'));
        }
        Offer::query()->where('company_id', $company->id)->forceDelete();
        $company->forceDelete();
        return back()->with('info', __('The company has been deleted'));
    }

    /**
     * Show the form for creating a new assess.
     *
     * @param  \Illuminate\Http\Request\RatingRequest  $ratingRequest
     * @return \Illuminate\Http\Response
     */
    public function rate(Request $request)
    {
        if (!Auth::user()->right->SFx5)
        {
            return redirect()->route('offers.index')->with('info', __('You cannot do that !'));
        }
        $id = $request->get('company_id');
        try 
        {
            $test = DB::table('company_user')
                ->where('company_id', $id)
                ->where('user_id', Auth::user()->id)
                ->pluck('user_id')[0];
        }
        catch (\Exception $e)
        {
            return redirect()->route('companies.index')->with('info', __('You didn\'t work as an intern here'));
        }
        return view('companies/rate', compact('id'));
    }

    /**
     * Store a newly created assess in storage.
     *
     * @param  \Illuminate\Http\Request\RatingRequest  $ratingRequest
     * @return \Illuminate\Http\Response
     */
    public function storeRating(RatingRequest $ratingRequest)
    {
        if (!Auth::user()->right->SFx5)
        {
            return redirect()->route('offers.index')->with('info', __('You cannot do that !'));
        }
        $rating = Rating::create(array_merge($ratingRequest->all(), ['user_id' => Auth::user()->id]));
        return redirect()->route('companies.index')->with('info', __('Your opinion has been taken into account'));
    }
}
