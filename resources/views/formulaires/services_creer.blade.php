
@extends('layouts.app')

@section('contenu')

<div class="row">
    <div class="col-3"></div>
    
    <div class="col-6">
        <h1 class="MCenter">Formulaire service</h1>
        <form action="{{route('services.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <b>Nom:</b>
                <input class="form-control" required type="text" name="nom" value="{{old('nom')}}">
            </div>

            <button type="submit" class="btn btn-success">Valider</button> 
            
            <a href="{{route('services.index')}}"><button type="button" class="btn btn-primary">Retour</button></a>
        </form>
    </div>
    <div class="col-3"></div>
</div>

@endsection


