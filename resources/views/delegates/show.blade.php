@extends('appLayout', ['title' => __('Delegate')])

@section('content')

    <div class="card w-75 text-center  mx-auto mt-3">
        <h4 class='card-header text-center'>{{ $delegate->name }} {{ $delegate->firstName }}</h4>
        <div class="card-body ml-5">
            <p class="card-text">{{ __('Email') }} : {{ $delegate->email }}</p>
            <p class="card-text">{{ __('Center') }} : {{ $delegate->center->name }}</p>
            <p class="card-text">{{ __('Promotion') }} : {{ $delegate->promotions[0]->name }}</p>
        </div>
        @foreach($delegate->offers as $offer)
            <div class="card w-75 text-center  mx-auto mt-3">
                <h5 class="card-header etudiant">{{ $offer->name }} {{ __('from') }} {{ $offer->company->name }}</h5>
                <h6 class="card-header etudiant">{{ __('Step') }} : {{ $offer->status }}</h6>
                <form action="{{ route('delegates.changeState') }}" method="POST">
                    @csrf
                    <div class="input-group mt-3 mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text">{{ __('Advancement') }}</label>
                        </div>
                        <input type="hidden" name="user_id" value="{{ $delegate->id }}">
                        <input type="hidden" name="offer_id" value="{{ $offer->id }}">
                        <input type="hidden" name="previousStatus" value="{{ $offer->status }}">
                        <select class="custom-select" name="progress">
                            @if(Auth::user()->right->SFx30)
                                <option value="1">{{ __('Waiting for response') }}</option>  
                            @endif
                            @if(Auth::user()->right->SFx31)
                                <option value="2">{{ __('Positive response') }}</option>       
                                <option value="7">{{ __('Negative response') }}</option>                
                            @endif
                            @if(Auth::user()->right->SFx32)
                                <option value="3">{{ __('Validation sheet has been sent by the company') }}</option>            
                            @endif
                            @if(Auth::user()->right->SFx33)
                                <option value="4">{{ __('Validation sheet has been signed by the tutor') }}</option>             
                            @endif
                            @if(Auth::user()->right->SFx34)
                                <option value="5">{{ __('Internship agreement has been sent by the company') }}</option>                 
                            @endif
                            @if(Auth::user()->right->SFx35)
                                <option value="6">{{ __('Intership agreement has been signed') }}</option>
                            @endif
                        </select>

                        <input type="submit" class="btn btn-success center-block" value="{{ __('Validate') }}">
                    </div>
                </form>
            </div> 
        @endforeach       
    </div>  

@endsection


