@extends('appLayout', ['title' => __('Delegates list')])

@section('content')

    <div class="card w-75 text-center  mx-auto mt-3">
        <div class="row">
            <div class="col">
                <form action="{{ route('delegates.search') }}" method="get">
                    @csrf
                    <label>{{ __('Name') }} :</label>
                    <input type="search" class="form-control w-50 mx-auto" name="name">
                    <label>{{ __('Firstname') }} :</label>
                    <input type="search" class="form-control w-50 mx-auto" name="firstName">
                    <input type="submit" class="btn btn-dark w-25 mt-3" value="{{ __('Search') }}">
                </form><br>
                <label>{{ __('Center') }} :</label><br>
                <select class="custom-select w-50" onchange="window.location.href = this.value">
                    <option value="{{ route('delegates.index') }}" @unless($slug) selected @endunless>{{ __('All categories') }}</option>
                    @foreach($centers as $center)
                        <option value="{{ route('delegates.center', $center->slug) }}" {{ $slug == $center->slug ? 'selected' : '' }}>{{ $center->name }}</option>
                    @endforeach
                </select><br>
                <label>{{ __('Promotion') }} :</label><br>
                <select class="custom-select w-50" onchange="window.location.href = this.value">
                    <option value="{{ route('delegates.index') }}" @unless($slug) selected @endunless>{{ __('All categories') }}</option>
                    @foreach($promotions as $promotion)
                        <option value="{{ route('delegates.promotion', $promotion->slug) }}" {{ $slug == $promotion->slug ? 'selected' : '' }}>{{ $promotion->name }}</option>
                    @endforeach
                </select>
            </div>
            @if(Auth::user()->right->SFx23)
            <div class="col">
                <a type="button" class="btn btn-success w-50 mt-5" href ="{{ route('delegates.create') }}">{{ __('Create a new delegate') }}</a>
            </div>
            @endif
        </div>
        @foreach($delegates as $delegate)
        <div class="card mt-5 w-75 mx-auto">
            <div class="row">
                <div class="col">
                    <h5 class="card-title">{{$delegate->name}} {{$delegate->firstName}}</h5>
                    <p class="card-text">{{ __('Center of') }} {{$delegate->center->name}}</p>
                    @foreach($delegate->promotions as $promotion)                    
                        <p class="card-text">{{ __('Promotion') }} : {{$promotion->name}}</p>
                    @endforeach
                </div>
                <div class="col text-right mt-4">
                    <a type="button" class="btn btn-dark w-25" href ="{{ route('delegates.show', $delegate->id) }}">{{ __('See') }}</a>
                    <a type="button" class="btn btn-warning w-25" href ="{{ url('/delegates/modify') }}">{{ __('Modify') }}</a>
                    <button type="button" class="btn btn-danger w-25">{{ __('Delete') }}</button>
                </div>
            </div>
        </div>
        @endforeach
        <footer class="card-footer is-centered">
            {{ $delegates->links() }}
        </footer>
    </div>

@endsection
