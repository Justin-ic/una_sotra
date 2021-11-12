
@extends('layouts.app')

@section('contenu')
<?php 
/*use App\Http\Controllers\Formulaire;
public function input($label, $type, $valeur, $name)
include 'una_sotra/app/Http/Controllers/descriptionsController.php';
$formulaire = new Formulaire();
die($ss);
{{ sset('../una_sotra/app/Http/Controllers/Formulaire.php') }}*/
?>

<script type="text/javascript">
    $(document).ready(function(){
  $('#birth-date').mask('00/00/0000');
  // $('#numero').mask('0000000000'); Pour ne accepter que des nombres
 })
</script>

<div class="row">
    <div class="col-3"></div>
    
    <div class="col-6">
        <h1 class="MCenter">Formulaire Etudiant</h1>
        <form action="{{route('clients.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <b>Nom:</b>
                <input class="form-control" required type="text" name="nom"   value="{{old('nom')}}">
            </div>

            <div class="form-group">
                <b>Prénom:</b>
                <input class="form-control" required type="text" name="prenom" id="prenom"   value="{{old('prenom')}}">
            </div>

            <div class="divRadio">
            
            <label class="form-check-label labelRadio1" for="flexRadioDefault1">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="genre"  value="H" id="flexRadioDefault1" checked>
                    Homme 
                </div>
            </label>
            <label class="form-check-label labelRadio2" for="flexRadioDefault2">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="genre" value="F" id="flexRadioDefault2">
                    Femme
                </div>
            </label>
            </div>
            

            <div class="form-group">
                <b>N° Carte Etutiante:</b>
                <input class="form-control" required type="text" name="nce" id="nce"   value="{{old('nce')}}">
            </div>

            <div class="form-group">
                <b>Date Naissance:</b>
                <input class="form-control" required type="date" name="dateNaissance"   value="{{old('dateNaissance')}}">
            </div>

            <div class="form-group">
                <b>Numéro Téléphone:</b>
                <input class="form-control" required type="text" name="numero" id="numero"   value="{{old('numero')}}">
            </div>

            <!-- <div class="form-group">
                    <b>Service:</b>
                    <select class="form-control" required name="service_id">
                        <option value="" ></option>
                        <?php foreach ($listeService as $service): ?>
                            <option value="{{$service->id}}" >{{$service->nom}}</option>
                        <?php endforeach ?>
                    </select>
            </div> -->

            <button type="submit" class="btn btn-success">Valider</button> 
            
            <a href="{{route('clients.index')}}"><button type="button" class="btn btn-primary">Retour</button></a>
        </form>
    </div>
    
    <div class="col-3"></div>
</div>

@endsection

<!-- nom     numero  commentaire     service_id  created_at  updated_at   -->