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
                        <form action="{{ route('offers.removeWish') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $offer->id }}" name="id">
                            <input type="submit" class="btn btn-danger" value="{{ __('Remove') }}">
                        </form>
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