<?php session_start(); ?>
<!-- <!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/bootstrap/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('images/styleBienvenue.css') }}">

	<title>una_scolarite</title>
</head>
<body> -->


@extends('layouts.app2')

@section('contenu')

<style type="text/css">
    body{
    /*background-image: url('imgBienvenue.jpg');*/
    /*background-repeat: no-repeat;*/
    background-color: #dee9ff;
}
</style>



<!-- xxxxxxxxxxxxxxxx  nav bar xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
<!-- <a href="{{route('clientBienvenue')}}">clientBienvenue</a>
<a href="clientAppele">clientAppele</a>
<a href="clientInfoFile">clientInfoFile</a>
<a href="interfaeGuichetPersonnel"> interfaeGuichetPersonnel</a> -->
<!-- xxxxxxxxxxxxxxxx  nav bar xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
	
<?php /*print_r($_SESSION) ; session_destroy();*/ ?>
	<h1 class="MCenter connexionTitre">Bienvenue à UNA_SCOLARITE !</h1>


<div class="container-fluid">
<div class="row d-flex justify-content-center align-items-center">
    
    <div class="col-12 col-md-6">
        <h1 class="MCenter">Espace Etudiant</h1>
        <?php if ($errors->any()): ?>
            <div class="bg-danger bg-opacity-50 MCenter">
                {{$errors->first()}}
            </div>
        <?php endif ?>

        <form action="{{route('loginClient')}}" method="POST" class="connexionForme">
            @csrf
            <div class="form-group">
                <b>Votre Numéro de carte éudiante:</b>
                <input class="form-control" required type="text" name="nce" placeholder="CI0216044596">
            </div>
            <!-- <div class="form-group">
            	<b>Passe:</b>
            	<input class="form-control" type="password" required name="pass">
            </div> -->
            <div class="d-grid gap-2 col-8 mx-auto">
            	<button type="submit" class="btn btn-success connexionValide">Valider</button> 
            </div>
            
        </form>
    </div>
</div>

</div>


@endsection


<!-- </body>
</html>

 -->


