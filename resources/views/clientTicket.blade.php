<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/bootstrap/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('images/styleBienvenue.css') }}">

	<title>una_sotra</title>

<script type="text/javascript">

		// REDIRECTION IMPECABLE
	function redirection(){
		setTimeout(direction,4000);
		
		// location.href="http://localhost/una_sotra/public/clientBienvenue";
	}

	function direction(){
		location.href="clientBienvenue";
	}
</script>

</head>
<body onload="redirection()">
<div class="container-fluid">


<!-- xxxxxxxxxxxxxxxx  nav bar xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
<a href="{{route('clientBienvenue')}}">clientBienvenue</a>
<a href="clientAppele">clientAppele</a>
<a href="clientInfoFile">clientInfoFile</a>
<a href="interfaeGuichetPersonnel"> interfaeGuichetPersonnel</a>
<!-- xxxxxxxxxxxxxxxx  nav bar xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->

	<h1 class="MCenter">SOTRA_UNA  patientez</h1>

	<div class="row MCenter d-flex justify-content-center">
		<div class="col-12 service"><div class="col-12 ">Merci de patienter {{$genre}} {{$nom}}!</div></div>
	</div>
	<div class="separateur"></div>
	<div class="row d-flex justify-content-center">
		<div class="col-12 col-md-6 service MCenter">Nombre de clients avant vous: <b>{{$nbClientAvant}}</b> </div>
		<div class="col-12 col-md-6 service MCenter">Temps d’attente estimé: <b>{{$tAttenteEstime}} </b></div>
		<div class="col-12 col-md-6 service MCenter">Votre ticket: <b>{{$ticket}} </b></div>
	</div>
</div>



</body>
</html>

