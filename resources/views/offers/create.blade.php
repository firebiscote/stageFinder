@extends('appLayout', ['title' => "Création d'une offre"])

@section('css')
<link rel="stylesheet" type = "text/css" href ="{{url('css/createOffer.css')}}">
@endsection

@section('content')

	<div class="card  w-75 text-center  mx-auto mt-3">
        <div class="card-header text-center">
            <h5>Offre proposé par : [nom de l'entreprise] à [localité entreprise] le <?php echo date('d/m/Y'); ?></h5>
        </div>
        <div class="card-body">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputTitre">Titre de l'annonce</label>
                        <input type="text" class="form-control" id="inputTitre" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputSeat">Nombre de place disponible </label>
                        <input type="number" class="form-control" id="inputSeat" >
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputDuree">Durée du stage </label>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <div class="col-sm-2 text-right" ><p>Du</p></div>
                                    <div class="col-sm-8"><input type="date" class="form-control" id="inputDuree" ></div>
                                </div>                                                                
                            </div>
                            <div class="form-group col-md-6">
                            <div class="row">
                                    <div class="col-sm-2 text-right "><p>Au</p></div>
                                    <div class="col-sm-8"><input type="date" class="form-control" id="inputDuree" ></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputSkills">Compétences requises </label>
                        <input type="text" class="form-control" id="inputSkills" >
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPromotion">Promotion visée</label>
                        <select class="custom-select " id="selectAvancement">
                            <option selected>Choose...</option>
                            <option value="1">1ère année</option>
                            <option value="2">2ème année</option>
                            <option value="3">3ème année</option>
                            <option value="3">4ème année</option>
                            <option value="3">5ème année</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputRemuneration">Base de rémunération (/h) </label>
                        <input type="number" step="0.01" class="form-control" id="inputRemuneration" >
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="description">Description de l'annonce</label>
                        <textarea class="form-control" id="description" rows="3"></textarea>
                    </div>
                    <div class="form-group col-md-6 text-center">
                        <button type="button" class="btn btn-dark mt-5 w-25 h-50" id="valider">Valider</button>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>



    <script>
        document.getElementById("Aujourdhui").valueAsDate = new Date();
    </script>
@endsection