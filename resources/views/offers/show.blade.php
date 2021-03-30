@extends('appLayout', ['title' => __('Offer')])


@section('content')

    <div class="card w-75 text-center  mx-auto mt-3">
        <div class="card-header text-center">
            <h5>{{ $offer->name }} {{ __('from') }} {{ $offer->company->name }}</h5>
            <p class="font-italic">{{ __('Offer filed the') }} {{ $offer->created_at }}</p>
        </div>
        <div class="card-body">
            <h5>{{ __('Offer\'s statistics') }} :</h5>
            <div class="card w-75 mx-auto mb-3">
                <div class="card-body ">
                    <p class="card-text text-justify">{{ __('Skills') }} : @foreach($offer->skills as $skill) {{ $skill->name }} @endforeach</p>
                    <p class="card-text text-justify">{{ __('Locality') }} : {{ $offer->locality->name }}</p>
                    <p class="card-text text-justify">{{ __('Targeted promotion') }} : @foreach($offer->promotions as $promotion) {{ $promotion->name }} @endforeach</p>
                    <p class="card-text text-justify">{{ __('Internship duration') }}: {{ $offer->start }} -> {{ $offer->end }}</p>
                    <p class="card-text text-justify">{{ __('Wage') }} (/h) : {{ $offer->wage }} €</p>
                    <p class="card-text text-justify">{{ __('Seat') }} : {{ $offer->seat }}</p>
                </div>
            </div>
            <h5>{{ __('Offer\'s description') }} :</h5>
            <div class="card w-75 mx-auto mb-3">
                <div class="card-body ">
                    <p class="card-text text-justify">{{ $offer->comment }}</p>
                </div>
            </div>
            @if(Auth::user()->right->SFx27 && Auth::user()->right->SFx28)
                <!--<a type="button" class="btn btn-success mt-5 w-25 h-50" style="white-space:normal" href ="{{ route('offers.apply', $offer) }}">{{ __('Apply') }}</a><br>-->
                <form action="{{ route('offers.apply', $offer->id) }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $offer->id }}" name="offer_id">
                    <input type="hidden" value="{{ $offer->name }}" name="name">
                    <input type="hidden" value="{{ $offer->company->name }}" name="companyName">
                    <input type="hidden" value="{{ $offer->company->email }}" name="companyEmail">
                    <input type="submit" class="btn btn-success mt-5 w-25 h-50" style="white-space:normal" value="{{ __('Apply') }}">
                </form>
                <form action="{{ route('offers.addWish') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $offer->id }}" name="id">
                    <input type="submit" class="btn btn-dark mt-5 w-25 h-50" style="white-space:normal" value="{{ __('Add to wish-list') }}">
                </form>
            @endif
        </div>
    </div>

@endsection