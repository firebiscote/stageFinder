@extends('appLayout', ['title' => __('Wish-list')])

@section('content')

    @foreach($offers as $offer)
    <div class="card w-75 mx-auto mt-3 mb-3">        
        <div class="card-body" >
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title">{{ $offer->name }}</h5>
                        <p class="card-text">{{ __('from') }} {{ $offer->company->name }}</p>
                    </div>
                    <div class="col text-right">
                        <a type="button" class="btn btn-success"  href ="{{ route('offers.show', $offer->id) }}">{{ __('See') }}</a>
                        <button type="button" class="btn btn-danger">{{ __('Remove') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <footer class="card-footer is-centered">
        {{ $offers->links() }}
    </footer>

@endsection