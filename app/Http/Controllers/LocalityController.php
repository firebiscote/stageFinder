<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Locality;
use App\Http\Requests\LocalityRequest;

class LocalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $localities = Locality::withTrashed()->oldest('name')->paginate(10);
        return view('localities/index', compact('localities'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('localities/create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocalityRequest $localityRequest)
    {
        Locality::create($localityRequest->all());
        return redirect()->route('localities.index')->with('info', 'La localitée a bien été créée');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Locality $locality)
    {
        return view('localities/show', compact('locality'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Locality $locality)
    {
        return view('localities/edit', compact('locality'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocalityRequest $localityRequest, Locality $locality)
    {
        $locality->update($localityRequest->all());
        return redirect()->route('localities.index')->with('info', 'Le film à bien été modifié');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Locality $locality)
    {
        $locality->delete();
        return back()->with('info', 'La localitée a bien été mis dans la corbeille.');
    }

    public function forceDestroy($id)
    {
        Locality::withTrashed()->whereId($id)->firstOrFail()->forceDelete();
        return back()->with('info', 'La localitée a bien été supprimé définitivement dans la base de données.');
    }

    public function restore($id)
    {
        Locality::withTrashed()->whereId($id)->firstOrFail()->restore();
        return back()->with('info', 'La localitée a bien été restauré.');
    }
}
