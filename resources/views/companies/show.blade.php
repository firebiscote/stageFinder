@extends('appLayout', ['title' => __('Company')])

@section('content')

    <div class="card  w-75 mx-auto mt-3">
        <h5 class="card-header">{{ $company->name }}</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-6"><h5 class="card-text text-right">{{ __('Email') }} :</h5></div>
                <div class="col-6"><p class="card-text text-left">{{ $company->email }}</p></div>
            </div>
            <div class="row mt-3">
                <div class="col-6"><h5 class="card-text text-right">{{ __('Buisness line') }} :</h5></div>
                <div class="col-6"><p class="card-text text-left">{{ $company->line }}</p></div>
            </div>
            <div class="row mt-3">
                <div class="col-6"><h5 class="card-text text-right">{{ __('Locality') }}</h5></div>
                <div class="col-6"><p class="card-text text-left">@foreach($company->localities as $locality) {{ $locality->name }} @endforeach</p></div>
            </div>
            <div class="row mt-3">
                <div class="col-6"><h5 class="card-text text-right">{{ __('Tutor confidence') }} :</h5></div>
                <div class="col-6"><p class="card-text text-left">{{ $company->confidence }}</p></div>
            </div>
            <div class="row mt-3">
                <div class="col-6"><h5 class="card-text text-right">{{ __('CESI trainee') }} :</h5></div>
                <div class="col-6"><p class="card-text text-left">{{ $company->trainee }}</p></div>
            </div>
            @if(Auth::user()->right->SFx5)
                <div class="row mt-4 justify-content-center">
                    <form action="{{ route('companies.rate') }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $company->id }}" name="id">
                        <input type="submit" class="btn btn-success center-block" value="{{ __('Rate the company') }}">
                    </form>
                    <!--<a type="button" class="btn btn-success center-block" href ="{{ url('/evaluerEntreprise') }}">{{ __('Rate the company') }}</a>-->
                </div>
            @endif
            <div class="row mt-4">
                <div class="col-6">
                    <h5 class="card-title text-center">{{ __('Available offers') }} :</h5>
                    @foreach($company->offers as $offer)
                        <div class="card mt-2 w-75 mx-auto">
                            <div class="row">
                                <div class="col mt-4 ml-2 mb-4">
                                    <h5 class="card-title">{{ $offer->name }}</h5>
                                </div>
                                <div class="col text-right mt-4 mr-2 mb-4">
                                    <a type="button" class="btn btn-dark w-50" href ="{{ route('offers.show', $offer->id) }}">{{ __('See') }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-6">
                    <h5 class="card-title text-center">{{ __('Available ratings') }} :</h5>
                    @foreach($company->ratings as $rating)
                        <div class="card mt-2 w-75 mx-auto">
                            <div class="row">
                                <div class="col mt-4 ml-2 mb-4">
                                    <p class="card-title">{{ $rating->comment }}</p>
                                </div>
                                <div class="col text-right mt-4 mr-2 mb-4">
                                    <p class="card-title">{{ $rating->grade }}/10</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection

