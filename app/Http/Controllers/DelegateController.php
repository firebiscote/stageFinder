<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    User,
    Locality,
    Promotion,
    Center,
};
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\{
    Route,
    Auth,
};

class DelegateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug = null)
    {
        if (!Auth::user()->right->SFx17) {return redirect()->route('offers.index')->with('info', __('You cannot do that !'));}
        $model = null;
        if($slug) {
            if(Route::currentRouteName() == 'delegates.center') {
                $model = new Center;
            } else {
                $model = new Promotion;
            } 
        }
        $query = $model ? $model::whereSlug($slug)->firstOrFail()->users() : User::query();
        $delegates = $query->withTrashed()->where('role', 'D')->oldest('name')->paginate(10);
        return view('delegates/index', compact('delegates', 'slug'));
    }

    public function search(Request $request, $slug = null) 
    {
        if ($request->get('name') == '' && $request->get('firstName') == '') {
            $delegates = User::query()->withTrashed()->where('role', 'D')->oldest('name')->paginate(10);
        } elseif ($request->get('name') != '' && $request->get('firstName') == '') {
            $delegates = User::query()->withTrashed()->where('role', 'D')->where('name', $request->get('name'))->oldest('name')->paginate(10);
        } elseif ($request->get('name') == '' && $request->get('firstName') != '') {
            $delegates = User::query()->withTrashed()->where('role', 'D')->where('firstName', $request->get('firstName'))->oldest('name')->paginate(10);
        } else {
            $delegates = User::query()->withTrashed()->where('role', 'D')->where('name', $request->get('name'))->where('firstName', $request->get('firstName'))->oldest('name')->paginate(10);
        }
        return view('delegates/index', compact('delegates', 'slug'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->right->SFx18) {return redirect()->route('offers.index')->with('info', __('You cannot do that !'));}
        return view('delegates/create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $delegateRequest)
    {
        $delegateRequest->merge(['password' => Hash::make($delegateRequest->get('password'))]);
        $delegateRequest->merge(['role' => 'D']);
        $delegate = User::create(array_merge($delegateRequest->all(), ['email_verified_at' => now()]));
        $delegate->promotions()->attach($delegateRequest->promos);
        return redirect()->route('delegates.index')->with('info', __('The delegate have been created'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $delegate)
    {
        if (!Auth::user()->right->SFx26) {return redirect()->route('offers.index')->with('info', __('You cannot do that !'));}
        $delegate->with('promotions')->get();
        return view('delegates/show', compact('delegate'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $delegate)
    {
        if (!Auth::user()->right->SFx19) {return redirect()->route('offers.index')->with('info', __('You cannot do that !'));}
        return view('delegates/edit', compact('delegate'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $delegateRequest, User $delegate)
    {
        $delegate->update($delegateRequest->all());
        $delegate->promotions()->sync($delegateRequest->promo);
        return redirect()->route('delegates.index')->with('info', __('The delegate have been modified'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $delegate)
    {
        if (!Auth::user()->right->SFx20) {return redirect()->route('offers.index')->with('info', __('You cannot do that !'));}
        $delegate->forceDelete();
        return back()->with('info', __('The delegate have been deleted'));
    }

    public function forceDestroy($id)
    {
        User::whereId($id)->firstOrFail()->forceDelete();
        return back()->with('info', 'La offre a bien été supprimé définitivement dans la base de données.');
    }

    public function restore($id)
    {
        User::whereId($id)->firstOrFail()->restore();
        return back()->with('info', 'La offre a bien été restauré.');
    }
}
