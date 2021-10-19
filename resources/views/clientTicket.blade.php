<?php /* session_start();*/  ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/bootstrap/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('images/styleBienvenue.css') }}">

	<title>una_Scolarité</title>
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

var continuer = true;
function TempsRestant(){

	var xhttp = new XMLHttpRequest();
	// alert("Je suis ici");

			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
		       // Typical action to be performed when the document is ready:
		       var myArr = JSON.parse(this.responseText); /* Je transforme la réponse en array()*/
		       console.log(myArr);

				   var secondsSinceEpoch = Math.round(Date.now() / 1000); // Nb seconde depuis
				   var NbClientRestant = myArr[0];
				   var TempsAttenteEstime =  myArr[1];
				   var created_at = myArr[2];

				   	// alert("La console=="+idClient);

				   Tempsecouler =  parseInt(secondsSinceEpoch) -  parseInt(created_at);
				   Tempsrestantx = parseInt(TempsAttenteEstime) - ( parseInt(secondsSinceEpoch) -  parseInt(created_at) );

				   // Conversion de secondes en heure
				   // Tecouler = toTimeString(Tempsecouler); // Debuge 00:30:0

				   // Conversion au format hh:mm:ss
				   Tempsrestant  = toTimeString(Tempsrestantx);
				   TempsAttenteEstimeFormat = toTimeString(TempsAttenteEstime);

				   // Retourne le nombre de secondes si on lui envoie le format hh:mm:ss
				  TAttenteEstimeSeconde = timeToSecondes(TempsAttenteEstimeFormat);
				   
console.log('!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! Resolu OKOK TAttenteEstimeSeconde='+TAttenteEstimeSeconde);

				   // console.log( parseInt(TempsAttenteEstime) - ( parseInt(secondsSinceEpoch)  - parseInt(created_at) );
// 1632952800  

				   // console.log(Tempsrestant +' = '+ parseInt(TempsAttenteEstime) +' -  ( '+ parseInt(secondsSinceEpoch)  +' - '+ parseInt(created_at) +')'+ );
				   
				   // Affichage
		       if (NbClientRestant <= 0) {
		       		document.getElementById("NbClientRestant").innerHTML = '<br>C\'est votre tour !! Vous allez recevoir un sms.';
		          document.getElementById("Trestant").innerHTML = '00:00:00';
		          continuer = false;
		       } else if (Tempsecouler > TAttenteEstimeSeconde) {
		       	  document.getElementById("NbClientRestant").innerHTML = NbClientRestant+'<br>Désoler pour le désagrement ! <br>Vous serez servie dans un instant.' ;
		          document.getElementById("Trestant").innerHTML = '00:00:00';
		           continuer = false;
		       }else{
		         	document.getElementById("NbClientRestant").innerHTML = NbClientRestant;
		          document.getElementById("Trestant").innerHTML = Tempsrestant;
		          console.log('Tempsecouler='+Tempsecouler +' TempsAttenteEstime='+ (parseInt(TAttenteEstimeSeconde)));
		       }

		       // alert("Je suis ici");
		     }
		   };
		   		var idClient = document.getElementById("idClient").value; // Ne doit pas être dans le if
		   url = 'https://localhost/una_sotra/public/clientTicketInterface/'+idClient;
		   // alert(idClient);
		   console.log(url);
	   xhttp.open("GET", url, true);
	   xhttp.send();
	   if ( continuer = true) {
    	 setTimeout(TempsRestant, 1000); // mise à jour du contenu "timer" toutes les secondes
	   } else {
	   	alert('Désoler pour le désagrement! Veuillez patienté dans un instant SVP!');
	      }


    }
// xxxxxxxxxxxxxxxxxxxxxxxxxxxxx Temps restant du client xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx





// xxxxxxxxxxxxxxxxxxxxxxxxxxxxx Convertie le temps en seconde xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				function timeToSecondes(Tempsrestant){
					heure = Tempsrestant[0]+''+Tempsrestant[1];
					minute = Tempsrestant[3]+''+Tempsrestant[4];
					seconds = Tempsrestant[6]+''+Tempsrestant[7];
					Tsecondes = parseInt(heure)*3600 + parseInt(minute)*60 + parseInt(seconds);
					console.log('Tsecondes===='+Tsecondes);
					return Tsecondes;
				}
// xxxxxxxxxxxxxxxxxxxxxxxxxxxxx Convertie le temps en seconde xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx


// xxxxxxxxxxxxxxxxxxxxxxxxxxxxx Calcule la distace entre La scolarite et le lient xxxxxxxxxxxxxxx
function distance(lat1, lon1, lat2, lon2) {
  var R = 6371; // Radius of the earth in km
  var dLat = (lat2 - lat1) * Math.PI / 180;  // deg2rad below
  var dLon = (lon2 - lon1) * Math.PI / 180;
  var a = 
     0.5 - Math.cos(dLat)/2 + 
     Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) * 
     (1 - Math.cos(dLon))/2;

  return R * 2 * Math.asin(Math.sqrt(a));
}


