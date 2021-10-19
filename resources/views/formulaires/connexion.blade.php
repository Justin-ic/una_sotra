<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/bootstrap/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('images/styleBienvenue.css') }}">

	<title>una_scolarite</title>
</head>
<body>

<!-- xxxxxxxxxxxxxxxx  nav bar xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
<!-- <a href="{{route('clientBienvenue')}}">clientBienvenue</a>
<a href="clientAppele">clientAppele</a>
<a href="clientInfoFile">clientInfoFile</a>
<a href="interfaeGuichetPersonnel"> interfaeGuichetPersonnel</a> -->
<!-- xxxxxxxxxxxxxxxx  nav bar xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
	
<?php /*print_r($_SESSION) ; session_destroy();*/ ?>
	<h1 class="MCenter connexionTitre">Bienvenue à UNA_SCOLARITE!</h1>


<div class="container-fluid">
<div class="row d-flex justify-content-center align-items-center">
    
    <div class="col-12 col-md-6">
        <h1 class="MCenter">Connexion du Personnel</h1>
        <?php if (isset($message)): ?>
            <div class="bg-danger bg-opacity-50 MCenter">
                {{$message}}
            </div>
        <?php endif ?>

        <form action="{{route('loginPersonnel')}}" method="POST" class="connexionForme">
            @csrf
            <div class="form-group">
                <b>Login:</b>
                <input class="form-control" required type="text" name="user">
            </div>
            <div class="form-group">
            	<b>Passe:</b>
            	<input class="form-control" type="password" required name="pass">
            </div>
            <div class="d-grid gap-2 col-8 mx-auto">
            	<button type="submit" class="btn btn-success connexionValide">Valider</button> 
            </div>
            
        </form>
    </div>
</div>

</div>


</body>
</html>




