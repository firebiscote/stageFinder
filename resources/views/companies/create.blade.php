@extends('appLayout', ['title' => __('Company creation')])

@section('content')

    <div class="card w-75 text-center mx-auto mt-3">
        <form action="{{ route('companies.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <label>{{ __('Company name') }} :</label>
                        <input id="name" type="text" class="form-control w-50 mx-auto mb-4" name="name" value="{{ old('name') }}">
                        @error('name')
                            <p class="mx-auto">{{ $message }}</p>
                        @enderror

                        <label>{{ __('Company email') }} :</label>
                        <input id="email" type="text" class="form-control w-50 mx-auto mb-4" name="email" value="{{ old('email') }}">
                        @error('email')
                            <p class="mx-auto">{{ $message }}</p>
                        @enderror

                        <label>{{ __('Localities') }} :</label><br>
                        <select name="locas[]" class="custom-select w-50" multiple>
                            @foreach($localities as $locality)
                                <option value="{{ $locality->id }}" {{ in_array($locality->id, old('locas') ? : []) ? 'selected' : '' }}>{{ $locality->name }}</option>
                            @endforeach
                        </select><br>

                        <label>{{ __('CESI trainee') }} :</label>
                        <input id="trainee" type="number" class="form-control w-50 mx-auto mb-4" name="trainee" value="{{ old('trainee') }}">
                        @error('trainee')
                            <p class="mx-auto">{{ $message }}</p>
                        @enderror

                        <label>{{ __('Buisness line') }} :</label>
                        <input id="line" type="text" class="form-control w-50 mx-auto mb-4" name="line" value="{{ old('line') }}">
                        @error('line')
                            <p class="mx-auto">{{ $message }}</p>
                        @enderror

                        <input type="submit" formaction="{{ route('students.store') }}" class="btn btn-success w-25 mt-4" value="{{ __('Create') }}">
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection