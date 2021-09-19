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
	

	<h1 class="MCenter">Bienvenue à SOTRA_UNA!</h1>


<div class="container-fluid">
	<div class="row MCenter separateur">
		<div class="col-12 separateur"></div>
	</div>


	<div class="row d-flex justify-content-center  ">
		<div class="col-12 col-md-5 " >
                    <a href="" class="d-flex justify-content-center align-items-center btn btn-primary grosBouton" >
				Admin
			</a>
		</div>


		<div class="col-12 col-md-5 ">
			<a href="" class="d-flex justify-content-center align-items-center btn btn-success grosBouton">Personnel</a> 
		</div>

<!-- 		<div class="col-12 col-md-5 ">
			<button class="btn btn-primary" type="button" >
				
			</button>
			<div class=" d-flex justify-content-center align-items-center groBouton " > 
				Admin
			</div>
		</div>



		<div class="col-12 col-md-5 ">
			<div class=" d-flex justify-content-center align-items-center groBouton "> 
				Personnel
			</div>
		</div> -->

	</div>
</div>


</body>
</html>

