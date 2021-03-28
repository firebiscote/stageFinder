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
use App\Http\Requests\OfferRequest;
use Illuminate\Support\Facades\{
    DB,
    Route,
    Auth,
};

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
        $offers = $query->withTrashed()->oldest('created_at')->paginate(10);
        return view('offers/index', compact('offers', 'slug'));
    }

    public function wishlist() {
        $offers = Offer::query()
            ->whereIn('id', DB::table('offer_user')->where('user_id', Auth::user()->id)->where('status', 'W')->pluck('offer_id'))
            ->oldest('created_at')
            ->paginate(10);
        foreach($offers as $offer) {
            var_dump($offer->company);
        }
        return view('offers/wishlist', compact('offers'));
    }

    public function query() {
        $offers = Offer::query()
            ->whereIn('id', DB::table('offer_user')->where('user_id', Auth::user()->id)->where('status', 'A')->pluck('offer_id'))
            ->oldest('created_at')
            ->paginate(10);
        return view('offers/query', compact('offers'));
    }

    public function search(Request $request, $slug = null) 
    {
        try {
            $offers = Offer::query()
                ->where(\DB::raw('TIMEDIFF(offers.end, offers.start)'), '>=', $request->get('duration'))
                ->where('wage', '>=', $request->get('wage'))
                ->where('created_at', '>=', $request->get('created_at'))
                ->where('seat', '>=', $request->get('seat'))
                ->oldest('name')->paginate(10);
        } 
        catch (\InvalidArgumentException $e) {
            $offers = Offer::query()->oldest('name')->paginate(10);
        }
        return view('offers/index', compact('offers', 'slug'));
    }

    public function apply(Offer $offer) 
    {
        if (!Auth::user()->right->SFx29) {return redirect()->route('offers.index')->with('info', __('You cannot do that !'));}
        var_dump($offer->name);
        return view('offers/apply', compact('offer'));
    }

    public function addWish(Request $request) 
    {
        if (!Auth::user()->right->SFx27) {return redirect()->route('offers.index')->with('info', __('You cannot do that !'));}
        DB::table('offer_user')->insert([
            'status' => 'W',
            'offer_id' => $request->get('id'),
            'user_id' => Auth::user()->id,
        ]);
        return redirect()->route('offers.index')->with('info', __('Offer have been added to your wish-list'));
    }

    public function removeWish(Request $request) 
    {
        if (!Auth::user()->right->SFx28) {return redirect()->route('offers.index')->with('info', __('You cannot do that !'));}
        DB::table('offer_user')->where('user_id', Auth::user()->id)->where('offer_id', $request->get('id'))->where('status', 'W')->delete();
        return redirect()->route('offers.wishlist')->with('info', __('Offer have been remove from your wish-list'));
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
        return redirect()->route('offers.index')->with('info', __('The offer have been created'));
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
        return redirect()->route('offers.index')->with('info', 'Le offre à bien été modifié');
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

    public function forceDestroy($id)
    {
        Offer::withTrashed()->whereId($id)->firstOrFail()->forceDelete();
        return back()->with('info', 'La offre a bien été supprimé définitivement dans la base de données.');
    }

    public function restore($id)
    {
        Offer::withTrashed()->whereId($id)->firstOrFail()->restore();
        return back()->with('info', 'La offre a bien été restauré.');
    }
}
