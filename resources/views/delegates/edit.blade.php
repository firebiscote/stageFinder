@extends('appLayout', ['title' => __('Delegate modification')])

@section('content')

    <div class="card w-75 text-center mx-auto mt-3">
        <form action="{{ route('delegates.update', $delegate->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body row">
                <div class="col">
                    <label>{{ __('Name') }} :</label>
                    <input type="text" class="form-control w-50 mx-auto" name="name" value="{{ old('name', $delegate->name) }}">
                    @error('name')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror

                    <label>{{ __('Firstname') }} :</label>
                    <input type="text" class="form-control w-50 mx-auto" name="firstName" value="{{ old('firstName', $delegate->firstName) }}">
                    @error('firstName')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror

                    <label>{{ __('Center') }} :</label><br>
                    <select name="center_id" class="custom-select w-50">
                        @foreach($centers as $center)
                            <option value="{{ $center->id }}" {{ ($center->id == old('center_id') ? : $delegate->center->id) ? 'selected' : '' }}>{{ $center->name }}</option>
                        @endforeach
                    </select><br>

                    <label>{{ __('Promotion') }} :</label><br>
                    <select name="promo[]" class="custom-select w-50">
                        @foreach($promotions as $promotion)
                                <option value="{{ $promotion->id }}" {{ in_array($promotion->id, old('promo') ?: $delegate->promotions->pluck('id')->all()) ? 'selected' : '' }}>{{ $promotion->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label>{{ __('Email') }} :</label>
                    <input type="email" class="form-control w-50 mx-auto" name="email" value="{{ old('email', $delegate->email) }}">
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
                    @if(Auth::user()->right->SFx21)
                        <div class="mt-4">
                            <select class="custom-select" name="righs[]" multiple>
                    <!--Pour préremplir, mettre selected après option si l'option était cochée lors de la création-->
                                <optgroup label="{{ __('Offer') }}">
                                    <option name="SFx9">{{ __('Create') }}</option>
                                    <option name="SFx10">{{ __('Modify') }}</option>
                                    <option name="SFx11">{{ __('Delete') }}</option>
                                </optgroup>
                                <optgroup label="{{ __('Tutor') }}">
                                    <option name="SFx13">{{ __('Search') }}</option>
                                    <option name="SFx14">{{ __('Create') }}</option>
                                    <option name="SFx15">{{ __('Modify') }}</option>
                                    <option name="SFx16">{{ __('Delete') }}</option>
                                </optgroup>
                                <optgroup label="{{ __('Delegate') }}">
                                    <option name="SFx17">{{ __('Search') }}</option>
                                    <option name="SFx18">{{ __('Create') }}</option>
                                    <option name="SFx19">{{ __('Modify') }}</option>
                                    <option name="SFx20">{{ __('Delete') }}</option>
                                </optgroup>
                                <optgroup label="{{ __('Student') }}">
                                    <option name="SFx22">{{ __('Search') }}</option>
                                    <option name="SFx23">{{ __('Create') }}</option>
                                    <option name="SFx24">{{ __('Modify') }}</option>
                                    <option name="SFx25">{{ __('Delete') }}</option>
                                    <option name="SFx26">{{ __('See statistics') }}</option>
                                </optgroup>
                                <optgroup label="{{('Process')}}">
                                    <option name="SFx32">{{ __('Inform system of apply advancement step') }} 3</option>
                                    <option name="SFx33">{{ __('Inform system of apply advancement step') }} 4</option>
                                </optgroup>
                            </select>
                        </div>  
                    @endif              
                    <input type="submit" class="btn btn-warning w-25 mt-3" value="{{ __('Modify') }}">
                </div>
            </div>
        </form>
    </div>

@endsection