
@extends('layouts.app')

@section('contenu')

<div class="row">
    <div class="col-3"></div>
    
    <div class="col-6"> 
        <h1 class="MCenter">Definissez l'IP DU ESP8266</h1>
        <form action="{{route('StoreIPESP8266')}}" method="POST">
            @csrf
            <div class="form-group">
                <b>Valeur IP:</b>
                <input class="form-control" required type="text" name="ip">
            </div>

            <button type="submit" class="btn btn-success">Valider</button> 
            
            <a href="{{route('bienVenusAdmin')}}"><button type="button" class="btn btn-primary">Retour</button></a>
        </form>
    </div>
    <div class="col-3"></div>
</div>

@endsection


