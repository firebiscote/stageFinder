@extends('appLayout', ['title' => __('Company modification')])

@section('content')

    <div class="card w-75 text-center  mx-auto mt-3">
        <form action="{{ route('companies.update', $company->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <label>{{ __('Company's name') }} :</label>
                        <input type="text" class="form-control w-50 mx-auto mb-4" name="name" value="{{ old('name', $company->name) }}">
                        @error('name')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror

                        <label>{{ __('Company's email') }} :</label>
                        <input type="text" class="form-control w-50 mx-auto mb-4" name="email" value="{{ old('email', $company->email) }}">
                        @error('email')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror

                        <label>{{ __('Localities') }} :</label><br>
                        <select name="locas[]" class="custom-select w-50" multiple>
                            @foreach($localities as $locality)
                                <option value="{{ $locality->id }}" {{ in_array($locality->id, old('locas') ?: $company->localities->pluck('id')->all()) ? 'selected' : '' }}>{{ $locality->name }}</option>
                            @endforeach
                        </select><br>

                        <label>{{ __('CESI intern') }} :</label>
                        <input type="number" class="form-control w-50 mx-auto mb-4" name="trainee" value="{{ old('trainee', $company->trainee) }}">
                        @error('trainee')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror

                        <label>{{ __('Business line') }} :</label>
                        <input type="text" class="form-control w-50 mx-auto mb-4" name="line" value="{{ old('line', $company->line) }}">
                        @error('line')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                        
                        <input type="submit" class="btn btn-warning w-25 mt-4" value="{{ __('Modify') }}">
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection