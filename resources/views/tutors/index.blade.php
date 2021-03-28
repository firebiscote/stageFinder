@extends('appLayout', ['title' => __('Tutors')])

@section('content')

    @if(session()->has('info'))
        <div class="notification is-success">
            {{ session('info') }}
        </div>
    @endif
    <div class="card w-75 text-center  mx-auto mt-3">
        <div class="row">
            <div class="col">
                <form action="{{ route('tutors.search') }}" method="get">
                    @csrf
                    <label>{{ __('Name') }} :</label>
                    <input type="search" class="form-control w-50 mx-auto" name="name">
                    <label>{{ __('Firstname') }} :</label>
                    <input type="search" class="form-control w-50 mx-auto" name="firstName">
                    <input type="submit" class="btn btn-dark w-25 mt-3" value="{{ __('Search') }}">
                </form><br>
                <label>{{ __('Center') }} :</label><br>
                <select class="custom-select w-50" onchange="window.location.href = this.value">
                    <option value="{{ route('tutors.index') }}" @unless($slug) selected @endunless>{{ __('All categories') }}</option>
                    @foreach($centers as $center)
                        <option value="{{ route('tutors.center', $center->slug) }}" {{ $slug == $center->slug ? 'selected' : '' }}>{{ $center->name }}</option>
                    @endforeach
                </select><br>
                <label>{{ __('Promotion') }} :</label><br>
                <select class="custom-select w-50" onchange="window.location.href = this.value">
                    <option value="{{ route('tutors.index') }}" @unless($slug) selected @endunless>{{ __('All categories') }}</option>
                    @foreach($promotions as $promotion)
                        <option value="{{ route('tutors.promotion', $promotion->slug) }}" {{ $slug == $promotion->slug ? 'selected' : '' }}>{{ $promotion->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                @if(Auth::user()->right->SFx14)
                <div class="col">
                    <a type="button" class="btn btn-success w-50 mt-5" href ="{{ route('tutors.create') }}">{{ __('Create a new tutor') }}</a>
                </div>
                @endif
            </div>
        </div>
        @foreach($tutors as $tutor)
        <div class="card mt-5 w-75 mx-auto">
            <div class="row">
                <div class="col">
                    <h5 class="card-title">{{$tutor->name}} {{$tutor->firstName}}</h5>
                    <p class="card-text">{{ __('Center of') }} {{$tutor->center->name}}</p>
                    @foreach($tutor->promotions as $promotion)                    
                        <p class="card-text">{{ __('Promotion') }} : {{$promotion->name}}</p>
                    @endforeach
                </div>
                <div class="col text-right mt-4">
                    @if(Auth::user()->right->SFx15)
                        <a type="button" class="btn btn-warning w-25" href ="{{ route('tutors.edit', $tutor->id) }}">{{ __('Modify') }}</a>
                    @endif
                    @if(Auth::user()->right->SFx15)
                        <form action="{{ route('tutors.destroy', $tutor->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-danger w-25" value="{{ __('Delete') }}">
                        </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
        <footer class="card-footer is-centered">
            {{ $tutors->links() }}
        </footer>
    </div>

@endsection

