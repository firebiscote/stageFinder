@extends('appLayout', ['title' => __('Student')])

@section('content')

    <div class="card w-75 text-center  mx-auto mt-3">
        <h4 class='card-header text-center'>{{ $student->name }} {{ $student->firstName }}</h4>
        <div class="card-body ml-5">
            <p class="card-text">{{ __('Email') }} : {{ $student->email }}</p>
            <p class="card-text">{{ __('Center') }} : {{ $student->center->name }}</p>
            <p class="card-text">{{ __('Promotion') }} : {{ $student->promotions[0]->name }}</p>
        </div>
        @foreach($student->offers as $offer)
            <div class="card w-75 text-center  mx-auto mt-3">
                <h5 class="card-header etudiant">{{ $offer->name }} {{ __('from') }} {{ $offer->company->name }}</h5>
                <div class="input-group mt-3 mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text">{{ __('Advancement') }}</label>
                    </div>
                    <select class="custom-select">
                        <option selected>Choose...</option>
                        @if(Auth::user()->right->SFx30)
                            <option value="1">En attente d'une réponse</option>  
                        @endif                
                        @if(Auth::user()->right->SFx31)
                            <option value="2">Réponse positive</option>       
                            <option value="3">Réponse négative</option>                
                        @endif
                        @if(Auth::user()->right->SFx32)
                            <option value="3">Fiche de validation émise par l'entreprise</option>            
                        @endif 
                        @if(Auth::user()->right->SFx33)
                            <option value="3">Fiche de validation signée par le pilote</option>             
                        @endif 
                        @if(Auth::user()->right->SFx34)
                            <option value="3">Conventions émises à l'entreprise</option>                 
                        @endif 
                        @if(Auth::user()->right->SFx35)
                            <option value="3">Conventions signées</option>
                        @endif 
                    </select>
                    <button type="button" class="btn btn-success center-block">{{ __('Validate') }}</button>
                </div>
            </div>
        @endforeach       
    </div>  

@endsection


