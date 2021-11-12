<?php /* session_start();*/  ?>
<!-- <!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/bootstrap/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('images/styleBienvenue.css') }}">

	<title>una_Scolarité</title> -->
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

<!-- <script type="text/javascript">
</script> -->
<!-- , IPEsp8266() -->



<!-- </head> -->
<!-- <body onload="APIclients_locationsUpdate(), TempsRestant(), Envoi_Au_ESP(), Envoi_A_IMPRIMANTE()"> -->



@extends('layouts.app2')

@section('contenu')

<style type="text/css">
    body{
    /*background-image: url('imgBienvenue.jpg');*/
    /*background-repeat: no-repeat;*/
    background-color: #dee9ff;
}
</style>


<!-- ********************** Client Ticket **************************************** -->
  <!-- popper pour dropdown et doit être placer avant les bootstraps.js-->
  <script type="text/javascript" src="{{  asset('styles/js/clientTicket.js')  }}"></script> 

<!-- ********************** Client Ticket **************************************** -->


 <!-- <body onload="TempsRestant()"> -->
<div class="container-fluid">



<!-- ***************************** GESTION DU TIMER********************************** -->

<!-- <div>Les secondes <span id="ddd"></span></div>
<div>Le temps Ecouler<span id="Tecouler"></span></div>
<div>Le temps Restant<span id="Trestant"></span></div> -->
<?php 
// ->format('H:i:s')


$address = $_SERVER['REMOTE_ADDR'];

echo '<br><br>';
print_r($address);
echo '<br><br>';



// dd($infosClient);
$ddd = $infosClient->created_at;
$DateEnSecondes = strtotime($ddd); // Converssion en seconde

$estim = $infosClient->tAttenteEstime; // Il est en heure, il faut donct ajouter YYYY-mm-dd

// echo 'La date='.$estim;
$DateEnSecondeSestim = strtotime($estim);
/*
$t = date("Y-m-d H:i:s");
$ttt = strtotime($t);
echo 'XXX='.$ttt;*/


// echo "xxxxxxxxxxxxxxxxxx = ".$_SESSION['idClient'];

 ?>

DateEnSecondes:
<input type="text" value="<?=$DateEnSecondes?>" name="" id="created_at">
DateEnSecondeSestim:
<input type="text" value="<?=$DateEnSecondeSestim?>" name="" id="tAttenteEstime">
<!-- clientId Utiliser l'API -->
idClient:
<input type="text" id="idClient" value="<?=$_SESSION['idClient']?>">


<!-- ----------------------------------------------------------- -->
<input type="text" name="" id="IPEspxx">
<!-- ----------------------------------------------------------- -->


<?php if (isset($ipESP) ) {
	
} else {
	$ipESP = "";
}
 ?>
<!-- ----------------------------------------------------------- -->
 <input type="text" name="" id="IPEsp" value="<?=$ipESP?>"> 
<!-- ----------------------------------------------------------- -->


<!-- ----------------------------------------------------------- -->
<input type="text" name="" value="<?=$infosClient->clientTicket?>" id="ticketClient">
<!-- ----------------------------------------------------------- -->

<!-- ----------------------------------------------------------- -->
<?php $guichet = $infosClient->clientTicket; $guichet = $guichet[0];  ?>
<input type="text" name=""  value="<?=$guichet ?>" id="guichet">
<!-- ----------------------------------------------------------- -->

<!-- ----------------------------------------------------------- -->
<input type="text" name=""  value="<?=$infosClient->clientNumero?>" id="numeroClient">
<!-- ----------------------------------------------------------- -->



<!-- ----------------------------------------------------------- -->
<input type="text" name=""  value="<?=$infosClient->nom?>" id="nom">
<!-- ----------------------------------------------------------- -->


<!-- ----------------------------------------------------------- -->
<input type="text" name=""  value="<?=$infosClient->prenom?>" id="prenom">
<!-- ----------------------------------------------------------- -->


