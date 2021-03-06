
@extends('layouts.app')

@section('contenu')

<div class="row">
    <div class="col-3"></div>
    
    <div class="col-6">
        <h1 class="MCenter">Formulaire des personnels de la scolarité</h1>
        <form action="{{route('personnels.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <b>Nom:</b>
                <input class="form-control" required type="text" name="nom"  value="{{old('nom')}}">
            </div>

            <div class="form-group">
                <b>Prénom:</b>
                <input class="form-control" required type="text" name="prenom"  value="{{old('prenom')}}">
            </div>

            <div class="form-group">
                <b>Date de naissance:</b>
                <input class="form-control" required type="date" name="dateNaissance"  value="{{old('dateNaissance')}}">
            </div>

            <div class="form-group">
                <b>User:</b>
                <input class="form-control" required type="text" name="user"  value="{{old('user')}}">
            </div>

            <div class="form-group">
                <b>Choisir un mot de passe:</b>
                <input class="form-control" required type="password" value="" name="pass"  value="">
            </div>

            <div class="form-group">
                <b>Comfirmer:</b>
                <input class="form-control" required type="password" value="" name="passConfirme">
            </div>

            <button type="submit" class="btn btn-success">Valider</button> 
            
            <a href="{{route('personnels.index')}}"><button type="button" class="btn btn-primary">Retour</button></a>
        </form>
    </div>
    
    <div class="col-3"></div>
</div>

@endsection

    <!-- 'nom', 'pernom', 'dateNaissance', 'user', 'pass' -->

