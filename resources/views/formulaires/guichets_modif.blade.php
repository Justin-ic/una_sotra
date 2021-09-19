
@extends('layouts.app')

@section('contenu')

<div class="row">
    <div class="col-3"></div>
    <div class="col-6">
        <h1 class="MCenter">Formulaire des Guichets</h1>
        <form action="{{route('update_guichet',$guichet->id)}}" method="POST">
            @csrf 
            <div class="form-group">
                <b>Lettre du guichet:</b>
                <input class="form-control" required type="text" maxlength="1"  value="{{$guichet->lettre_guichet}}" name="lettre_guichet">
            </div>

            <div class="form-group">
                    <b>Service:</b>
                    <select class="form-control" required name="service_id">
                        <option value="" ></option>
                        <?php foreach ($listeService as $service): ?>
                            <?php if ($guichet->service->id == $service->id): ?>
                                <option value="{{$service->id}}" selected >{{$service->nom}}</option>
                            <?php else: ?>
                                <option value="{{$service->id}}" >{{$service->nom}}</option>
                            <?php endif ?>
                        <?php endforeach ?>
                    </select>
            </div>


            <div class="form-group">
                    <b>Personnel:</b>
                    <select class="form-control" required name="personnel_id">
                        <option value="" ></option>
                        <?php foreach ($listePersonnel as $personnel): ?>
                            <?php if ($guichet->personnel->id == $personnel->id): ?>
                                <option value="{{$personnel->id}}" selected >{{$personnel->nom}} {{$personnel->prenom}}</option>
                            <?php else: ?>
                                <option value="{{$personnel->id}}" >{{$personnel->nom}} {{$personnel->prenom}}</option>
                            <?php endif ?>
                        <?php endforeach ?>
                    </select>
            </div>

            <button type="submit" class="btn btn-success">Modifier</button> 
            
            <a href="{{route('guichets.index')}}"><button type="button" class="btn btn-primary">Retour</button></a>
        </form>
    </div>
    
    <div class="col-3"></div>
</div>

@endsection

