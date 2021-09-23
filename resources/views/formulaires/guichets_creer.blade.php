
@extends('layouts.app')

@section('contenu')

<div class="row">
    <div class="col-3"></div>
    
    <div class="col-6">
        <h1 class="MCenter">Formulaire Guichet</h1>
        <form action="{{route('guichets.store')}}" method="POST">
            @csrf 
            <div class="form-group">
                <b>Lettre du guichet:</b>
                <input class="form-control" required type="text" maxlength="1"  name="lettre_guichet">
            </div>

            <div class="form-group">
                    <b>Service:</b>
                    <select class="form-control" required name="service_id">
                        <option value="" ></option>
                        <?php foreach ($serviceLibre as $service): ?>
                                <option value="{{$service->id}}">{{$service->nom}}</option>
                        <?php endforeach ?>
                    </select>
            </div>


            <div class="form-group">
                    <b>Personnel:</b>
                    <select class="form-control" required name="personnel_id" >
                        <option value="" ></option>
                        <?php foreach ($personnelLibre as $personnel): ?>
                            <option value="{{$personnel->id}}" >
                                {{$personnel->nom}} {{$personnel->prenom}}
                            </option>
                        <?php endforeach ?>
                    </select>
            </div>

            <button type="submit" class="btn btn-success">Valider</button> 
            
            <a href="{{route('guichets.index')}}"><button type="button" class="btn btn-primary">Retour</button></a>
        </form>
    </div>
    
    <div class="col-3"></div>
</div>

@endsection

<!-- numero', 'service_id', 'personnel_id -->