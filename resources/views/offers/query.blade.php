@extends('appLayout', ['title' => "Mes demandes"])

@section('content')

    @foreach($offers as $offer)
        <div class="card w-75 text-center  mx-auto mt-3">
            <h5 class="card-header etudiant">{{ $offer->name }} {{ __('from') }} {{ $offer->company->name }}</h5>
            <div class="input-group mt-3 mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text">{{ __('Advancement') }}</label>
                </div>
                <select class="custom-select ">
                    <option selected>Choose...</option>
                    <option value="1">En attente d'une réponse</option>
                    <option value="2">Réponse positive</option>
                    <option value="3">Réponse négative</option>
                    <option value="3">Fiche de validation signée par le pilote</option>
                </select>
                <button type="button" class="btn btn-dark center-block">{{ __('Validate') }}</button>
            </div>
        </div>
    @endforeach

@endsection