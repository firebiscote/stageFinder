<!DOCTYPE html>
<html >
    <head>
        <meta charset="utf-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ __('authentification') }}</title>
    </head>
    <body>
        <div class="card w-75 text-center  mx-auto mt-5 ">
            <div class="card-header row">
                <div class="col-0 text-left">
                    <img id="logo" src="{{url('image/cesi.png')}}" alt="{{ __('CESI logo') }}"/>
                </div>
                <div class="col-12 ">
                    <h2>{{ __('Welcome to your internship search site') }}</h2>
                </div>
            </div>
            <div class="card-body">
                <p class="card-title mb-5 mt-5">Ce site a pour but de vous aider dans vos recherches de stage. Il répertorie différentes annonces et les entreprises qui leur sont associées. Vous pourrez également suivre l'avancement de vos demandes, tenir une Wish-list ainsi que de nombreuses autres fonctionnalités. </p>
                <h5 class="card-text mb-5 mt-5">Pour accéder au site, merci de vous authentifier :</h5>
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <label>{{ __('Email') }} :</label>
                    <input id="email" type="email" class="form-control w-25 mx-auto" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label>{{ __('Password') }} :</label>
                    <input id="password" type="password" class="form-control w-25 mx-auto" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a><br>
                    @endif
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span><br>
                    <input type="submit" class="btn btn-success w-25 mb-5 mt-5" value="{{ __('Log in') }}">
                </form>
                <p class="card-title text-right mt-5">Site dévéloppé par CAVARROC Maxime, DEVINEAU Rodrigue, GILS Julie et SEROUSSI Théo.</p>
            </div>
        </div>

        <style>			
            body {
                background-image: url("{{url('image/cesi.jpg')}}") ;
            }

            #logo {
                width: 350px;
                height: 100px;
            }
        </style>

        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
            
	</body>
</html>