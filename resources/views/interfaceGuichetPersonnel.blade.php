<?php /*session_start();  */ ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<!-- <meta http-equiv="refresh" content="30" name="viewport" content="width=device-width, initial-scale=1.0">  http-equiv="refresh" content="30": permet de rafraichire toutes les 30s-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/fontawesome/css/all.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/bootstrap/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('images/styleBienvenue.css') }}">
	<title>una_sotra</title>

<style type="text/css">
	 body{
	 	background: lightgray;
	 }
</style>

<!-- xxxxxxxxxxxxxxxxxxxx le timine xxxxxxxxxxxxxxxxxxxxxxxxxx -->
<script type="text/javascript">
	var compteur=0;
	var widthCouleur = 0;
	var compterCouleur = 0;
	function horloge()
	{
		var Heure = new Date().toLocaleTimeString();// hh:mm:ss
		compteur++;
		ecouler=toTimeString(compteur);
		document.getElementById("timer").innerHTML = ecouler;
		document.getElementById("Heure").innerHTML = Heure;
		// document.getElementById("progress-bar").innerHTML = ecouler;
		/***************** condition pour la partie verte, orange et rouge *****************/

		//  Normalement on fait 30 minute par client
// à 15min, on passe à orange: si compteur< 900s, progresVert: width=  (compteur*50)/900
// en effet, à 15min, on doit parcourir 50% de toute la bar de progression
// à 25min, on passe à Rouge

// 30min         100
// 25            ?   ->x=83.3 ->83; le width Maxi de orange doit être 83.3 - 50 = 33.3 ->33

// Le width Maxi de rouge est 100 -(50+33)=17

// 900         100
// compteur     ?

/*************************   gestion de la bar de progression *********************** */
				// if (compteur<=900) {
				// 	compterCouleur++;
				// 	widthCouleur =  (compterCouleur*50)/900;
				// 	document.getElementById('progressVert').style.width = widthCouleur + '%';
				// 	if (compteur==900) {compterCouleur=0; widthCouleur=0;} /*remise à zéro*/
				// }else if (compteur>900 && compteur<=1500) { /* Entre 15 et 25min */
				// 	compterCouleur++;
				// 	widthCouleur =  (compterCouleur*25)/600;  /*On fait 10min= 600s */
				// 	document.getElementById('progressOrange').style.width = widthCouleur + '%';
				// 	if (compteur==1500) {compterCouleur=0; widthCouleur=0;} /*remise à zéro*/
				// }else if (compteur>1500 && compteur<=1800){  /* Entre 25 et 30min */
				// 	compterCouleur++;
				// 	widthCouleur =  (compterCouleur*25)/300; /*On fait 5min= 300s */
				// 	document.getElementById('progressRouge').style.width = widthCouleur + '%';
				// 	if (compteur==1800) {compterCouleur=0; widthCouleur=0;} /*remise à zéro*/	
				// }
/*************************   gestion de la bar de progression *********************** */


/*************************   Un test de la bar de progression *********************** */

// On supose que le tems maxi est 3min
//  à 1 minute, on passe à orange
// à 2min on passe à rouge

				if (compteur<=60) {
					compterCouleur++;
					widthCouleur =  (compterCouleur*50)/60;
					document.getElementById('progressVert').style.width = widthCouleur + '%';
					if (compteur==60) {compterCouleur=0; widthCouleur=0;} /*remise à zéro*/
				}else if (compteur>60 && compteur<=120) {
					compterCouleur++;
					widthCouleur =  (compterCouleur*25)/60;
					document.getElementById('progressOrange').style.width = widthCouleur + '%';
					if (compteur==120) {compterCouleur=0; widthCouleur=0;} /*remise à zéro*/
				}else if (compteur>120 && compteur<=180){
					compterCouleur++;
					widthCouleur =  (compterCouleur*25)/60;
					document.getElementById('progressRouge').style.width = widthCouleur + '%';
					if (compteur==180) {compterCouleur=0; widthCouleur=0;} /*remise à zéro*/	
				}
/*************************   Un test de la bar de progression *********************** */

        setTimeout(horloge, 1000); // mise à jour du contenu "timer" toutes les secondes
  }
    function toTimeString(seconds) {
   		 return (new Date(seconds * 1000)).toUTCString().match(/(\d\d:\d\d:\d\d)/)[0];
			}



		function AllumerLED(){

			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
		       // Typical action to be performed when the document is ready:
		       document.getElementById("demo").innerHTML = xhttp.responseText;
		       // alert("Je suis ici");
		     }
		   };
	   xhttp.open("GET", "http://192.168.137.108/switchLedOff", true);
	   xhttp.send();
			}

			function EteindreLED(){

				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
		       // Typical action to be performed when the document is ready:
		       document.getElementById("demo").innerHTML = xhttp.responseText;
		       // alert("Je suis ici");
		     }
		   };
		   xhttp.open("GET", "http://192.168.137.125/switchLedOn", true);
		   xhttp.send();
		 }



		 function debutService(){
		 	var Heure = new Date().toLocaleTimeString();// hh:mm:ss
		 	document.getElementById("debutService").value = Heure;
		 }


		 function finService(){
		 	var Heure = new Date().toLocaleTimeString();// hh:mm:ss
		 	document.getElementById("finService").value = Heure;
		 }

