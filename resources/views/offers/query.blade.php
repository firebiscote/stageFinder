@extends('appLayout', ['title' => __('My requests')])

@section('content')

    @foreach($offers as $offer)
        <div class="card w-75 text-center  mx-auto mt-3">
            <h5 class="card-header etudiant">{{ $offer->name }} {{ __('from') }} {{ $offer->company->name }}</h5>
            <h6 class="card-header etudiant">{{ __('Step') }} : {{ $offer->status }}</h6>
            <form action="{{ route('offers.changeState') }}" method="POST">
                @csrf
                <div class="input-group mt-3 mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text">{{ __('Advancement') }}</label>
                    </div>
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

@endsection