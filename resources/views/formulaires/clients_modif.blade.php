
@extends('layouts.app')

@section('contenu')
<?php 
/*use App\Http\Controllers\Formulaire;
public function input($label, $type, $valeur, $name)
include 'una_sotra/app/Http/Controllers/descriptionsController.php';
$formulaire = new Formulaire();
die($ss);
{{ sset('../una_sotra/app/Http/Controllers/Formulaire.php') }}*/
// dd($listeService);
?>

<script type="text/javascript">
    $(document).ready(function(){
  $('#birth-date').mask('00/00/0000');
  $('#numero').mask('0000000000');
 })
</script>

<div class="row">
    <div class="col-3"></div>
    
    <div class="col-6">
        <h1 class="MCenter">Formulaire client</h1>
        <form action="{{route('update_client',$client->id)}}" method="POST">
            @csrf 
            <div class="form-group">
                <b>Nom:</b>
                <input class="form-control" required type="text"  value="{{$client->nom}}" name="nom">
            </div>

            <div class="form-group">
                <b>Prénom:</b>
                <input class="form-control" required type="text"  value="{{$client->prenom}}" name="prenom">
            </div>

            <div class="form-group">
                <b>Genre:</b>
                <input class="form-control" required type="text"  value="{{$client->genre}}" name="genre">
            </div>
            <div class="form-group">
                <b>Numéro:</b>
                <input class="form-control" required type="text"  value="{{$client->numero}}" name="numero">
            </div>

            <div class="form-group">
                <b>nce:</b>
                <input class="form-control" required type="text"  value="{{$client->nce}}" name="nce" id="numero">
            </div>

            <div class="form-group">
                <b>dateNaissance:</b>
                <input class="form-control" required type="text" value="{{$client->dateNaissance}}" name="dateNaissance">
            </div>

<!-- nom     prenom  genre   numero  nce     dateNaissance -->


            <!-- <input  type="hidden"  value="{{$client->id}}" name="id"> -->

            <button type="submit" class="btn btn-success">Modifier</button> 
            
            <a href="{{route('clients.index')}}"><button type="button" class="btn btn-primary">Retour</button></a>
        </form>
    </div>
    
    <div class="col-3"></div>
</div>

@endsection

<!-- nom     numero  commentaire     service_id  created_at  updated_at   -->