</script> 
 
<!-- xxxxxxxxxxxxxxxxxxxx le timine xxxxxxxxxxxxxxxxxxxxxxxxxx -->


</head>
<body  onload="horloge(), debutService()">


<!-- 
<div class="service contour" id="format">xx  <script type="text/javascript">ttt=toTimeString(22); alert(ttt);
</script> </div> -->

<!-- xxxxxxxxxxxxxxxx  nav bar xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
<a href="clientBienvenue">clientBienvenue</a>
<a href="clientAppele"> clientAppele</a>
<a href="clientInfoFile"> clientInfoFile</a>
<a href="{{route('interfaceGuichetPersonnel',$_SESSION['personnel']->id)}}"> interfaeGuichetPersonnel</a>
<!-- xxxxxxxxxxxxxxxx  nav bar xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->

<div class="container-fluid">
<h1>la réponse du ESP (Serveur distant): <span id="demo">cc</span></h1>
<button class="btn btn-success" onclick="AllumerLED()">Allumer</button>
<button class="btn btn-danger" onclick="EteindreLED()">Eteindre</button>

<?php $id = ($nbClientAttent>0) ? "{$clientEnCours->id}" :  "0" ?>
<form action="{{route('clientSuivant', $id )}}" method="POST">
	<!--  Je fait un update de client -->
     @csrf <!-- si non, on obtient une erreur de type: 419 Page Expired -->

<!-- d-flex justify-content-center -->
	<div class="row serveurHaut d-flex align-items-center "> <!-- Alignement vertical -->
		<div class="col-12 col-md-8 ">UNA Sotra</div>
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

		<div class="row contour infoClient"><!-- Début milieux Gauche Bas-->
			<h1 class="MCenter">Le client en cours de service</h1>
			<div class="col-12">
				<b>Nom:</b> <?php echo($nbClientAttent>0) ? "{$genre1} {$clientEnCours->nom} {$clientEnCours->prenom}" :  "";  ?> 
			</div>
			<div class="col-12">
				<b>Numéro:</b> <?php echo($nbClientAttent>0) ? "{$clientEnCours->numero}" :  "";  ?>  
			</div>
			<div class="col-12">
				<b>NCE:</b> <?php echo($nbClientAttent>0) ? "{$clientEnCours->nce}" :  "";  ?>  
			</div>
			<div class="col-12">
				<b>Démande du client:</b> <?php echo($nbClientAttent>0) ?  "{$clientEnCours->tickets->first()->description}" :  "";  ?> 
			</div>
			<div class="col-12">
				Ajouter un commentaire: <br>
				<textarea  name="commentaireserveur" id="" style="font-size:20px;"></textarea>
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
			<div class="col-12 service MCenter">Client suivant: <br><?php echo($nbClientAttent>1) ? "{$genre2} {$leClientSuivant->nom} : Dans la file" : "Personne";  ?> </div>
		</div>
	</div><!-- Fin milieux Droite -->
</div>

<!-- ***************************** Block milieux ************************* -->

<div class="d-grid gap-2 col-12 mx-auto">
  <button onsubmit="finService()" id="suivant"  <?php echo($nbClientAttent>0) ? "" : "disabled";  ?> class="btn btn-primary service" type="submit">Suivant <img src="{{ asset('images/suivant.png') }}" alt="" class="imgSuivant"></button>
</div>

<!-- <div id="debutService"></div>
<div id="finService"></div> -->
<input type="text" name="debutService" id="debutService">
<!-- <input type="text" name="finService" id="finService">  On va recuperer le temps dans le controller-->
<!--  C'est le numéro du client que nous allons appeler.  -->
<input type="text" name="numeroClintSuivant" value="<?php echo($nbClientAttent>1) ? "$leClientSuivant->numero" : "0";  ?>" id="">
<input type="text" name="nomGuichet" value="<?=$_SESSION['guichet']->lettre_guichet ?>" id="">

<?php $ticket = ($nbClientAttent>1) ? $leClientSuivant->tickets->first()->ticket : "0" ?>
<input type="text" name="ticket" value="<?php echo $ticket  ?>" id="">

 </form>
</div><!--  -->

	<script type="text/javascript" src="{{  asset('styles/js/jquery3.4.1.js')  }}"></script>
<?php /*session_destroy();*/ ?>
</body>
</html>
