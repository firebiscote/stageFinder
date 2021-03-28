@extends('appLayout', ['title' => "Modification d'un étudiant"])

@section('content')

    <div class="card w-75 text-center  mx-auto mt-3" >
        <form action="{{ route('tutors.update', $tutor->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body row">
                <div class="col">
                    <label>{{ __('Name') }} :</label>
                    <input type="text" class="form-control w-50 mx-auto" name="name" value="{{ old('name', $tutor->name) }}">
                    <label>{{ __('Firstname') }} :</label>
                    <input type="text" class="form-control w-50 mx-auto" name="firstName" value="{{ old('firstName', $tutor->firstName) }}">
                    <label>{{ __('Center') }} :</label><br>
                    <select name="center_id" class="custom-select">
                        @foreach($centers as $center)
                            <option value="{{ $center->id }}" {{ ($center->id == old('center_id') ? : $tutor->center->id) ? 'selected' : '' }}>{{ $center->name }}</option>
                        @endforeach
                    </select>
                    <label>{{ __('Promotion') }} :</label><br>
                    <select name="promos[]" class="custom-select" multiple>
                        @foreach($promotions as $promotion)
                            <option value="{{ $promotion->id }}" {{ in_array($promotion->id, old('promos') ? : $tutor->promotions->pluck('id')->all()) ? 'selected' : '' }}>{{ $promotion->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label>{{ __('Email') }} :</label>
                    <input type="email" class="form-control w-50 mx-auto" name="email" value="{{ old('email', $tutor->email) }}">
                    
                    <label>{{ __('Password') }} :</label>
                    <input type="password" class="form-control w-50 mx-auto" name="password">
                    
                    <label>{{ __('Confirm password') }} :</label>
                    <input type="password" class="form-control w-50 mx-auto" name="confirmPassword">      
                            
                    <input type="submit" class="btn btn-dark w-25 mt-3" value="{{ __('Modify') }}">
                </div>
            </div>
        </form>
    </div>

@endsection