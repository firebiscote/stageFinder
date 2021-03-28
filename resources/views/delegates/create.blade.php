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
                    <select name="promotion_id" class="custom-select w-50">
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

                    <select class="custom-select mt-4" multiple>
                    <!--Pour préremplir, mettre selected après option si l'option était cochée lors de la création-->
                        <optgroup label="{{ __('Company') }}">
                            <option>{{ __('Search') }}</option>
                            <option>{{ __('Create') }}</option>
                            <option>{{ __('Modify') }}</option>
                            <option>{{ __('Delete') }}</option>
                            <option>{{ __('Rate') }}</option>
                            <option>{{ __('See statistics') }}</option>
                        </optgroup>
                        <optgroup label="{{ __('Offer') }}">
                            <option>{{ __('Search') }}</option>
                            <option>{{ __('Create') }}</option>
                            <option>{{ __('Modify') }}</option>
                            <option>{{ __('Delete') }}</option>
                            <option>{{ __('See statistics') }}</option>
                        </optgroup>
                        <optgroup label="{{ __('Tutor') }}">
                            <option>{{ __('Search') }}</option>
                            <option>{{ __('Create') }}</option>
                            <option>{{ __('Modify') }}</option>
                            <option>{{ __('Delete') }}</option>
                        </optgroup>
                        <optgroup label="{{ __('Delegate') }}">
                            <option>{{ __('Search') }}</option>
                            <option>{{ __('Create') }}</option>
                            <option>{{ __('Modify') }}</option>
                            <option>{{ __('Delete') }}</option>
                        </optgroup>
                        <optgroup label="{{ __('Student') }}">
                            <option>{{ __('Search') }}</option>
                            <option>{{ __('Create') }}</option>
                            <option>{{ __('Modify') }}</option>
                            <option>{{ __('Delete') }}</option>
                        </optgroup>
                        <optgroup label="Avancement">
                            <option>{{ __('Inform system of apply advancement step') }} 3</option>
                            <option>{{ __('Inform system of apply advancement step') }} 4</option>
                        </optgroup>
                    </select><br>
  
                    <input type="submit" class="btn btn-success w-25 mt-3" value="{{ __('Create') }}">
                </div>
            </div>
        </form>
    </div>

@endsection