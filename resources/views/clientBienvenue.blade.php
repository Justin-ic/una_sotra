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
		<div class="col-12 choix">Choisir un service</div>
	</div>

	<div class="row MCenter separateur">
		<div class="col-12 separateur"></div>
	</div>

<?php foreach ($liste as $service): ?>
	<div class="row MCenter d-flex justify-content-center">
		<div class="col-12 col-md-4 service"><a href="autoEnregistreClient/{{$service->id}} ">
			<div class="col-12 ">{{$service->nom}}</div></a>
		</div>
	</div>
<?php endforeach ?>


</body>
</html>

