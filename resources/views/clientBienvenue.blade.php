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
	

	<h1 class="MCenter">Bienvenue à UNA_SCOLARITE!</h1>
	<div class="row MCenter">
		
	</div>

	<div class="row MCenter separateur">
		<div class="col-12 separateur"></div>
	</div>

   <div class="row d-flex justify-content-center">
   		<div class="col-12 col-md-6">
   			<div class="row MCenter contour">
   				<h3 class="col-12 ">Choisir un service</h3>
   				<div class="col-12 d-flex justify-content-center ">
   						<div class="row MCenter"> 
   					<?php foreach ($liste as $service): ?>
   							<div class="col-12  service"><a href="autoEnregistreClient/{{$service->id}} ">
   							 {{$service->nom}}</a>
   							</div>
   					<?php endforeach ?>
   						</div>
   				</div>
   			</div>
   		</div>

   		<div class="col-12 col-md-6 contour">
   			<div class="row d-flex justify-content-center">
   				<div class="col-8">
   					<h3 class="col-12 MCenter">Vous avez déjà un ticket ?</h3>
   					<h3 class="MCenter">Votre ticket ici </h3>
   					<form action="{{route('reConnectClient')}}" method="POST">
   						@csrf
   						<div class="form-group">
   							<b>Ticket:</b>
   							<input class="form-control" required type="text" name="ticket">
   						</div>
   						<div class="form-group">
   							<b>Numéro de téléphone:</b>
   							<input class="form-control" required type="number" name="numero">
   						</div>
   						<div class="d-grid gap-2 col-6 mx-auto">
   							<button type="submit" class="btn btn-success">Valider</button> 
   						</div>
   						

   					</form>
   				</div>
   			</div>
   		</div>
   </div>





</body>
</html>

