@extends('appLayout', ['title' => __('Offer modification')])

@section('content')

	<div class="card  w-75 text-center  mx-auto mt-3">
        <div class="card-header text-center">
            <h5>{{ __('Offer from') }} : {{ $offer->company->name }} {{ __('at') }} {{ $offer->locality->name }} {{ __('on') }} {{ $offer->created_at }}</h5>
        </div>
        <form action="{{ route('offers.update', $offer->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>{{ __('Offer name') }}</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $offer->name) }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('Seat available') }}</label>
                        <input type="number" class="form-control" min="1" max="100" name="seat" value="{{ old('seat', $offer->seat) }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>{{ __('Internship duration') }}</label>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <div class="col-sm-2 text-right" ><p>{{ __('from') }}</p></div>
                                    <div class="col-sm-8"><input type="date" class="form-control" min="2021-03-01" name="start" value="{{ old('start', $offer->start) }}"></div>
                                </div>                                                                
                            </div>
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <div class="col-sm-2 text-right "><p>{{ __('to') }}</p></div>
                                    <div class="col-sm-8"><input type="date" class="form-control" min="2021-05-01" name="end" value="{{ old('end', $offer->end) }}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('Skills required') }}</label><br>
                        <select name="skis[]" class="custom-select" multiple>
                            @foreach($skills as $skill)
                                <option value="{{ $skill->id }}" {{ in_array($skill->id, old('skis') ? : $offer->skills->pluck('id')->all()) ? 'selected' : '' }}>{{ $skill->name }}</option>
                            @endforeach
                        </select><br>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>{{ __('Targeted promotion') }}</label><br>
                        <select name="promos[]" class="custom-select" multiple>
                            @foreach($promotions as $promotion)
                                <option value="{{ $promotion->id }}" {{ in_array($promotion->id, old('promos') ? : $offer->promotions->pluck('id')->all()) ? 'selected' : '' }}>{{ $promotion->name }}</option>
                            @endforeach
                        </select><br>
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('Wage') }} (/h)</label>
                        <input type="number" step="0.01" min="3.90" max="99.99" class="form-control" name="wage" value="{{ old('wage', $offer->wage) }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>{{ __('Offer description') }}</label>
                        <textarea class="form-control" rows="3" name="comment">{{ old('comment', $offer->comment) }}</textarea>
                    </div>
                    <div class="form-group col-md-6 text-center">
                        <input type="submit" class="btn btn-warning mt-5 w-25 h-50" value="{{ __('Modify') }}">
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection