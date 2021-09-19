
@extends('layouts.app')

@section('contenu')

<div class="row">
    <div class="col-3"></div>
    
    <div class="col-6">
        <h1 class="MCenter">Formulaire des personnels de l'entreprise</h1>
        <form action="{{route('update_personnel',$personnel->id)}}" method="POST">
            @csrf 
            <div class="form-group">
                <b>Nom:</b>
                <input class="form-control" required type="text" value="{{$personnel->nom}}" name="nom">
            </div>

            <div class="form-group">
                <b>Prénom:</b>
                <input class="form-control" required type="text" value="{{$personnel->prenom}}" name="prenom">
            </div>

            <div class="form-group">
                <b>Date de naissance:</b>
                <input class="form-control" required type="date" value="{{$personnel->dateNaissance}}" name="dateNaissance">
            </div>

            <div class="form-group">
                <b>User:</b>
                <input class="form-control" required type="text" value="{{$personnel->user}}" name="user">
            </div>

            <div class="form-group">
                <b>Choisir un mot de passe:</b>
                <input class="form-control" required type="password" value="{{$personnel->pass}}" name="pass">
            </div>

            <div class="form-group">
                <b>Comfirmer:</b>
                <input class="form-control" required type="password" value="{{$personnel->pass}}" name="passConfirme">
            </div>

            <button type="submit" class="btn btn-success">Modifier</button> 
            
            <a href="{{route('personnels.index')}}"><button type="button" class="btn btn-primary">Retour</button></a>
        </form>
    </div>
    
    <div class="col-3"></div>
</div>

@endsection

