<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<title>{{ $title }}</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>
    <body class="p-3 mb-2 bg-info text-dark">
		<header class="header" id="top"></header>
		<div class="w-100">
			<div class="row">
			  	<div class="col-sm">
					<img id="logo" src="{{url('image/cesi.png')}}" alt="{{ __('CESI logo') }}"/>
			  	</div>
			  	<div class="col-sm">
					<h1 id="titrePage">{{ $title }}</h1>
				</div>
				<div class="col-sm mt-2 text-right">
					<div class="nav-item dropdown">
						<h5 id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
							{{ Auth::user()->name }} {{ Auth::user()->firstName }}
						</h5>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="{{ route('logout') }}" 
								onclick="event.preventDefault();
								document.getElementById('logout-form').submit();">
								{{ __('Logout') }}
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
								@csrf
							</form>
						</div>
					</div>
			  	</div>
			</div>
		</div>
			<nav class="navbar navbar-dark bg-dark navbar-expand-lg navbar-light bg-dark borderB" >
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">

						<!----------Offre---------->

							<!--Si droit de rechercher  (on estime qu'il a aussi droit de consulter les stats)-->
								@if(Auth::user()->right->SFx8)								
									<li class="nav-item">
										<a class="nav-link" href ="{{ route('offers.index') }}">{{ __('Offer') }}</a>
									</li>
								@endif

						<!----------Entreprise---------->

							<!--Si droit de rechercher (on estime qu'il a aussi droit de consulter les stats)-->
								@if(Auth::user()->right->SFx2)								
									<li class="nav-item">
										<a class="nav-link" href ="{{ route('companies.index') }}">{{ __('Company') }}</a>
									</li>
								@endif

						<!----------Délégué---------->

							<!--Si droit de rechercher (on estime que si il a le droit de creer de modifier ou de supprimer, c'est qu'il peut accéder à la liste)-->
								@if(Auth::user()->right->SFx17)
									<li class="nav-item">
										<a class="nav-link" href ="{{ route('delegates.index') }}">{{ __('Delegate') }}</a>
									</li>
								@endif

						<!----------Étudiant---------->

							<!--Si droit de rechercher (on estime que si il a le droit de creer de modifier ou de supprimer, c'est qu'il peut accéder à la liste)-->
								@if(Auth::user()->right->SFx22)
									<li class="nav-item">
										<a class="nav-link" href ="{{ route('students.index') }}">{{ __('Student') }}</a>
									</li>
								@endif

						<!----------Wish-List---------->

							@if(Auth::user()->right->SFx27)
								<li class="nav-item">
									<a class="nav-link" href ="{{ route('offers.wishlist') }}">{{ __('Wish-list') }}</a>
								</li>
							@endif

						<!----------Mes demandes---------->

							@if(Auth::user()->right->SFx29)
								<li class="nav-item">
									<a class="nav-link" href ="{{ route('offers.query') }}">{{ __('My queries') }}</a>
								</li>
							@endif

						<!----------Pilotes---------->

							<!--Si droit de rechercher (on estime que si il a le droit de creer de modifier ou de supprimer, c'est qu'il peut accéder à la liste)-->
								@if(Auth::user()->right->SFx13)
									<li class="nav-item">
										<a class="nav-link" href ="{{ route('tutors.index') }}">{{ __('Tutor') }}</a>
									</li>
								@endif
					</ul>
				</div>
			</nav>
		</header>
		
        @yield('content')

		<style>
			#logo 
			{
				width: 350px;
				height: 100px;
			}

			#titrePage
			{
				text-align: center;
				margin-top:20px;				
			}	
		</style>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</body>
</html>