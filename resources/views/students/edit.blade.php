@extends('appLayout', ['title' => "Modification d'un étudiant"])

@section('content')

    <div class="card w-75 text-center  mx-auto mt-3" >
        <form action="{{ route('students.update', $student->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="card-body row">
                <div class="col">
                    <label>{{ __('Name') }} :</label>
                    <input type="text" class="form-control w-50 mx-auto" value="[Nom]">

                    <label>{{ __('Firstname') }} :</label>
                    <input type="text" class="form-control w-50 mx-auto" value="[Prénom]">
                    
                    <label>{{ __('Center') }} :</label>
                    <select name="cent[]">
                        @foreach($centers as $center)
                            <option value="{{ $center->id }}" {{ in_array($center->id, old('cent') ?: $student->centers->pluck('id')->all()) ? 'selected' : '' }}>{{ $center->name }}</option>
                        @endforeach
                    </select>
                    
                    <label>{{ __('Promotion') }} :</label><br>
                    <select name="promo[]">
                        @foreach($promotions as $promotion)
                            <option value="{{ $promotion->id }}" {{ in_array($promotion->id, old('promo') ?: $student->promotions->pluck('id')->all()) ? 'selected' : '' }}>{{ $promotion->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label>{{ __('Email') }} :</label>
                    <input type="email" class="form-control w-50 mx-auto" value="[Mail]">
                    
                    <label>{{ __('Password') }} :</label>
                    <input type="password" class="form-control w-50 mx-auto" value="[Mot de passe]">
                    
                    <label>{{ __('Confirm password') }} :</label>
                    <input type="password" class="form-control w-50 mx-auto" value="[Mot de passe]">      
                    
                    <div class="mt-4">
                        <input type="checkbox">
                        <label>{{ __('Delegate') }}</label>
                    </div>   
           
                    <input type="submit" class="btn btn-dark w-25 mt-3" value="{{ __('Modify') }}">
                </div>
            </div>
        </form>
    </div>

@endsection