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

class TutorController extends Controller
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
            if (Route::currentRouteName() == 'tutors.center') {
                $model = new Center;
            } else {
                $model = new Promotion;
            } 
        }
        $query = $model ? $model::whereSlug($slug)->firstOrFail()->users() : User::query();
        $tutors = $query->withTrashed()->where('role', 'T')->oldest('name')->paginate(5);
        return view('tutors/index', compact('tutors', 'slug'));
    }

    public function search(Request $request, $slug = null) 
    {
        if ($request->get('name') == '' && $request->get('firstName') == '') {
            $tutors = User::query()->withTrashed()->where('role', 'E')->oldest('name')->paginate(5);
        } elseif ($request->get('name') != '' && $request->get('firstName') == '') {
            $tutors = User::query()->withTrashed()->where('role', 'E')->where('name', $request->get('name'))->oldest('name')->paginate(5);
        } elseif ($request->get('name') == '' && $request->get('firstName') != '') {
            $tutors = User::query()->withTrashed()->where('role', 'E')->where('firstName', $request->get('firstName'))->oldest('name')->paginate(5);
        } else {
            $tutors = User::query()->withTrashed()->where('role', 'E')->where('name', $request->get('name'))->where('firstName', $request->get('firstName'))->oldest('name')->paginate(5);
        }
        return view('tutors/index', compact('tutors', 'slug'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tutors/create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $userRequest)
    {
        $tutor = User::create($userRequest->all());
        $tutor->role = 'S';
        $tutor->promotions()->attach($userRequest->promotion_id);
        $tutor->centers()->attach($userRequest->center_id);
        return redirect()->route('tutors.index')->with('info', __('The tutor have been created'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $tutor)
    {
        $tutor->with('promotions')->get();
        return view('tutors/show', compact('tutor'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $tutor)
    {
        return view('tutors/edit', compact('tutor'));
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
        return redirect()->route('tutors.index')->with('info', 'Le offre à bien été modifié');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $tutor)
    {
        $tutor->forceDelete();
        return back()->with('info', __('The tutor have been deleted'));
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
