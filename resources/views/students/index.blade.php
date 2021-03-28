@extends('appLayout', ['title' => __('Students list')])

@section('content')

    @if(session()->has('info'))
        <div class="notification is-success">
            {{ session('info') }}
        </div>
    @endif
    <div class="card w-75 text-center  mx-auto mt-3">
        <div class="row">
            <div class="col">
                <form action="{{ route('students.search') }}" method="get">
                    @csrf
                    <label>{{ __('Name') }} :</label>
                    <input type="search" class="form-control w-50 mx-auto" name="name">
                    
                    <label>{{ __('Firstname') }} :</label>
                    <input type="search" class="form-control w-50 mx-auto" name="firstName">
                    
                    <input type="submit" class="btn btn-dark w-25 mt-3" value="{{ __('Search') }}">
                </form><br>
                
                <label>{{ __('Center') }} :</label><br>
                <select class="custom-select w-50" onchange="window.location.href = this.value">
                    <option value="{{ route('students.index') }}" @unless($slug) selected @endunless>{{ __('All categories') }}</option>
                    @foreach($centers as $center)
                        <option value="{{ route('students.center', $center->slug) }}" {{ $slug == $center->slug ? 'selected' : '' }}>{{ $center->name }}</option>
                    @endforeach
                </select><br>
                
                <label>{{ __('Promotion') }} :</label><br>
                <select class="custom-select w-50" onchange="window.location.href = this.value">
                    <option value="{{ route('students.index') }}" @unless($slug) selected @endunless>{{ __('All categories') }}</option>
                    @foreach($promotions as $promotion)
                        <option value="{{ route('students.promotion', $promotion->slug) }}" {{ $slug == $promotion->slug ? 'selected' : '' }}>{{ $promotion->name }}</option>
                    @endforeach
                </select>
            </div>
            @if(Auth::user()->right->SFx23)
            <div class="col">
                <a type="button" class="btn btn-success w-50 mt-5" href ="{{ route('students.create') }}">{{ __('Create a new student') }}</a>
            </div>
            @endif
        </div>
        @foreach($students as $student)
        <div class="card mt-5 w-75 mx-auto">
            <div class="row">
                <div class="col">
                    <h5 class="card-title">{{$student->name}} {{ $student->firstName }}</h5>
                    <p class="card-text">{{ __('Center of') }} {{ $student->center->name }}</p>
                    @foreach($student->promotions as $promotion)                    
                        <p class="card-text">{{ __('Promotion') }} : {{ $promotion->name }}</p>
                    @endforeach
                </div>
                <div class="col text-right mt-4">
                    @if(Auth::user()->right->SFx26)
                        <a type="button" class="btn btn-dark w-25" href ="{{ route('students.show', $student->id) }}">{{ __('See') }}</a>
                    @endif
                    @if(Auth::user()->right->SFx24)
                        <a type="button" class="btn btn-warning w-25" href ="{{ route('students.edit', $student->id) }}">{{ __('Modify') }}</a>
                    @endif
                    @if(Auth::user()->right->SFx25)
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST">
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
            {{ $students->links() }}
        </footer>
    </div>

@endsection
