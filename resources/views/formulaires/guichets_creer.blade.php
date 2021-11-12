
@extends('layouts.app')

@section('contenu')

<div class="row">
    <div class="col-3"></div>
    
    <div class="col-6">
        <h1 class="MCenter">Formulaire Guichet</h1>

        <?php if ($serviceLibre == null) { ?>
            <div class="bg-danger bg-opacity-50 MCenter">
                Désolé! Il n'y a pas de service libre.<br>
                Vous devez créer aumoins un ou en ajouter.
            </div>
        <?php } else if ($personnelLibre == null) { ?>
            <div class="bg-danger bg-opacity-50 MCenter">
                Désolé! Il n'y a plus de personnel libre. <br>
                Vous devez créer aumoins un ou en ajouter.
            </div>
        <?php } else { ?> <!-- S'il y au moins un service ou un personel  -->

             <form action="{{route('guichets.store')}}" method="POST">
                @csrf 
                <div class="form-group">
                    <b>Lettre du guichet:</b>
                    <input class="form-control" required type="text" maxlength="1"  name="lettre_guichet"  value="{{old('lettre_guichet')}}">
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
         <?php } ?>  <!-- Fin sinon  -->
        
    </div>
    
    <div class="col-3"></div>
</div>

@endsection

<!-- numero', 'service_id', 'personnel_id -->