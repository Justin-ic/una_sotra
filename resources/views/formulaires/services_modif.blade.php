
@extends('layouts.app')

@section('contenu')

<div class="row">
    <div class="col-3"></div>
    
    <div class="col-6">
        <h1 class="MCenter">Formulaire service</h1>
        <form action="{{route('update_service',$service->id)}}" method="POST">
            @csrf 
            <div class="form-group">
                <b>Nom:</b>
                <input class="form-control" required type="text"  value="{{$service->nom}}" name="nom">
            </div>

            <input  type="hidden"  value="{{$service->id}}" name="id">

            <button type="submit" class="btn btn-success">Modifier</button> 
            
            <a href="{{route('services.index')}}"><button type="button" class="btn btn-primary">Retour</button></a>
        </form>
    </div>
    
    <div class="col-3"></div>
</div>

@endsection

