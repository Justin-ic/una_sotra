
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
<div class="row">
    <div class="col-3"></div>
    
    <div class="col-6">
        <h1 class="MCenter">Formulaire client</h1>
        <form action="{{route('clients.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <b>Nom:</b>
                <input class="form-control" required type="text" name="nom">
            </div>

            <div class="form-group">
                <b>Numero:</b>
                <input class="form-control" required type="number" name="numero">
            </div>

            <div class="form-group">
                <b>Commentaire:</b>
                <input class="form-control" required type="text" name="commentaire">
            </div>

            <div class="form-group">
                    <b>Service:</b>
                    <select class="form-control" required name="service_id">
                        <option value="" ></option>
                        <?php foreach ($listeService as $service): ?>
                            <option value="{{$service->id}}" >{{$service->nom}}</option>
                        <?php endforeach ?>
                    </select>
            </div>

            <button type="submit" class="btn btn-success">Valider</button> 
            
            <a href="{{route('home')}}"><button type="button" class="btn btn-primary">Retour</button></a>
        </form>
    </div>
    
    <div class="col-3"></div>
</div>

@endsection

<!-- nom     numero  commentaire     service_id  created_at  updated_at   -->