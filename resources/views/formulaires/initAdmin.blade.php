<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/bootstrap/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('images/styleBienvenue.css') }}">

	<title>una_sotra</title>
</head>
<body>

<!-- xxxxxxxxxxxxxxxx  nav bar xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
<a href="{{route('clientBienvenue')}}">clientBienvenue</a>
<a href="clientAppele">clientAppele</a>
<a href="clientInfoFile">clientInfoFile</a>
<a href="interfaeGuichetPersonnel"> interfaeGuichetPersonnel</a>
<!-- xxxxxxxxxxxxxxxx  nav bar xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
	
<?php /*print_r($_SESSION) ; session_destroy();*/ ?>
	<h1 class="MCenter connexionTitreInitBD">INITIALISATION DE LA BASE DE DONNEES</h1>


<div class="container-fluid">
<div class="row d-flex justify-content-center align-items-center">
    
    <div class="col-12 col-md-6">
        <h1 class="MCenter"><b>INFO ADMINISTRATEUR</b></h1>
        <form action="{{route('storAdmin')}}" method="POST">
            @csrf
            <div class="form-group">
                <b>Nom:</b>
                <input class="form-control" required type="text" name="nom">
            </div>

            <div class="form-group">
                <b>Prénom:</b>
                <input class="form-control" required type="text" name="prenom">
            </div>

            <div class="form-group">
                <b>Date de naissance:</b>
                <input class="form-control" required type="date" name="dateNaissance">
            </div>

            <div class="form-group">
                <b>User:</b>
                <input class="form-control" required type="text" name="user">
            </div>

            <div class="form-group">
                <b>Choisir un mot de passe:</b>
                <input class="form-control" required type="password" value="" name="pass">
            </div>

            <div class="form-group">
                <b>Comfirmer:</b>
                <input class="form-control" required type="password" value="" name="passConfirme">
            </div>

            <!-- <button type="submit" class="btn btn-success">Valider</button>  -->
            <div class="d-grid gap-2 col-6 mx-auto">
              <button type="submit" class="btn btn-success btnInitBD" type="button">Valider</button>
              <!-- <button class="btn btn-primary" type="button">Button</button> -->
            </div>
            <!-- <a href="{{route('personnels.index')}}"><button type="button" class="btn btn-primary">Retour</button></a> -->
        </form>
            
        </form>
    </div>
</div>

</div>


</body>
</html>

