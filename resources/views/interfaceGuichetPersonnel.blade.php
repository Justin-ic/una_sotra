<?php /*session_start();  */ ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<!-- <meta http-equiv="refresh" content="30" name="viewport" content="width=device-width, initial-scale=1.0">  http-equiv="refresh" content="30": permet de rafraichire toutes les 30s-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/fontawesome/css/all.css') }}">  
	<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/bootstrap/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('images/styleBienvenue.css') }}">
	<title>una_Scolatité</title>

<style type="text/css">
	 body{
	 	background: lightgray;
	 }
</style>

<!-- xxxxxxxxxxxxxxxxxxxx le timine xxxxxxxxxxxxxxxxxxxxxxxxxx -->
<script type="text/javascript">
	
</script> 

 <!-- ********************** Client interfaceGuichetPersonnel **************************************** -->
  <script type="text/javascript" src="{{  asset('styles/js/interfaceGuichetPersonnel.js')  }}"></script> 
<!-- ********************** Client interfaceGuichetPersonnel **************************************** -->
<!-- xxxxxxxxxxxxxxxxxxxx le timine xxxxxxxxxxxxxxxxxxxxxxxxxx -->


</head>
<body  onload="horloge(), debutService(), APIClientEnLigne()">


<!-- 
<div class="service contour" id="format">xx  <script type="text/javascript">ttt=toTimeString(22); alert(ttt);
</script> </div> -->

<!-- xxxxxxxxxxxxxxxx  nav bar xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
<!-- <a href="clientBienvenue">clientBienvenue</a>
<a href="clientAppele"> clientAppele</a>
<a href="clientInfoFile"> clientInfoFile</a>
<a href="{{route('interfaceGuichetPersonnel',$_SESSION['personnel']->id)}}"> interfaeGuichetPersonnel</a> -->
<!-- xxxxxxxxxxxxxxxx  nav bar xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->

<div class="container-fluid">
<h1>la réponse du ESP (Serveur distant): <span id="demo">cc</span></h1>
<button class="btn btn-success" onclick="AllumerLED()">Allumer</button>
<button class="btn btn-danger" onclick="EteindreLED()">Eteindre</button>


<br><br><br><br>
<?php /*dd($clientEnCours);*/ ?>
<?php $id = ($nbClientAttent>0) ? "{$clientEnCours->etudiant->id}" :  "0" ?>
<form action="{{route('clientSuivant', $id )}}" method="POST">
	<!--  Je fait un update de client -->
     @csrf <!-- si non, on obtient une erreur de type: 419 Page Expired -->

<!-- d-flex justify-content-center -->
	<div class="row serveurHaut d-flex align-items-center "> <!-- Alignement vertical -->
		<div class="col-12 col-md-8 ">UNA Scolarité</div>
		<div class="col-12 col-md-4">
			<div class="row">
				<div class="col-5 contour">Guichet <?=$_SESSION['guichet']->lettre_guichet ?></div>
			 	<div class="col-7">
					<div class="row parentPhotoUser d-flex align-items-center">
						<div class="col-3 photoUser">
							<img src="{{ asset('images/personnels/imgBienvenue.jpg') }}" alt="xx" class="iconUser">
						</div>
						<div class="col-7 ">
							<?=$_SESSION['personnel']->nom ?>
							<!-- <div> 
							
					  	</div> -->
				  	</div>
				  	<div class="col-2"><a href="{{route('deconnexion')}}"><span class="fas fa-power-off btnDeconnexion"></a></span></div>
					</div> 
				</div>
			</div>
		</div>
	</div>


<!-- ***************************** Block milieux ************************* -->

