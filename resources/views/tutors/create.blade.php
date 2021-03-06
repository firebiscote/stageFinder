@extends('appLayout', ['title' => __('Tutor creation')])

@section('content')

    <div class="card w-75 text-center  mx-auto mt-3" >
        <form action="{{ route('tutors.store') }}" method="POST">
            @csrf
            <div class="card-body row">
                <div class="col">
                    <label>{{ __('Name') }} :</label>
                    <input type="text" class="form-control w-50 mx-auto" name="name" value="{{ old('name') }}">
                    @error('name')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                    <label>{{ __('Firstname') }} :</label>
                    <input type="text" class="form-control w-50 mx-auto" name="firstName" value="{{ old('firstName') }}">
                    @error('firstName')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                    <label>{{ __('Center') }} :</label><br>
                    <select name="center_id" class="custom-select w-50">
                        @foreach($centers as $center)
                            <option value="{{ $center->id }}">{{ $center->name }}</option>
                        @endforeach
                    </select><br>
                    <label>{{ __('Assigned promotions') }} :</label><br>
                    <select name="promos[]" class="custom-select w-50" multiple>
                        @foreach($promotions as $promotion)
                        <option value="{{ $promotion->id }}" {{ in_array($promotion->id, old('promos') ? : []) ? 'selected' : '' }}>{{ $promotion->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label>{{ __('Email') }} :</label>
                    <input type="email" class="form-control w-50 mx-auto" name="email" value="{{ old('email') }}">
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
                    @error('confirmPassword')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror                 
                    <input type="submit" class="btn btn-success w-25 mt-3" value="{{ __('Create') }}">
                </div>
            </div>
        </form>
    </div>

@endsection