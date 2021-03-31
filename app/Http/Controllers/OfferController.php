<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Offer,
    Locality,
    Promotion,
    Company,
    User,
};
use App\Http\Requests\{
    OfferRequest,
    ApplyRequest,
};
use Illuminate\Support\Facades\{
    DB,
    Route,
    Auth,
    Mail,
    Storage,
};
use App\Mail\Apply;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug = null)
    {
        $model = null;
        if ($slug) {
            if (Route::currentRouteName() == 'offers.locality') {
                $model = new Locality;
            } elseif (Route::currentRouteName() == 'offers.promotion') {
                $model = new Promotion;
            } elseif (Route::currentRouteName() == 'offers.company') {
                $model = new Company;
            } else {
                $model = new Skill;
            }
        }
        $query = $model ? $model::whereSlug($slug)->firstOrFail()->offers() : Offer::query();
        $offers = $query->withTrashed()->latest('created_at')->paginate(10);
        return view('offers/index', compact('offers', 'slug'));
    }

    public function wishlist() 
    {
        $offers = Offer::query()
            ->whereIn('id', \DB::table('offer_user')->where('user_id', Auth::user()->id)->where('status', 0)->pluck('offer_id'))
            ->latest('created_at')
            ->paginate(10);
        return view('offers/wishlist', compact('offers'));
    }

    public function query() 
    {
        $offers = Offer::query()
            ->whereIn('id', \DB::table('offer_user')->where('user_id', Auth::user()->id)->where('status', '>', 0)->pluck('offer_id'))
            ->latest('created_at')
            ->paginate(10);
        foreach ($offers as $offer) 
        {
            $offer->status = \DB::table('offer_user')->where('user_id', Auth::user()->id)->where('offer_id', $offer->id)->pluck('status')[0];
        }
        return view('offers/query', compact('offers'));
    }

    public function changeState(Request $request)
    {
        if ($request->get('progress') == 7)
        {
            \DB::table('offer_user')
                ->where('user_id', Auth::user()->id)
                ->where('offer_id', $request->get('offer_id'))
                ->delete();
            return redirect()->route('offers.query')->with('info', __('Sorry'));
        }
        if ($request->get('progress') == 6)
        {
            \DB::table('company_user')
                ->insert(['company_id' => DB::table('offers')->where('id', $request->get('offer_id'))->pluck('company_id')[0],
                          'user_id' => Auth::user()->id]);
        }
        \DB::table('offer_user')
            ->where('user_id', Auth::user()->id)
            ->where('offer_id', $request->get('offer_id'))
            ->update(['status' => $request->get('progress')]);
        return redirect()->route('offers.query')->with('info', __('Status updated'));
    }

    public function search(Request $request, $slug = null) 
    {
        try 
        {
            $offers = Offer::query()
                ->where(\DB::raw('TIMEDIFF(offers.end, offers.start)'), '>=', $request->get('duration'))
                ->where('wage', '>=', $request->get('wage'))
                ->where('created_at', '>=', $request->get('created_at'))
                ->where('seat', '>=', $request->get('seat'))
                ->latest('created_at')->paginate(10);
        }
        catch (\InvalidArgumentException $e) 
        {
            $offers = Offer::query()->oldest('name')->paginate(10);
        }
        return view('offers/index', compact('offers', 'slug'));
    }

    public function apply(Request $request) 
    {
        if (!Auth::user()->right->SFx29) {return redirect()->route('offers.index')->with('info', __('You cannot do that !'));}
        $offer_id = $request->get('offer_id');
        $name = $request->get('name');
        $companyName = $request->get('companyName');
        $companyEmail = $request->get('companyEmail');
        return view('offers/apply', compact('offer_id', 'name', 'companyName', 'companyEmail'));
    }

    public function sendEmail(Request $applyRequest) 
    {
        if (!Auth::user()->right->SFx29) {return redirect()->route('offers.index')->with('info', __('You cannot do that !'));}
        $applyRequest->CV->storeAs(config('attachments.path'), 'CV.pdf', 'public');
        $applyRequest->motivationLetter->storeAs(config('attachments.path'), 'motivationLetter.pdf', 'public');
        Mail::to($applyRequest->get('companyMail'))
            ->send(new Apply($applyRequest->except('_token')));
        Storage::disk('public')->delete(config('attachments.path').'\CV.pdf');
        Storage::disk('public')->delete(config('attachments.path').'\motivationLetter.pdf');
        DB::table('offer_user')->insert([
            'status' => '1',
            'offer_id' => $applyRequest->get('offer_id'),
            'user_id' => Auth::user()->id,
        ]);
        return redirect()->route('offers.index')->with('info', __('Email has been sent'));
    }

    public function addWish(Request $request) 
    {
        if (!Auth::user()->right->SFx27) {return redirect()->route('offers.index')->with('info', __('You cannot do that !'));}
        DB::table('offer_user')->insert([
            'status' => 0,
            'offer_id' => $request->get('id'),
            'user_id' => Auth::user()->id,
        ]);
        return redirect()->route('offers.index')->with('info', __('Offer has been added to your wish-list'));
    }

    public function removeWish(Request $request) 
    {
        if (!Auth::user()->right->SFx28) {return redirect()->route('offers.index')->with('info', __('You cannot do that !'));}
        DB::table('offer_user')->where('user_id', Auth::user()->id)->where('offer_id', $request->get('id'))->where('status', 'W')->delete();
        return redirect()->route('offers.wishlist')->with('info', __('Offer has been removed from your wish-list'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->right->SFx9) {return redirect()->route('offers.index')->with('info', __('You cannot do that !'));}
        return view('offers/create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfferRequest $offerRequest)
    {
        $offer = Offer::create($offerRequest->all());
        $offer->skills()->attach($offerRequest->skis);
        $offer->promotions()->attach($offerRequest->promos);
        return redirect()->route('offers.index')->with('info', __('The offer has been created'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        if (!Auth::user()->right->SFx12) {return redirect()->route('offers.index')->with('info', __('You cannot do that !'));}
        return view('offers/show', compact('offer'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        if (!Auth::user()->right->SFx10) {return redirect()->route('offers.index')->with('info', __('You cannot do that !'));}
        return view('offers/edit', compact('offer'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OfferRequest $offerRequest, Offer $offer)
    {
        $offer->update($offerRequest->all());
        $offer->skills()->sync($offerRequest->skis);
        $offer->promotions()->sync($offerRequest->promos);
        return redirect()->route('offers.index')->with('info', __('The offer have been modified'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        if (!Auth::user()->right->SFx11) {return redirect()->route('offers.index')->with('info', __('You cannot do that !'));}
        $offer->forceDelete();
        return back()->with('info', __('The offer have been deleted'));
    }
}
