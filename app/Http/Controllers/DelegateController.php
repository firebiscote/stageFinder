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
use Illuminate\Support\Facades\Route;

class DelegateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug = null)
    {
        $model = null;
        if($slug) {
            if(Route::currentRouteName() == 'delegates.center') {
                $model = new Center;
            } else {
                $model = new Promotion;
            } 
        }
        $query = $model ? $model::whereSlug($slug)->firstOrFail()->users() : User::query();
        $delegates = $query->withTrashed()->where('role', 'D')->oldest('name')->paginate(5);
        return view('delegates/index', compact('delegates', 'slug'));
    }

    public function search(Request $request, $slug = null) 
    {
        if ($request->get('name') == '' && $request->get('firstName') == '') {
            $delegates = User::query()->withTrashed()->where('role', 'E')->oldest('name')->paginate(5);
        } elseif ($request->get('name') != '' && $request->get('firstName') == '') {
            $delegates = User::query()->withTrashed()->where('role', 'E')->where('name', $request->get('name'))->oldest('name')->paginate(5);
        } elseif ($request->get('name') == '' && $request->get('firstName') != '') {
            $delegates = User::query()->withTrashed()->where('role', 'E')->where('firstName', $request->get('firstName'))->oldest('name')->paginate(5);
        } else {
            $delegates = User::query()->withTrashed()->where('role', 'E')->where('name', $request->get('name'))->where('firstName', $request->get('firstName'))->oldest('name')->paginate(5);
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
        return view('delegates/create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $userRequest)
    {
        $delegate = User::create($userRequest->all());
        $delegate->role = 'S';
        $delegate->promotions()->attach($userRequest->promotion_id);
        $delegate->centers()->attach($userRequest->center_id);
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
        return view('delegates/edit', compact('delegate'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(userRequest $userRequest, user $user)
    {
        $user->update($userRequest->all());
        $user->promotions()->sync($userRequest->promo);
        return redirect()->route('delegates.index')->with('info', 'Le offre à bien été modifié');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('info', 'La offre a bien été mis dans la corbeille.');
    }

    public function forceDestroy($id)
    {
        user::whereId($id)->firstOrFail()->forceDelete();
        return back()->with('info', 'La offre a bien été supprimé définitivement dans la base de données.');
    }

    public function restore($id)
    {
        user::whereId($id)->firstOrFail()->restore();
        return back()->with('info', 'La offre a bien été restauré.');
    }
}