laDistance = distance(5.387056402459017,-4.016037567213115 , 59.3225525,13.4619422);
console.log(laDistance);
// xxxxxxxxxxxxxxxxxxxxxxxxxxxxx Calcule la distace entre La scolarite et le lient xxxxxxxxxxxxxxx





    function toTimeString(seconds) {
   		 return (new Date(seconds * 1000)).toUTCString().match(/(\d\d:\d\d:\d\d)/)[0];
			}



// xxxxxxxxxxxxxxxxxxxxxxxxxxxxx Update  CLIENT Location xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
  var coordonnees=new Array(); // La déclaration est obligatoire. 
  // C'est la fonction chow position qui remplit ce tableau. Elle utilise position dont je ne connais pas la source. C'est pouquoi j'utilise une variable globale.
function APIclients_locationsUpdate(){

	getLocation();  /* On l'appelle pour remplir coordonnees*/
	dateTime = console.log("Je viens d'arriver");
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		       // Typical action to be performed when the document is ready:
		       document.getElementById("reponseUpdateLocation").innerHTML = xhttp.responseText;
		   }
		};

			var idClient = document.getElementById("idClient").value; 
			laDistance = distance(5.387056402459017,-4.016037567213115 , coordonnees[0],coordonnees[1]);
			laDistance_En_m = (laDistance*1000);
		  console.log(laDistance+' Km');
		  console.log(laDistance_En_m+' m');

		// url = "route('APIclients_locationsUpdate',["+idClient+","+coordsClient[0]+","+coordsClient[1]+"])";
		// Je ne trouve pas le moyen d'utiliser l'annotation .blade avec les variables de javeScripte
		url = "https://localhost/una_sotra/public/ClientLocation/"+idClient+"/"+coordonnees[0]+"/"+coordonnees[1]+"/"+laDistance_En_m;
		// En ligne
		// url = "https://glacial-everglades-43629.herokuapp.com/ClientLocation/"+idClient+"/"+coordonnees[0]+"/"+coordonnees[1]+"/"+laDistance_En_m;
		dateTime = console.log(url);

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
<body onload="APIclients_locationsUpdate(), TempsRestant()">

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
<br><br>
<!-- ***************************** GESTION DU TIMER********************************** -->


<!-- xxxxxxxxxxxxxxxx  nav bar xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
<a href="{{route('clientBienvenue')}}">clientBienvenue</a>
<a href="clientAppele">clientAppele</a>
<a href="clientInfoFile">clientInfoFile</a>
<a href="interfaeGuichetPersonnel"> interfaeGuichetPersonnel</a>
<!-- xxxxxxxxxxxxxxxx  nav bar xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->

<!-- Retour du controleur: infosClient ==> clientId clientNumero clientTicket nom prenom genre nbClientAvant tAttenteEstime idClient - ->dans _SESSION['idClient']  -->




<div>Infos location <span id="demo"></span></div>

<!-- Pour la mise à jour des infos géographiques -->

<div>La repose de la mise à jour: <span id="reponseUpdateLocation"></span></div>

<br><br><br><br><br>



<!-- ********************************************************* -->



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










<!-- ********************************************************* -->
	<h1 class="MCenter">UNA_SCOLARITE</h1>

	<div class="row MCenter d-flex justify-content-center">
		<div class="col-12 service"><div class="col-12 ">Merci de patienter {{$infosClient->genre}} {{$infosClient->nom}} {{$infosClient->prenom}} !</div></div>
	</div>
	<div class="separateur"></div>
	<div class="row d-flex justify-content-center">
		<div class="col-12 col-md-6 service MCenter" >Nombre de clients avant vous:  <b><span id="NbClientRestant"></span></b> </div>
		
		<div class="col-12 col-md-6 service MCenter">Temps d’attente estimé à l'arrivé: <b>{{$infosClient->tAttenteEstime}} </b></div>

		<div class="col-12 col-md-6 service MCenter">Temps d’attente restant: <b><span id="Trestant"></span></b></div>

		<div class="col-12 col-md-6 service MCenter">Votre ticket: <b>{{$infosClient->clientTicket}} </b></div>
	</div>
</div>



</body>
</html>



<!--
Clef obtenu sur ce lien: https://dateTime = console.cloud.google.com/apis/credentials?hl=fr&project=eco-notch-327321

Google Maps API_KEY= AIzaSyCYV20HH1FvJ0MOASehxOx0DsJ9IWrnFPg -->