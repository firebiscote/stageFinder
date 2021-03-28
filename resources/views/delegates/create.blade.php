@extends('template.templateAdmin', ['title' => "Création d'un délégué"])

@section('content')

    <div class="card w-75 text-center  mx-auto mt-3">
        <div class="card-body row">
            <div class="col-6">
                <label>Nom :</label>
                <input type="text" class="form-control w-50 mx-auto">
                <label>Prénom :</label>
                <input type="text" class="form-control w-50 mx-auto">
                <label>Centre :</label>
                <input type="text" class="form-control w-50 mx-auto">
                <label>Promotion assignée :</label><br>
                <input type="text" class="form-control w-50 mx-auto">
                <label>Mail :</label>
                <input type="email" class="form-control w-50 mx-auto">
            </div>
            <div class="col-6">
                <label>Mot de passe :</label>
                <input type="password" class="form-control w-50 mx-auto">
                <label>Confirmation du mot de passe :</label>
                <input type="password" class="form-control w-50 mx-auto">  
                @if(Auth::user()->right->SFx21) 
                    <select class="custom-select mt-4 " multiple>
                        <optgroup label="Entreprise">
                            <option>Rechercher</option>
                            <option>Créer</option>
                            <option>Modifier</option>
                            <option>Supprimer</option>
                            <option>Évaluer</option>
                            <option>Consulter les statistiques</option>
                        </optgroup>
                        <optgroup label="Offre">
                            <option>Rechercher</option>
                            <option>Créer</option>
                            <option>Modifier</option>
                            <option>Supprimer</option>
                            <option>Consulter les statistiques</option>
                        </optgroup>
                        <optgroup label="Pilote">
                            <option>Rechercher</option>
                            <option>Créer</option>
                            <option>Modifier</option>
                            <option>Supprimer</option>
                        </optgroup>
                        <optgroup label="Délégué">
                            <option>Rechercher</option>
                            <option>Créer</option>
                            <option>Modifier</option>
                            <option>Supprimer</option>
                        </optgroup>
                        <optgroup label="Étudiant">
                            <option>Rechercher</option>
                            <option>Créer</option>
                            <option>Modifier</option>
                            <option>Supprimer</option>
                        </optgroup>
                        <optgroup label="Avancement">
                            <option>Informer le système de l'avancement de la candidature step 3</option>
                            <option>Informer le système de l'avancement de la candidature step 4</option>
                        </optgroup>
                    </select>
                @endif
                <button type="button" class="btn btn-success w-25 mt-4">Créer ce délégué</button>
            </div>
        </div>
    </div>

@endsection