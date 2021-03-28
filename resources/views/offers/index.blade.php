@extends('appLayout', ['title' => __('Our offers')])

@section('content')

    <div class="row">
        <div class="col-3">
            <div class="card  w-75 text-center  mx-auto mt-3">
                <div class="card-header text-center">
                    <h5>{{ __('Filter') }} :</h5>
                </div>
                <div class="card-body">
                    <p class="text-left mt-2">{{ __('Company') }} :</p>
                        <select class="custom-select" onchange="window.location.href = this.value">
                            <option value="{{ route('offers.index') }}" @unless($slug) selected @endunless>{{ __('All categories') }}</option>
                            @foreach($companies as $company)
                                <option value="{{ route('offers.company', $company->slug) }}" {{ $slug == $company->slug ? 'selected' : '' }}>{{ $company->name }}</option>
                            @endforeach
                    </select>

                    <p class="text-left mt-2">{{ __('Promotion') }} :</p>
                    <select class="custom-select" onchange="window.location.href = this.value">
                        <option value="{{ route('offers.index') }}" @unless($slug) selected @endunless>{{ __('All categories') }}</option>
                        @foreach($promotions as $promotion)
                            <option value="{{ route('offers.promotion', $promotion->slug) }}" {{ $slug == $promotion->slug ? 'selected' : '' }}>{{ $promotion->name }}</option>
                        @endforeach
                    </select>

                    <p class="text-left mt-2">{{ __('Locality') }} :</p>
                    <select class="custom-select" onchange="window.location.href = this.value">
                        <option value="{{ route('offers.index') }}" @unless($slug) selected @endunless>{{ __('All categories') }}</option>
                        @foreach($localities as $locality)
                            <option value="{{ route('offers.locality', $locality->slug) }}" {{ $slug == $locality->slug ? 'selected' : '' }}>{{ $locality->name }}</option>
                        @endforeach
                    </select>

                    <p class="text-left mt-2">{{ __('Skills') }} :</p>
                    <select class="custom-select" onchange="window.location.href = this.value">
                        <option value="{{ route('offers.index') }}" @unless($slug) selected @endunless>{{ __('All categories') }}</option>
                        @foreach($skills as $skill)
                            <option value="{{ route('offers.skill', $skill->slug) }}" {{ $slug == $skill->slug ? 'selected' : '' }}>{{ $skill->name }}</option>
                        @endforeach
                    </select>

                    <form action="{{ route('offers.search') }}" method="GET">
                        @csrf
                        <p class="text-left mt-2">{{ __('Internship duration') }} :</p>
                        <input type="search" class="form-control" name="duration">

                        <p class="text-left mt-2">{{ __('Wage') }}(/h) :</p>
                        <input type="number" class="form-control" step="0.01" name="wage">

                        <p class="text-left mt-2">{{ __('Offer date') }} :</p>
                        <input type="date" class="form-control">

                        <p class="text-left mt-2">{{ __('Seat') }} :</p>
                        <input type="number" class="form-control">

                        <input type="submit" class="btn btn-dark mt-4 w-100" value="{{ __('Search') }}">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card  mt-3">
                <div class="card-header text-left">
                    <div class="row">
                        <div class="col">
                            <h5>{{ __('Results') }} :</h5>
                        </div>
                        @if(Auth::user()->right->SFx3)
                            <div class="col text-right">
                                <a type="button" class="btn btn-success" href ="{{ route('offers.create') }}">{{ __('Create an offer') }}</a>                      
                            </div>
                        @endif
                    </div>
                </div>
                @foreach($offers as $offer)
                    <div class="card-body">
                        <div class="card  mt-3 mb-3">        
                            <div class="card-body" >
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-left">{{ $offer->name }}</h5>
                                        <p class="card-text text-left">{{ __('from') }} {{ $offer->company->name }}</p>
                                    </div>
                                    <div class="col text-right">
                                        <a type="button" class="btn btn-dark" href ="{{ route('offers.show', $offer->id) }}">{{ __('See') }}</a>
                                        @if(Auth::user()->right->SFx10)
                                            <a type="button" class="btn btn-warning" href ="{{ route('offers.edit', $offer->id) }}">{{ __('Modify') }}</a>   
                                        @endif
                                        @if(Auth::user()->right->SFx11)
                                            <form action="{{ route('offers.destroy', $offer->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" class="btn btn-danger w-25" value="{{ __('Delete') }}">
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <footer class="card-footer is-centered">
                    {{ $offers->links() }}
                </footer>
            </div>
        </div> 
    </div>

@endsection