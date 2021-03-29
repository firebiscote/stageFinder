@extends('appLayout', ['title' => __('Offer creation')])

@section('content')

    <div class="card w-75 text-center mx-auto mt-3">
        <form action="{{ route('offers.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>{{ __('Company\'s name') }} :</label><br>
                        <select name="company_id" class="custom-select">
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ in_array($company->id, old('company_id') ? : []) ? 'selected' : '' }}>{{ $company->name }}</option>
                            @endforeach
                        </select><br>
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('Localities') }} :</label><br>
                        <select name="locality_id" class="custom-select">
                            @foreach($localities as $locality)
                                <option value="{{ $locality->id }}" {{ in_array($locality->id, old('company_id') ? : []) ? 'selected' : '' }}>{{ $locality->name }}</option>
                            @endforeach
                        </select><br>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>{{ __('Offer\'s name') }}</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        @error('name')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('Seat') }}</label>
                        <input type="number" class="form-control" min="1" max="100" name="seat" value="{{ old('seat') }}">
                        @error('seat')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>{{ __('Internship duration') }}</label>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <div class="col-sm-2 text-right" ><p>{{ __('from') }}</p></div>
                                    <div class="col-sm-8"><input type="date" class="form-control" min="2021-03-01" name="start" value="{{ old('start') }}"></div>
                                    @error('start')
                                        <p class="help is-danger">{{ $message }}</p>
                                    @enderror
                                </div>                                                                
                            </div>
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <div class="col-sm-2 text-right "><p>{{ __('to') }}</p></div>
                                    <div class="col-sm-8"><input type="date" class="form-control" min="2021-05-01" name="end" value="{{ old('end') }}"></div>
                                    @error('end')
                                        <p class="help is-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('Required skills') }}</label><br>
                        <select name="skis[]" class="custom-select" multiple>
                            @foreach($skills as $skill)
                                <option value="{{ $skill->id }}" {{ in_array($skill->id, old('skis') ? : []) ? 'selected' : '' }}>{{ $skill->name }}</option>
                            @endforeach
                        </select><br>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>{{ __('Targeted promotion') }}</label><br>
                        <select name="promos[]" class="custom-select" multiple>
                            @foreach($promotions as $promotion)
                                <option value="{{ $promotion->id }}" {{ in_array($promotion->id, old('promos') ? : []) ? 'selected' : '' }}>{{ $promotion->name }}</option>
                            @endforeach
                        </select><br>
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('Wage') }} (/h)</label>
                        <input type="number" step="0.01" min="3.90" max="99.99" class="form-control" name="wage" value="{{ old('wage') }}">
                        @error('wage')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>{{ __('Offer\'s description') }}</label>
                        <textarea class="form-control" rows="3" name="comment">{{ old('comment') }}</textarea>
                        @error('comment')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 text-center">
                        <input type="submit" class="btn btn-success mt-5 w-25 h-50" value="{{ __('Create') }}">
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection