@extends('appLayout', ['title' => "Modification d'une offre"])

@section('content')

	<div class="card  w-75 text-center  mx-auto mt-3">
        <div class="card-header text-center">
            <h5>Offre proposé par : [nom de l'entreprise] à [localité entreprise] le [date de création]</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Titre de l'annonce</label>
                        <input type="text" class="form-control" value="[Titre de l'annonce]" >
                    </div>
                    <div class="form-group col-md-6">
                        <label>Nombre de place disponible </label>
                        <input type="number" class="form-control" value="1" >
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Durée du stage </label>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <div class="col-sm-2 text-right" ><p>Du</p></div>
                                    <div class="col-sm-8"><input type="date" class="form-control" value="2001-01-02" ></div>
                                </div>                                                                
                            </div>
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <div class="col-sm-2 text-right "><p>Au</p></div>
                                    <div class="col-sm-8"><input type="date" class="form-control" value="2021-01-02"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Compétences requises </label>
                        <input type="text" class="form-control" value="[Compétences requises]" >
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Promotion visée</label>
                        <select class="custom-select " id="selectAvancement">
                            <option selected>Choose...</option>
                            <!--foreach pour afficher les promos-->
                            <option value="1">1ère année</option>
                            <option value="2">2ème année</option>
                            <option value="3">3ème année</option>
                            <option value="3">4ème année</option>
                            <option value="3">5ème année</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Base de rémunération (/h) </label>
                        <input type="number" step="0.01" class="form-control" value="1" >
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Description de l'annonce</label>
                        <textarea class="form-control" rows="3">[Description de l'offre]</textarea>
                    </div>
                    <div class="form-group col-md-6 text-center">
                        <button type="button" class="btn btn-warning mt-5 w-25 h-50">Modifier</button>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>

@endsection