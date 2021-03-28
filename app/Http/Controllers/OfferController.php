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
        var_dump($offer->name);
        return view('offers/apply', compact('offer'));
    }

    public function add(Request $request) 
    {
        DB::table('offer_user')->insert([
            'status' => 'W',
            'offer_id' => $request->get('id'),
            'user_id' => Auth::user()->id,
        ]);
        return redirect()->route('offers.index')->with('info', __('Offer have been added to your wish-list'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $offer->promotions()->attach($offerRequest->promo);
        return redirect()->route('offers.index')->with('info', 'La offre a bien été créée');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        var_dump($offer->id);
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
        $offer->promotions()->sync($offerRequest->promo);
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
