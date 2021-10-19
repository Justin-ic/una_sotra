<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/bootstrap/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('images/styleBienvenue.css') }}">


<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script> -->

	<title>una_Scolatité</title>
</head>
<body>

<!-- xxxxxxxxxxxxxxxx  nav bar xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
<!-- <a href="{{route('clientBienvenue')}}">clientBienvenue</a>
<a href="clientAppele">clientAppele</a>
<a href="clientInfoFile">clientInfoFile</a>
<a href="interfaeGuichetPersonnel"> interfaeGuichetPersonnel</a> -->




<header  class="">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">UNA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a href="{{route('clientBienvenue')}}">Accueil étudiant </a>
          </li>
          <li class="nav-item">
              <a href="clientAppele">Ecran d'appel </a>
          </li>
          <li class="nav-item"> 
              <a href="clientInfoFile">Infos files </a>
          </li>
          <!-- <li class="nav-item">
              <a class="nav-link" href="{{route('guichets.index')}}">Guichets</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{route('descriptions.index')}}">Descriptions</a> 
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{route('bilan_clients.index')}}">Bilan clients</a> 
          </li>
          <li class="nav-item">
              <a class="nav-link" href="clientBienvenue">clientBienvenue</a> 
          </li>
          <li class="nav-item">
              <a class="nav-link" href="AdminVewClientLocation">AdminVewClientLocation</a> 
          </li> -->
      </ul>
      <span class="navbar-text">
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
  </span>
</div>
</div>
</nav>
</header>








<!-- xxxxxxxxxxxxxxxx  nav bar xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
	

	<h1 class="MCenter">Bienvenue à UNA_SCOLARITE!</h1>
	<div class="row MCenter">
		
	</div>

	<div class="row MCenter separateur">
		<div class="col-12 separateur"></div>
	</div>
<!-- 
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



<p>
  <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true" aria-controls="collapseExample">
    Link with href
  </a>
  <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
    Button with data-bs-target
  </button>
</p>
<div class="collapse show" id="collapseExample">
  <div class="card card-body">
    Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
  </div>
</div>

<div class="collapse" id="collapseExample2">
  <div class="card card-body">
   Justin  Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
  </div>
</div>

 -->
<div class="container">
 <div class="row d-flex justify-content-center">
 	<div class="col-12 col-md-6  contour zone_reconnect">
 		<div class="row">
 			<div class="col-12 CB_entete">
 				<div class="row  d-flex justify-content-center ">
 					<div class="col-12 ">
 						<ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
 							<li class="nav-item">
 								<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Choisir un service</a>
 							</li>
 							<li class="nav-item">
 								<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Vous avez déjà un ticket ?</a>
 							</li>
 						</ul>
 					</div>
 				</div>
 			</div>

 			<div class="col-12 ">
 				<div class="row  d-flex justify-content-center">
 					<div class="col-12   tab-content"  id="myTabContent">
 						<div class=" tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <!-- <div class="col-12 col-md-12"> -->
                                	<div class="row MCenter ">
                                		<h3 class="col-12 ">Services disponibles</h3>
                                		<div class="col-12 d-flex justify-content-center ">
                                			<div class="row MCenter"> 
                                				<?php foreach ($liste as $service): ?>
                                					<a href="autoEnregistreClient/{{$service->id}} ">
                                                        <div class="col-12  service">
                                						{{$service->nom}}
                                					    </div>
                                                    </a>
                                				<?php endforeach ?>
                                			</div>
                                		</div>
                                	</div>
                                <!-- </div> -->
                            </div>



                            <div class="  tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            	<!-- <div class="col-12 col-md-12 contour"> -->
                            		<div class="row d-flex justify-content-center">
                            			<div class="col-6">
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
                            	<!-- </div> -->
                            </div>

 					</div>





 				</div>
 			</div>
 		</div>

 	</div>

 </div>

</div>






	<!-- popper pour dropdown et doit être placer avant les bootstraps.js-->
	<!-- <script type="text/javascript" src="{{  asset('styles/js/popper.min.js')  }}"></script>  -->
	<!-- <script type="text/javascript" src="{{  asset('styles/js/bootstrap.min.js')  }}"></script> -->
	<script type="text/javascript" src="{{  asset('styles/js/jquery3.4.1.js')  }}"></script>
	<script type="text/javascript" src="{{  asset('styles/bootstrap/bootstrap.bundle.min.js')  }}"></script>

	<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script> -->

</body>
</html>

