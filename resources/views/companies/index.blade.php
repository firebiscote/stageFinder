@extends('appLayout', ['title' => __('Our companies')])

@section('content')

    <div class="row">
        <div class="col-3">
            <div class="card  w-75 text-center  mx-auto mt-3">
                <div class="card-header text-center">
                    <h5>{{ __('Filters') }} :</h5>
                </div>
                <form action="{{ route('companies.search') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <p class="text-left mt-2">{{ __('Name') }} :</p>
                        <input type="search" class="form-control" name="name">
                        
                        <p class="text-left mt-2">{{ __('Business line') }} :</p>
                        <input type="search" class="form-control" name="line">
                        
                        <p class="text-left mt-2">{{ __('CESI intern') }} :</p>
                        <input type="number" class="form-control" min="0" value="0" name="trainee">
                        
                        <p class="text-left mt-2">{{ __('Intern\'s grade') }} (/10) :</p>
                        <input type="number" class="form-control" min="1" max="10" value="1" name="grade">
                        
                        <p class="text-left mt-2">{{ __('Tutor\'s trust') }} (/10) :</p>
                        <input type="number" class="form-control" min="1" max="10" value="1" name="confidence">
                        
                        <input type="submit" class="btn btn-dark mt-4" value="{{ __('Search') }}">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-9">
            <div class="card  mt-3">
                <div class="card-header text-left">
                    <div class="row">
                        <div class="col">
                            <h5>{{ __('Results') }} :</h5>
                        </div>
                        @if(Auth::user()->right->SFx3)
                            <div class="col text-right">
                                <a type="button" class="btn btn-success" href ="{{ route('companies.create') }}">{{ __('Create a new company') }}</a>                       
                            </div>
                        @endif
                    </div>
                </div>
                @foreach($companies as $company)
                    <div class="card-body">
                        <div class="card  mt-3 mb-3">        
                            <div class="card-body" >
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-left">{{ $company->name }}</h5>
                                        <p class="card-text text-left">@foreach($company->localities as $locality) {{ $locality->name }} @endforeach</p>
                                    </div>
                                    <div class="col text-right">
                                        <a type="button" class="btn btn-dark" href="{{ route('companies.show', $company->id) }}">{{ __('See') }}</a>
                                        @if(Auth::user()->right->SFx4)								
                                            <a type="button" class="btn btn-warning" href ="{{ route('companies.edit', $company->id) }}">{{ __('Modify') }}</a>
                                        @endif
                                        @if(Auth::user()->right->SFx6)	
                                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" class="btn btn-danger" value="{{ __('Delete') }}">
                                            </form>	
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <footer class="card-footer is-centered">
                {{ $companies->links() }}
            </footer>
        </div> 
    </div>

@endsection