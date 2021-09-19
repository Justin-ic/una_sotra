
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
                <b>Numero:</b>
                <input class="form-control" required type="number"  value="{{$client->numero}}" name="numero">
            </div>

            <div class="form-group">
                <b>Commentaire:</b>
                <input class="form-control" required type="text" value="{{$client->commentaire}}" name="commentaire">
            </div>


            <div class="form-group">
                    <b>Service:</b>
                    <select class="form-control" required name="service_id">
                        <option value="" ></option>
                        <?php foreach ($listeService as $service): ?>
                            <?php if ($client->service->id == $service->id): ?>
                                <option value="{{$service->id}}" selected >{{$service->nom}}</option>
                            <?php else: ?>
                                <option value="{{$service->id}}" >{{$service->nom}}</option>
                            <?php endif ?>
                        <?php endforeach ?>
                    </select>
            </div>

            <!-- <input  type="hidden"  value="{{$client->id}}" name="id"> -->

            <button type="submit" class="btn btn-success">Modifier</button> 
            
            <a href="{{route('home')}}"><button type="button" class="btn btn-primary">Retour</button></a>
        </form>
    </div>
    
    <div class="col-3"></div>
</div>

@endsection

<!-- nom     numero  commentaire     service_id  created_at  updated_at   -->