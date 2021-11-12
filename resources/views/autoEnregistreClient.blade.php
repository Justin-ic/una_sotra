

@extends('layouts.app2')

@section('contenu')  
                     
<style type="text/css">
    body{
    /*background-image: url('imgBienvenue.jpg');*/
    /*background-repeat: no-repeat;*/
    background-color: #dee9ff;
}
</style>

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
      
      if ($heures==0) {
          $heures ="00";
      } 
      if ($minutes < 10) {
           $minutes = "0".$minutes;
       }

      if ($secondes2 < 10) {
           $secondes2 = "0".$secondes2;
       } 
      
      
       $TimeFinal = "$heures".":"."$minutes".":"."$secondes2"; 
       return $TimeFinal; 
    }
?>


<!-- 

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/bootstrap/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('images/styleBienvenue.css') }}">

	<title>una_Scolatité</title>



</head>
<body >
 -->




<style type="text/css">
body{
	height: 1hv;
}
</style>

<script type="text/javascript">
    $(document).ready(function(){
  $('#birth-date').mask('00/00/0000');
  // $('#numero').mask('0000000000');
 })
</script>
<!-- xxxxxxxxxxxxxxxx  nav bar xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
<!-- <a href="clientBienvenue">clientBienvenue</a>
<a href="autoEnregistreClient"> autoEnregistreClient</a>
<a href="clientTicket"> clientTicket</a>
<a href="clientAppele"> clientAppele</a>
<a href="clientInfoFile"> clientInfoFile</a>
<a href="interfaceGuichetPersonnel"> interfaceGuichetPersonnel</a> -->
<!-- xxxxxxxxxxxxxxxx  nav bar xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->

<div class="container-fluid">
<form action="{{route('clientTicket')}}" method="POST" class="form">
	<h1 class="MCenter">UNA_SCOLARITE</h1>

	<div class="row MCenter d-flex justify-content-center">
		<div class="col-12 service"><div class="col-12 "><?php echo ($etudiant->genre == 'H') ? 'Mr. ' : 'Mme' ; ?> {{$etudiant->nom}} {{$etudiant->prenom}}</div></div>
	</div>


	<div class="row parent">
		
		<div class="col-12 col-md-6 enfant1 d-flex align-items-center contour">

			<div class="row">
				<div class=" col-11 MCenter"><h3 class="MCenter">Infos</h3></div>

				<div class=" col-11 service"> Service démander: <b>{{$LeService->nom}}</b></div>

				<div class="col-11 service">Clients avant vous: <b>{{$nbClientAvant}}</b></div>


					  <div class="col-11 service"> Temps estimé: 
						<?php 
								$tmoyen=30*60; // Le temps moyen est défini ici à 30 minutes. aussi dans clientsControleur
								// si 0, renvoie 1 pour la multiplication
								// $nbc = ($nbClientAvant==0) ? 1:$nbClientAvant; // 
								if ($nbClientAvant==0) {
									echo "<b>Il y a personne avant vous !</b>";
									?><input type="hidden" name="tAttenteEstime" value="0:0:0"><?php
								} else {
									$timm = ConvertisseurTime($nbClientAvant*$tmoyen);
									echo "<b>".$timm."</b>";
									?><input type="hidden" name="tAttenteEstime" value="{{$timm}}" id=""><?php
								}
								?>
						</div>
			</div>

		</div>


		<div class="col-12 col-md-6 enfant2 contour">
			<!-- vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv -->
					<h3 class="MCenter">Cocher</h3>
					@csrf 

					<!-- <div class="container-fluid d-flex justify-content-center"> -->
						<div class="row d-flex justify-content-center align-items-center">
					<?php foreach ($LeService->descriptions as $description): ?>
						<div class="col-12 d-flex justify-content-center ">
							<label class="form-check-label col-10 service " for="{{$description->detail}}">
								<div class="form-check MCenter">
									<input class="form-check-input checkbox" type="checkbox" name="choix[]" value="{{$description->detail}}" id="{{$description->detail}}">
									{{$description->detail}}
								</div>
							</label>
						</div>
					<?php endforeach ?> 
					 </div>
<!-- vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv -->
		</div>

		
	</div>

<input type="hidden" name="nomGuichet" value="{{$nomGuichet}}" id="">
<input type="hidden" name="nbClientAvant" value="{{$nbClientAvant}}" id="">
<input type="hidden" name="nbClientDuJour" value="{{$nbClientDuJour}}" id="">
<input type="hidden" name="idEtu" value="{{$etudiant->id}}" id="">
<input type="hidden" name="idServ" value="{{$LeService->id}}" id="">

<div class="d-grid gap-2">
  <button class="btn btn-primary service" type="submit">Tirez votre ticket</button>
</div>



<!-- <div class="d-grid gap-2 col-6 mx-auto">
  <button class="btn btn-primary" type="button">Button</button>
  <button class="btn btn-primary" type="button">Button</button>
</div> -->

</div>

</form>

@endsection


<!-- 
</body>
</html>
 -->
                            