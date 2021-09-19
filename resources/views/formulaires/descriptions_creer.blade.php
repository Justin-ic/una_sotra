
@extends('layouts.app')

@section('contenu')

<div class="row">
    <div class="col-3"></div>
    
    <div class="col-6">
        <h1 class="MCenter">Formulaire des Descriptions</h1>
        <form action="{{route('descriptions.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <b>Détail:</b>
                <input class="form-control" required type="text" name="detail">
            </div>

            <div class="form-group">
            	<b>Service:</b>
            	<select class="form-control" required name="service_id">
            		<option value="" ></option>
            		<?php foreach ($listeService as $service): ?>
            			<option value="{{$service->id}}">{{$service->nom}}</option>
            		<?php endforeach ?>
            	</select>
            </div>


            <button type="submit" class="btn btn-success">Valider</button> 
            
            <a href="{{route('descriptions.index')}}"><button type="button" class="btn btn-primary">Retour</button></a>
        </form>
    </div>
    <div class="col-3"></div>
</div>

@endsection

