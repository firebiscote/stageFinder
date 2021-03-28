@extends('appLayout', ['title' => __('Delegate modification')])

@section('content')

    <div class="card w-75 text-center mx-auto mt-3">
        <form action="{{ route('students.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body row">
                <div class="col">
                    <label>{{ __('Name') }} :</label>
                    <input type="text" class="form-control w-50 mx-auto" name="name" value="{{ old('name', $student->name) }}">

                    <label>{{ __('Firstname') }} :</label>
                    <input type="text" class="form-control w-50 mx-auto" name="firstName" value="{{ old('firstName', $student->firstName) }}">

                    <label>{{ __('Center') }} :</label>
                    <select name="center_id" class="custom-select">
                        @foreach($centers as $center)
                            <option value="{{ $center->id }}" {{ ($center->id == old('center_id') ? : $tutor->center->id) ? 'selected' : '' }}>{{ $center->name }}</option>
                        @endforeach
                    </select>

                    <label>{{ __('Promotion') }} :</label><br>
                    <select name="promo[]" class="custom-select">
                        @foreach($promotions as $promotion)
                                <option value="{{ $promotion->id }}" {{ in_array($promotion->id, old('promo') ?: $delegate->promotions->pluck('id')->all()) ? 'selected' : '' }}>{{ $promotion->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label>{{ __('Email') }} :</label>
                    <input type="email" class="form-control w-50 mx-auto" name="email" value="{{ old('email', $delegate->email) }}">
                        
                    <label>{{ __('Password') }} :</label>
                    <input type="password" class="form-control w-50 mx-auto" name="password">
                        
                    <label>{{ __('Confirm password') }} :</label>
                    <input type="password" class="form-control w-50 mx-auto" name="confirmPassword"> 
                    @if(Auth::user()->right->SFx21)
                        <div class="mt-4">
                            <select class="custom-select" multiple>
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
                            </select>
                        </div>  
                    @endif              
                    <input type="submit" class="btn btn-warning w-25 mt-3" value="{{ __('Modify') }}">
                </div>
            </div>
        </form>
    </div>

@endsection