<!-- ----------------------------------------------------------- -->
<input type="text" name=""  value="<?=$infosClient->nbClientAvant?>" id="nbClientAvant">
<!-- ----------------------------------------------------------- -->


<!-- ----------------------------------------------------------- -->
<input type="text" name=""  value="<?=$infosClient->tAttenteEstime?>" id="tAttenteEstimeOK">
<!-- ----------------------------------------------------------- -->


<!-- ----------------------------------------------------------- -->
<input type="text" name=""  value="<?=$infosClient->created_at?>" id="date">
<!-- ----------------------------------------------------------- -->

	<!-- nbClientAvant 	tAttenteEstime 	nom 	prenom -->

<br><br>
<!-- ***************************** GESTION DU TIMER********************************** -->


<!-- xxxxxxxxxxxxxxxx  nav bar xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
<!-- <a href="{{route('clientBienvenue')}}">clientBienvenue</a>
<a href="clientAppele">clientAppele</a>
<a href="clientInfoFile">clientInfoFile</a>
<a href="interfaeGuichetPersonnel"> interfaeGuichetPersonnel</a> -->
<!-- xxxxxxxxxxxxxxxx  nav bar xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->

<!-- Retour du controleur: infosClient ==> clientId clientNumero clientTicket nom prenom genre nbClientAvant tAttenteEstime idClient - ->dans _SESSION['idClient']  -->




<div>Infos location <span id="demo"></span></div>

<!-- Pour la mise à jour des infos géographiques -->

<div>La repose de la mise à jour: <span id="reponseUpdateLocation"></span></div>

<!-- <br><br><br><br><br> -->



	<h1 class="MCenter">UNA_SCOLARITE</h1>

	<div class="row MCenter d-flex justify-content-center">
		<div class="col-12 service"><div class="col-12 ">Merci de patienter {{$infosClient->genre}} {{$infosClient->nom}} {{$infosClient->prenom}} !</div></div>
	</div>
	<div class="separateur"></div>
	<div class="row d-flex justify-content-center">
		<div class="col-12 col-md-6 service MCenter" >Nombre de clients avant vous:  <b><span id="NbClientRestant">{{$infosClient->nbClientAvant}}</span></b> </div>
		
		<div class="col-12 col-md-6 service MCenter">Temps d’attente estimé à l'arrivé: <b>{{$infosClient->tAttenteEstime}} </b></div>

		<div class="col-12 col-md-6 service MCenter"><!-- Temps d’attente restant: --> <b><span id="Trestant"></span></b></div>

		<div class="col-12 col-md-6 service MCenter">Votre ticket: <b>{{$infosClient->clientTicket}} </b></div>
	</div>
</div>





<script type="text/javascript">
	
	// var IPDuEsp8266;
/******************** Recuperer ID ESP8266***********************/
// IPEsp8266();
    function IPEsp8266(){
    	var xhttp = new XMLHttpRequest();
    	xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
		       // Typical action to be performed when the document is ready:
		       var laReponse = this.responseText; /* Je recupère la réponse en string*/
		       console.log('ID du ESP est:'+laReponse);
		         // alert('ID du ESP est:'+laReponse)
		       document.getElementById("IPEsp").value = laReponse;
		   }
		};

		// En production
		url = "http://localhost/una_sotra/public/API_IPESP8266";
		// url = "https://glacial-everglades-43629.herokuapp.com/public/API_IPESP8266";
		// alert(url);
		xhttp.open("GET", url, true);
		xhttp.send();
	}
/******************** Recuperer ID ESP8266***********************/



</script>
	
	<script type="text/javascript">
		APIclients_locationsUpdate(); TempsRestant(); Envoi_Au_ESP(); Envoi_A_IMPRIMANTE(); 
	</script>


@endsection



<!--
Clef obtenu sur ce lien: http://dateTime = console.cloud.google.com/apis/credentials?hl=fr&project=eco-notch-327321

Google Maps API_KEY= AIzaSyCYV20HH1FvJ0MOASehxOx0DsJ9IWrnFPg -->