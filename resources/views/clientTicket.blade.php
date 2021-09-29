<?php /* session_start();*/  ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/bootstrap/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('images/styleBienvenue.css') }}">

	<title>una_sotra</title>
<!-- 
	LA APIclients_locationsUpdate EST UTILISEE DANS LE CAS OU C'EST UN PERSONNEL QUI ENREGISTRE LE CLIENT

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





 -->

<script type="text/javascript">
	// route('routeName',['param1' => param1,'param2' => param2]);
// APIclients_locationsUpdate 
// Les parametres:    id latitude longitude
// 


// xxxxxxxxxxxxxxxxxxxxxxxxxxxxx Temps restant du client xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
function TempsRestant(){

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
	       // Typical action to be performed when the document is ready:
	       var myArr = JSON.parse(this.responseText); /* Je transforme la réponse en array()*/
	       var i=0;
	       	for (var i = 0; i < myArr.length; i++) {
	       		myArr[i]
	       	}
		   }
		};
		// url = "route('APIclients_locationsUpdate',[" + idClient + "," + coordsClient+"])}}";
		xhttp.open("GET",url , true);
		xhttp.send();
        setTimeout(APIclients_locationsUpdate, 1000); // mise à jour du contenu "timer" toutes les secondes
    }
// xxxxxxxxxxxxxxxxxxxxxxxxxxxxx Temps restant du client xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx







// xxxxxxxxxxxxxxxxxxxxxxxxxxxxx Update  CLIENT Location xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
  var coordonnees=new Array(); // La déclaration est obligatoire. 
  // C'est la fonction chow position qui remplit ce tableau. Elle utilise position dont je ne connais pas la source. C'est pouquoi j'utilise une variable globale.
function APIclients_locationsUpdate(){

	var idClient = document.getElementById("idClient").value; 
	getLocation();  /* On l'appelle pour remplir coordonnees*/
	console.log("Je viens d'arriver");
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		       // Typical action to be performed when the document is ready:
		       document.getElementById("reponseUpdateLocation").innerHTML = xhttp.responseText;
		   }
		};
		// url = "route('APIclients_locationsUpdate',["+idClient+","+coordsClient[0]+","+coordsClient[1]+"])";
		// Je ne trouve pas le moyen d'utiliser l'annotation .blade avec les variables de javeScripte
		url = "https://localhost/una_sotra/public/ClientLocation/"+idClient+"/"+coordonnees[0]+"/"+coordonnees[1];
		// En ligne
		// url = "https://glacial-everglades-43629.herokuapp.com/ClientLocation/"+idClient+"/"+coordonnees[0]+"/"+coordonnees[1];
		console.log(url);

		xhttp.open("GET", url , true);
		xhttp.send();
        setTimeout(APIclients_locationsUpdate, 5000); // mise à jour du contenu "timer" toutes les secondes
	}
// xxxxxxxxxxxxxxxxxxxxxxxxxxxxx Update  CLIENT Location xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx



// xxxxxxxxxxxxxxxxxxxxxxxxxxxxx POSITIONNEMENT CLIENT xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

function getLocation() {
	var x = document.getElementById("demo");
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
	var x = document.getElementById("demo");
  x.innerHTML = "<br>Latitude: " + position.coords.latitude +"<br>Longitude: " + position.coords.longitude;
  // var coordonnees=new Array(); // La déclaration est obligatoire
  coordonnees[0] = position.coords.latitude;
  coordonnees[1] = position.coords.longitude; 
}
// xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
</script>


</head>
<body onload="APIclients_locationsUpdate()">
<div class="container-fluid">


<!-- xxxxxxxxxxxxxxxx  nav bar xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
<a href="{{route('clientBienvenue')}}">clientBienvenue</a>
<a href="clientAppele">clientAppele</a>
<a href="clientInfoFile">clientInfoFile</a>
<a href="interfaeGuichetPersonnel"> interfaeGuichetPersonnel</a>
<!-- xxxxxxxxxxxxxxxx  nav bar xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->

<!-- Retour du controleur: infosClient ==> clientId clientNumero clientTicket nom prenom genre nbClientAvant tAttenteEstime idClient - ->dans _SESSION['idClient']  -->

<div>Infos location <span id="demo"></span></div>

<!-- Pour la mise à jour des infos géographiques -->
<form action=""><input type="text" id="idClient" value="<?=$_SESSION['idClient']?>"><?=$_SESSION['idClient']?></form>

<div>La repose de la mise à jour: <span id="reponseUpdateLocation"></span></div>
	<h1 class="MCenter">UNA_SCOLARITE</h1>

	<div class="row MCenter d-flex justify-content-center">
		<div class="col-12 service"><div class="col-12 ">Merci de patienter {{$infosClient->genre}} {{$infosClient->nom}} {{$infosClient->prenom}} !</div></div>
	</div>
	<div class="separateur"></div>
	<div class="row d-flex justify-content-center">
		<div class="col-12 col-md-6 service MCenter">Nombre de clients avant vous: <b>{{$infosClient->nbClientAvant}}</b> </div>
		<div class="col-12 col-md-6 service MCenter">Temps d’attente estimé: <b>{{$infosClient->tAttenteEstime}} </b></div>
		<div class="col-12 col-md-6 service MCenter">Votre ticket: <b>{{$infosClient->clientTicket}} </b></div>
	</div>
</div>


  <!-- CREATION SOCKET -->
  <script src="https://localhost/una_sotra/node_modules/socket.io/client-dist/socket.io.js"></script>
  <script>
    const socket = io();
  </script>

  <!-- FIN CODE SOCKET -->


</body>
</html>



<!--
Clef obtenu sur ce lien: https://console.cloud.google.com/apis/credentials?hl=fr&project=eco-notch-327321

Google Maps API_KEY= AIzaSyCYV20HH1FvJ0MOASehxOx0DsJ9IWrnFPg -->