
                               

                            <?php
/*---------------------------------------------------------------*/
/*
    Titre : Convertie de secondes en heures, minutes et secondes                                                          
                                                                                                                          
    URL   : https://phpsources.net/code_s.php?id=939
    Date édition     : 15 Fév 2019                                                                                        
    Date mise à jour : 19 Aout 2019                                                                                      
    Rapport de la maj:                                                                                                    
    - fonctionnement du code vérifié                                                                                    
*/
/*---------------------------------------------------------------*/

     function ConvertisseurTime($Time){
     if($Time < 3600){ 
       $heures = 0; 
       
       if($Time < 60){$minutes = 0;} 
       else{$minutes = round($Time / 60);} 
       
       $secondes = floor($Time % 60); 
       } 
       else{ 
       $heures = round($Time / 3600); 
       $secondes = round($Time % 3600); 
       $minutes = floor($secondes / 60); 
       } 
       
       $secondes2 = round($secondes % 60); 
      
       $TimeFinal = "$heures".":"."$minutes".":"."$secondes2"; 
       return $TimeFinal; 
    }
?>




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
<a href="clientBienvenue">clientBienvenue</a>
<a href="autoEnregistreClient"> autoEnregistreClient</a>
<a href="clientTicket"> clientTicket</a>
<a href="clientAppele"> clientAppele</a>
<a href="clientInfoFile"> clientInfoFile</a>
<a href="interfaceGuichetPersonnel"> interfaceGuichetPersonnel</a>
<!-- xxxxxxxxxxxxxxxx  nav bar xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->

<div class="container-fluid">
<form action="{{route('clientTicket')}}" method="POST" class="form">
	<h1 class="MCenter">SOTRA_UNA</h1>

	<div class="row MCenter d-flex justify-content-center">
		<div class="col-12 service"><div class="col-12 ">{{$LeService->nom}}</div></div>
	</div>

	<div class="row parent">
		<div class="col-12 col-md-5 enfant1 ">

<!-- vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv -->
					<h3 class="MCenter">Cocher</h3>
					@csrf 

					<!-- <div class="container-fluid d-flex justify-content-center"> -->

					<?php foreach ($LeService->descriptions as $description): ?>
						<div class="row d-flex justify-content-center">
							<label class="form-check-label col-10 service " for="{{$description->detail}}">
								<div class="form-check MCenter">
									<input class="form-check-input" type="checkbox" name="choix[]" value="{{$description->detail}}" id="{{$description->detail}}">
									{{$description->detail}}
								</div>
							</label>
						</div>
					<?php endforeach ?>  
<!-- vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv -->

		</div>
		<div class="col-12 col-md-7 enfant2">
			<div class="row d-flex justify-content-center">
				<div class="col-12 col-md-5">
					<div class="row MCenter enregistr_droit">
						<div class="col-12"><div class="col-12 ">Clients: {{$nbClientAvant}}</div></div>
					</div>
				</div>
				<div class="col-2"></div>
				<div class="col-12 col-md-5">
					<div class="row MCenter d-flex justify-content-center enregistr_droit">
						<div class="col-12"><div class="col-12 ">Temps estimé: 
							<?php 
								$tmoyen=30*60;
								// si 0, renvoie 1 pour la multiplication
								// $nbc = ($nbClientAvant==0) ? 1:$nbClientAvant; // 
								if ($nbClientAvant==0) {
									echo "<br>Il n'y a personne avant vous !";
									?><input type="hidden" name="tAttenteEstime" value="0:0:0"><?php
								} else {
									$timm = ConvertisseurTime($nbClientAvant*$tmoyen);
									echo $timm;
									?><input type="hidden" name="tAttenteEstime" value="{{$timm}}" id=""><?php
								}
						  ?>
						</div></div>
					</div>
				</div>
			</div>
			<div class="row d-flex justify-content-center">
				<div class="separateur"></div>
				<h3 class="MCenter" style="font-weight: bold;">Enregistrez-vous</h3>


				<div class="col-12 col-md-8">
					<div class="input-group flex-nowrap">
						<span class="input-group-text" ><b>Nom:</b></span>
						<input type="text" class="form-control" required placeholder="Votre nom" name="nom" value="{{old('nom')}}">
					</div>
					<div class="input-group flex-nowrap">
						<span class="input-group-text" ><b>Prénom:</b></span>
						<input type="text" class="form-control" required placeholder="Votre prénom" name="prenom" value="{{old('prenom')}}">
					</div>
					<label class="form-check-label labelRadio1" for="flexRadioDefault1">
						<div class="form-check">
							<input class="form-check-input " type="radio" name="genre"  value="H" id="flexRadioDefault1" checked>
							Homme 
						</div>
					</label>
					<label class="form-check-label labelRadio2" for="flexRadioDefault2">
						<div class="form-check">
							<input class="form-check-input" type="radio" name="genre" value="F" id="flexRadioDefault2">
							Femme
						</div>
					</label>

					<div class="input-group flex-nowrap">
						<span class="input-group-text" ><b>Numéro:</b></span>
						<input type="number" class="form-control" required placeholder="Votre numéro" name="numero" value="{{old('numero')}}" autocomplete="true">
					</div>
					<div class="input-group flex-nowrap">
						<span class="input-group-text" ><b>NCE:</b></span>
						<input type="text" class="form-control" required placeholder="Votre Numéro de carte etudiante" name="nce" value="{{old('nce')}}">
					</div>
				</div>
		</div>
		</div>
	</div>

<input type="hidden" name="nomGuichet" value="{{$nomGuichet}}" id="">
<input type="hidden" name="nbClientAvant" value="{{$nbClientAvant}}" id="">
<input type="hidden" name="nbClientDuJour" value="{{$nbClientDuJour}}" id="">

<div class="d-grid gap-2">
  <button class="btn btn-primary service" type="submit">Tirez votre ticket</button>
</div>



<!-- <div class="d-grid gap-2 col-6 mx-auto">
  <button class="btn btn-primary" type="button">Button</button>
  <button class="btn btn-primary" type="button">Button</button>
</div> -->

</div>

</form>

</body>
</html>

                            