<div class="row">
	<div class="col-12 col-md-8 contour"><!-- Début milieux Gauche -->
		<div class="row BlockProgress"><!-- Début milieux Gauche Haut-->
			<div class="col-12 contour"><h1 class="MCenter">Le temps du client: <span id="timer"></span></h1></div>
			<div class="col-12 contour " style="padding: 0px; margin: 0px; margin-bottom: 10px;">
				<div class="progress">
					<div class="progress-bar bg-success"  role="progressbar" id="progressVert" style="width: 0%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
					<div class="progress-bar  bg-warning" role="progressbar" id="progressOrange" style="width: 0%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">25%</div>
					<div class="progress-bar bg-danger" role="progressbar" id="progressRouge" style="width: 0%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">25%</div>
				</div>
			</div>
		</div><!-- Fin milieux Gauche Haut-->

		<div class="row contour infoClient leFontSize"><!-- Début milieux Gauche Bas-->
			<h1 class="MCenter">Le client en cours de service</h1>
			<div class="col-12 leFontSize">
				<b>Nom:</b> <?php echo($nbClientAttent>0) ? "{$genre1} {$clientEnCours->etudiant->nom} {$clientEnCours->etudiant->prenom}" :  "";  ?> 
			</div>
			<div class="col-12 leFontSize">
				<b>Numéro:</b> <?php echo($nbClientAttent>0) ? "{$clientEnCours->etudiant->numero}" :  "";  ?>  
			</div>
			<div class="col-12 leFontSize">
				<b>NCE:</b> <?php echo($nbClientAttent>0) ? "{$clientEnCours->etudiant->nce}" :  "";  ?>  
			</div>
			<div class="col-12 leFontSize">
				<b>Démande du client:</b><br> <?php echo($nbClientAttent>0) ?  "{$clientEnCours->demande}" :  "";  ?> 
			</div>
			<div class="col-12 leFontSize">
				<b>Ajouter un commentaire:</b> <br>
				<textarea  name="commentaireserveur" id="" style="font-size:20px;">RAS</textarea>
			</div>
		</div><!-- Fin milieux Gauche Bas-->
	</div><!-- Fin milieux Gauche -->
<!-- clientEnCours
leClientSuivant
nbClientAttent
nbClientServit -->
	<div class="col-12 col-md-4 contour"><!-- Début milieux Droite -->
		<div class="row d-flex align-items-center justify-content-center milieux_Droite_Vertical">
			<div class="col-12 service MCenter" id="Heure">08:23</div>
			<?php $nbClient = $nbClientAttent-1; ?>
			<div class="col-12 service MCenter">Clients en attente: <?php echo($nbClientAttent>0) ? "{$nbClient}" : "0";  ?> </div>
			<div class="col-12 service MCenter">Clients servit: {{$nbClientServit}}</div>
			<div class="col-12 service MCenter">Client suivant: 
				<br><?php 
				if ($nbClientAttent>1) {
				  echo "{$genre2} {$leClientSuivant->etudiant->nom} : <br>"; ?><span id="ReponseStatus"></span>  <?php 
				}else{
					echo "Personne";
				}
			   ?> 
		</div>
		</div>
	</div><!-- Fin milieux Droite --> 
</div>

<!-- ***************************** Block milieux ************************* -->

<div class="d-grid gap-2 col-12 mx-auto">
  <button onsubmit="finService()" id="suivant"  <?php echo($nbClientAttent>0) ? "" : "disabled";  ?> class="btn btn-primary service" type="submit">Suivant <img src="{{ asset('images/suivant.png') }}" alt="" class="imgSuivant"></button>
</div>

<br><br><br><br>

<!-- <div id="debutService"></div>
<div id="finService"></div> -->
<input type="text" name="debutService" id="debutService">
<!-- <input type="text" name="finService" id="finService">  On va recuperer le temps dans le controller-->
<!--  C'est le numéro du client que nous allons appeler.  -->

<?php $LeNumero = ($nbClientAttent>1) ? $leClientSuivant->etudiant->numero : "0" ?>
<input type="text" name="numeroClintSuivant" value="<?php echo $LeNumero;  ?>" id="">

<input type="text" name="nomGuichet" value="<?=$_SESSION['guichet']->lettre_guichet ?>" id="">

<?php $ticket = ($nbClientAttent>1) ? $leClientSuivant->ticket : "0" ?>
<input type="text" name="ticket" value="<?php echo $ticket  ?>" id="">

<?php $idClient = ($nbClientAttent>1) ? $leClientSuivant->etudiant->id : "0" ?>
<input type="text" name="idClient" value="<?=$idClient?>" id="idClient">

 </form>
</div><!--  -->

	<script type="text/javascript" src="{{  asset('styles/js/jquery3.4.1.js')  }}"></script>

<script type="text/javascript">
	
		function APIClientEnLigne(){

			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
		       // Typical action to be performed when the document is ready:
		       document.getElementById("ReponseStatus").innerHTML = xhttp.responseText;
		       //alert(xhttp.responseText);
		       console.log(xhttp.responseText);
		     }
		   };



		   // URL en local
	    var idClient = document.getElementById("idClient").value; // Ne doit pas être dans le if

				// URL En production


		   url = 'http://localhost/una_sotra/public/APIEnLigne/'+idClient;
		   url = "http://glacial-everglades-43629.herokuapp.com/APIEnLigne/"+idClient;
		   console.log(url);

	   xhttp.open("GET", url, true);
	   xhttp.send();

	   setTimeout(APIClientEnLigne, 1000); // mise à jour du contenu "timer" toutes les secondes

			}

// window.onload()

		   
		   // alert(idClient);
		   

</script>


<?php /*session_destroy();*/ ?>
</body>
</html>
