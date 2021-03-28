@extends('appLayout', ['title' => __('Apply')])

@section('content')

    <div class="card w-75 text-center  mx-auto mt-3" id="content">
        <h5 class="card-header">
            {{ $offer->name }} {{ __('from') }} {{ $offer->company->name }}
        </h5>
        <form action="{{ route('offers.apply') }}" method="POST">
            <div class="card-body">
                <div class="row">
                    <div class="col-1"><h5 class="card-text text-right">{{ __('to') }} :</h5></div>
                    <div class="col-11"><p class="card-text text-left">{{ $offer->company->email }}</p></div>
                </div>  
                <div class="row mt-3">
                    <div class="col-1"><h5 class="card-text text-right ">{{ __('from') }} :</h5></div>
                    <div class="col-11"><p class="card-text text-left">{{ Auth::user()->email }}</p></div>
                </div> 
                <div class="row mt-3">
                    <div class="col-1"><h6 class="card-text" >{{ __('Message') }} :</h6></div>
                    <div class="col-11"> <textarea class="form-control" rows="3"></textarea></div>
                </div>
                <div class="row mt-3" >
                    <div class="col-2 text-left">
                        <h6 class="card-text text-left">{{ __('Attachments') }} :</h6>
                    </div>
                    <div class="col-1">
                        <p class="text-right">{{ __('CV') }}</p>                
                    </div>
                    <div class="col-6">
                        <input class="form-control" type="file">  
                    </div>
                </div>
                <div class="row mt-3" >
                    <div class="col-3">
                        <p class="text-right">{{ __('Motivation letter') }}</p>                
                    </div>
                    <div class="col-6">
                        <input class="form-control" type="file">  
                    </div>
                </div>
                <input type="submit" class="btn btn-success center-block mt-3 w-25" value="{{ __('Validate') }}">
            </div>
        </form>
    </div>

@endsection