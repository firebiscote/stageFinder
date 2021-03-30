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
    Hash,
    Auth,
};

class TutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug = null)
    {
        if (!Auth::user()->right->SFx13) {return redirect()->route('offers.index')->with('info', __('You cannot do that !'));}
        $model = null;
        if ($slug) {
            if (Route::currentRouteName() == 'tutors.center') {
                $model = new Center;
            } else {
                $model = new Promotion;
            } 
        }
        $query = $model ? $model::whereSlug($slug)->firstOrFail()->users() : User::query();
        $tutors = $query->withTrashed()->where('role', 'T')->oldest('name')->paginate(10);
        return view('tutors/index', compact('tutors', 'slug'));
    }

    public function search(Request $request, $slug = null) 
    {
        if ($request->get('name') == '' && $request->get('firstName') == '') {
            $tutors = User::query()->withTrashed()->where('role', 'T')->oldest('name')->paginate(10);
        } elseif ($request->get('name') != '' && $request->get('firstName') == '') {
            $tutors = User::query()->withTrashed()->where('role', 'T')->where('name', $request->get('name'))->oldest('name')->paginate(10);
        } elseif ($request->get('name') == '' && $request->get('firstName') != '') {
            $tutors = User::query()->withTrashed()->where('role', 'T')->where('firstName', $request->get('firstName'))->oldest('name')->paginate(10);
        } else {
            $tutors = User::query()->withTrashed()->where('role', 'T')->where('name', $request->get('name'))->where('firstName', $request->get('firstName'))->oldest('name')->paginate(10);
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
        if (!Auth::user()->right->SFx14) {return redirect()->route('offers.index')->with('info', __('You cannot do that !'));}
        return view('tutors/create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $tutorRequest)
    {
        $tutorRequest->merge(['password' => Hash::make($tutorRequest->get('password'))]);
        $tutorRequest->merge(['role' => 'T']);
        $tutor = User::create(array_merge($tutorRequest->all(), ['email_verified_at' => now(),
                                                                'right_id' => 3]));
        $tutor->promotions()->attach($tutorRequest->promos);
        return redirect()->route('tutors.index')->with('info', __('The tutor has been created'));
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
        if (!Auth::user()->right->SFx15) {return redirect()->route('offers.index')->with('info', __('You cannot do that !'));}
        return view('tutors/edit', compact('tutor'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $tutorRequest, User $tutor)
    {
        $tutorRequest->merge(['password' => Hash::make($tutorRequest->get('password'))]);
        $tutor->update($tutorRequest->all());
        $tutor->promotions()->sync($tutorRequest->promos);
        return redirect()->route('tutors.index')->with('info', __('The tutor has been modified'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $tutor)
    {
        if (!Auth::user()->right->SFx16) {return redirect()->route('offers.index')->with('info', __('You cannot do that !'));}
        $tutor->forceDelete();
        return back()->with('info', __('The tutor has been deleted'));
    }
}
