@extends('appLayout', ['title' => "Modification d'un étudiant"])

@section('content')

    <div class="card w-75 text-center  mx-auto mt-3" >
        <form action="{{ route('students.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body row">
                <div class="col">
                    <label>{{ __('Name') }} :</label>
                    <input type="text" class="form-control w-50 mx-auto" name="name" value="{{ old('name', $student->name) }}">
                    @error('name')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror

                    <label>{{ __('Firstname') }} :</label>
                    <input type="text" class="form-control w-50 mx-auto" name="firstName" value="{{ old('firstName', $student->firstName) }}">
                    @error('firstName')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                    
                    <label>{{ __('Center') }} :</label><br>
                    <select name="center_id" class="custom-select w-50">
                        @foreach($centers as $center)
                            <option value="{{ $center->id }}" {{ ($center->id == old('center_id') ? : $student->center->id) ? 'selected' : '' }}>{{ $center->name }}</option>
                        @endforeach
                    </select><br>
                    
                    <label>{{ __('Promotion') }} :</label><br>
                    <select name="promo[]" class="custom-select w-50">
                        @foreach($promotions as $promotion)
                            <option value="{{ $promotion->id }}" {{ in_array($promotion->id, old('promo') ?: $student->promotions->pluck('id')->all()) ? 'selected' : '' }}>{{ $promotion->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label>{{ __('Email') }} :</label>
                    <input type="email" class="form-control w-50 mx-auto" name="email" value="{{ old('email', $student->email) }}">
                    @error('email')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                    
                    <label>{{ __('Password') }} :</label>
                    <input type="password" class="form-control w-50 mx-auto" name="password">
                    @error('password')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                    
                    <label>{{ __('Confirm password') }} :</label>
                    <input type="password" class="form-control w-50 mx-auto" name="confirmPassword"> 
                    @error('password')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror     
           
                    <input type="submit" class="btn btn-warning w-25 mt-3" value="{{ __('Modify') }}">
                </div>
            </div>
        </form>
    </div>

@endsection