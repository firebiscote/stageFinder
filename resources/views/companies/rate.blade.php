@extends('appLayout', ['title' => __('Company rating')])

@section('content')

    <div class="card w-75 text-center mx-auto mt-3">
        <form action="{{ route('companies.storeRating') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row ">
                    <div class="col mx-5 ">
                        <input type="hidden" name="company_id" value="{{ $id }}">
                        <h5>{{ __('Grade') }} ( /10) :</h5>
                        <input type="number" class="form-control text-center" min="1" max="10" name="grade">
                        <h5 class="mt-4">{{ __('Comment') }} :</h5>
                        <textarea class="form-control" rows="3" name="comment"></textarea>
                        <input type="submit" class="btn btn-success mt-4" value="{{ __('Rate') }}">
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection