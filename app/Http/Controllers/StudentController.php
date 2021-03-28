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

class StudentController extends Controller
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
            if (Route::currentRouteName() == 'students.center') {
                $model = new Center;
            } else {
                $model = new Promotion;
            } 
        }
        $query = $model ? $model::whereSlug($slug)->firstOrFail()->users() : User::query();
        $students = $query->withTrashed()->whereIn('role', ['S', 'D'])->oldest('name')->paginate(5);
        return view('students/index', compact('students', 'slug'));
    }

    public function search(Request $request, $slug = null) 
    {
        if ($request->get('name') == '' && $request->get('firstName') == '') {
            $students = User::query()->withTrashed()->where('role', 'E')->oldest('name')->paginate(5);
        } elseif ($request->get('name') != '' && $request->get('firstName') == '') {
            $students = User::query()->withTrashed()->where('role', 'E')->where('name', $request->get('name'))->oldest('name')->paginate(5);
        } elseif ($request->get('name') == '' && $request->get('firstName') != '') {
            $students = User::query()->withTrashed()->where('role', 'E')->where('firstName', $request->get('firstName'))->oldest('name')->paginate(5);
        } else {
            $students = User::query()->withTrashed()->where('role', 'E')->where('name', $request->get('name'))->where('firstName', $request->get('firstName'))->oldest('name')->paginate(5);
        }
        return view('students/index', compact('students', 'slug'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students/create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $userRequest)
    {
        $student = User::create($userRequest->all());
        $student->role = 'S';
        $student->promotions()->attach($userRequest->promotion_id);
        $student->centers()->attach($userRequest->center_id);
        return redirect()->route('students.index')->with('info', __('The student have been created'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $student)
    {
        $student->with('promotions')->get();
        return view('students/show', compact('student'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $student)
    {
        return view('students/edit', compact('student'));
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
        return redirect()->route('students.index')->with('info', 'Le offre à bien été modifié');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $student)
    {
        $user->forceDelete();
        return back()->with('info', __('The student have been deleted'));
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
