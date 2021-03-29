@extends('appLayout', ['title' => __('Delegate creation')])

@section('content')

<div class="card w-75 text-center mx-auto mt-3" >
        <form action="{{ route('delegates.store') }}" method="POST">
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

                    <label>{{ __('Promotion') }} :</label><br>
                    <select name="promo[]" class="custom-select w-50">
                        @foreach($promotions as $promotion)
                            <option value="{{ $promotion->id }}">{{ $promotion->name }}</option>
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

                    <select class="custom-select mt-4" name="righs[]" multiple>
                        <optgroup label="{{ __('Offer') }}">
                            <option value="9">{{ __('Create') }}</option>
                            <optio value="10">{{ __('Modify') }}</optio>
                            <option value="11">{{ __('Delete') }}</option>
                        </optgroup>
                        <optgroup label="{{ __('Tutor') }}">
                            <option value="13">{{ __('Search') }}</option>
                            <option value="14">{{ __('Create') }}</option>
                            <option value="15">{{ __('Modify') }}</option>
                            <option value="16">{{ __('Delete') }}</option>
                        </optgroup>
                        <optgroup label="{{ __('Delegate') }}">
                            <option value="17">{{ __('Search') }}</option>
                            <option value="18">{{ __('Create') }}</option>
                            <option value="19">{{ __('Modify') }}</option>
                            <option value="20">{{ __('Delete') }}</option>
                        </optgroup>
                        <optgroup label="{{ __('Student') }}">
                            <option value="22">{{ __('Search') }}</option>
                            <option value="23">{{ __('Create') }}</option>
                            <option value="24">{{ __('Modify') }}</option>
                            <option value="25">{{ __('Delete') }}</option>
                            <option value="26">{{ __('See statistics') }}</option>
                        </optgroup>
                        <optgroup label="{{('Process')}}">
                            <option value="32">{{ __('Inform system of apply advancement step') }} 3</option>
                            <option value="33">{{ __('Inform system of apply advancement step') }} 4</option>
                        </optgroup>
                    </select><br>
  
                    <input type="submit" class="btn btn-success w-25 mt-3" value="{{ __('Create') }}">
                </div>
            </div>
        </form>
    </div>

@endsection