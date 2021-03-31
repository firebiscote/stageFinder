<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    User,
    Locality,
    Promotion,
    Center,
    Right,
};
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\{
    Route,
    Auth,
    Hash,
    DB,
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
        if (!Auth::user()->right->SFx17) 
        {
            return redirect()->route('offers.index')->with('info', __('You cannot do that !'));
        }
        $model = null;
        if($slug) 
        {
            if(Route::currentRouteName() == 'delegates.center')
            {
                $model = new Center;
            } else
            {
                $model = new Promotion;
            } 
        }
        $query = $model ? $model::whereSlug($slug)->firstOrFail()->users() : User::query();
        $delegates = $query->withTrashed()->where('role', 'D')->oldest('name')->paginate(10);
        return view('delegates/index', compact('delegates', 'slug'));
    }
    
    public function search(Request $request, $slug = null) 
    {
        if ($request->get('name') == '' && $request->get('firstName') == '')
        {
            $delegates = User::query()
                ->withTrashed()
                ->where('role', 'D')
                ->oldest('name')->paginate(10);
        } elseif ($request->get('name') != '' && $request->get('firstName') == '')
        {
            $delegates = User::query()
                ->withTrashed()
                ->where('role', 'D')
                ->where('name', $request->get('name'))
                ->oldest('name')->paginate(10);
        } elseif ($request->get('name') == '' && $request->get('firstName') != '')
        {
            $delegates = User::query()
            ->withTrashed()
            ->where('role', 'D')
            ->where('firstName', $request->get('firstName'))
            ->oldest('name')->paginate(10);
        } else
        {
            $delegates = User::query()
            ->withTrashed()
            ->where('role', 'D')
            ->where('name', $request->get('name'))
            ->where('firstName', $request->get('firstName'))
            ->oldest('name')->paginate(10);
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
        if (!Auth::user()->right->SFx18)
        {
            return redirect()->route('offers.index')->with('info', __('You cannot do that !'));
        }
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
        $enteredRight = [];
        for ($i = 1; $i < 36; $i++) {
            if (in_array($i, array_merge($delegateRequest->righs,
                                        [1, 2, 3, 4, 5, 6, 7, 8, 12, 27, 28, 29, 30, 31, 34]))) {
                $enteredRight['SFx'.$i] = 1;
            } else {
                $enteredRight['SFx'.$i] = 0;
            }
        }
        $delegateRequest->merge(['password' => Hash::make($delegateRequest->get('password'))]);
        $delegateRequest->merge(['role' => 'D']);
        $delegate = User::create(array_merge($delegateRequest->all(), ['email_verified_at' => now()]));
        $delegate->promotions()->attach($delegateRequest->promos);
        $right = Right::create($enteredRight);
        $delegate = User::create(array_merge($delegateRequest->all(), ['email_verified_at' => now(),
                                                                        'right_id' => $right->id]));
        $delegate->promotions()->attach($delegateRequest->promo);
        return redirect()->route('delegates.index')->with('info', __('The delegate has been created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $delegate)
    {
        if (!Auth::user()->right->SFx26)
        {
            return redirect()->route('offers.index')->with('info', __('You cannot do that !'));
        }
        $delegate->with('promotions')->get();
        foreach ($delegate->offers as $offer)
        {
            $offer->status = \DB::table('offer_user')
                ->where('user_id', $delegate->id)
                ->where('offer_id', $offer->id)
                ->pluck('status')[0];
        }
        return view('delegates/show', compact('delegate'));
    }

    public function changeState(Request $request)
    {
        if ($request->get('progress') == 7)
        {
            \DB::table('offer_user')
                ->where('user_id', $request->get('user_id'))
                ->where('offer_id', $request->get('offer_id'))
                ->delete();
            return redirect()->route('delegates.index')->with('info', __('Sorry'));
        }
        if ($request->get('progress') == 6)
        {
            \DB::table('company_user')
                ->insert(['company_id' => DB::table('offers')
                                            ->where('id', $request->get('offer_id'))
                                            ->pluck('company_id')[0],
                          'user_id' => $request->get('user_id')]);
        }
        \DB::table('offer_user')
            ->where('user_id', $request->get('user_id'))
            ->where('offer_id', $request->get('offer_id'))
            ->update(['status' => $request->get('progress')]);
        return redirect()->route('delegates.index')->with('info', __('Status updated'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $delegate)
    {
        if (!Auth::user()->right->SFx19)
        {
            return redirect()->route('offers.index')->with('info', __('You cannot do that !'));
        }
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
        $enteredRight = [];
        for ($i = 1; $i < 36; $i++) {
            if (in_array($i, array_merge($delegateRequest->righs,
                                        [1, 2, 3, 4, 5, 6, 7, 8, 12, 27, 28, 29, 30, 31, 34]))) {
                $enteredRight['SFx'.$i] = 1;
            } else {
                $enteredRight['SFx'.$i] = 0;
            }
        }
        $delegateRequest->merge(['password' => Hash::make($delegateRequest->get('password'))]);
        $right = Right::create($enteredRight);
        $delegate->update(array_merge($delegateRequest->all(), ['right_id' => $right->id]));
        $delegate->promotions()->sync($delegateRequest->promo);
        return redirect()->route('delegates.index')->with('info', __('The delegate has been modified'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $delegate)
    {
        if (!Auth::user()->right->SFx20)
        {
            return redirect()->route('offers.index')->with('info', __('You cannot do that !'));
        }
        $delegate->forceDelete();
        return back()->with('info', __('The delegate have been deleted'));
    }
}
