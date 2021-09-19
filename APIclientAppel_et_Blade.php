<?php 



    /**
     *API pour faire la mise à jour de la page des appels.
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function APIclientAppel()
    {
        $reponse = array(); $cpt=0;
        $contenu = scandir('temporaires/');
/*        echo "<pre>";
        print_r($contenu);
        echo "</pre>";*/
// echo count($contenu);
        for ($i=2; $i < count($contenu); $i++) { 
            // echo "Le fichier ".$contenu[$i]."<br>";

            $fichier = fopen('temporaires/'.$contenu[$i], 'r');
            $appel = fgets($fichier);
            $itcketDuSuivant = fgets($fichier);
            // echo "WW".$itcketDuSuivant."WW";
            fclose($fichier);

            $position = strpos($appel, 'false');
            // echo "Le fichier ".$contenu[$i]." contient:  ".$appel.". On trouve false ici: ".$position ."<br><br>";
            if ($position != "") {
               $nouveauText = str_replace('false', 'true', $appel);
                $fichier = fopen('temporaires/'.$contenu[$i], 'w+');
               fwrite($fichier, $nouveauText.$itcketDuSuivant);
               // echo "Pas encore appeler. On remplace le contenu par: ".$nouveauText."<br>".$itcketDuSuivant."<br><br>";
               //  ON VA APPELER CE CLIENT

               $reponse[$cpt++] = array('ticket' => $itcketDuSuivant, 'guichet' => $itcketDuSuivant[0]);
               // fclose($fichier);
            }else{
   /*            $nouveauText = str_replace('true', 'false', $appel);
                $fichier = fopen('temporaires/'.$contenu[$i], 'w+');
               fwrite($fichier, $nouveauText.$itcketDuSuivant);
               // echo "Deja appeler. On remplace le contenu par: ".$nouveauText."<br>".$itcketDuSuivant."<br><br>";
                 }
                 fclose($fichier);*/
        }

    }


   /*     echo "<pre>";
        print_r($reponse);
        echo "</pre>";*/
        return $reponse; /* Pour afficher du JSON dans une page, on ne doit pas avoir du texte avant */

    }




    /**************************************************************************************/
    /**************************************************************************************/
    /**************************************************************************************/
    /**************************************************************************************/

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/bootstrap/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('images/styleBienvenue.css') }}">

	<title>una_sotra</title>

<!-- xxxxxxxxxxxxxxxxxxxx le timine xxxxxxxxxxxxxxxxxxxxxxxxxx -->
<script type="text/javascript">
	function horloge()
	{
        var tt = new Date().toLocaleTimeString();// hh:mm:ss
        
        document.getElementById("timer").innerHTML = tt;
        setTimeout(horloge, 1000); // mise à jour du contenu "timer" toutes les secondes
    }






var iii=0;
var infoTicket=0;
var infoNumero=0;

console.log(infoNumero);
    function APIclientAppel(){
iii++;
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		// alert(this.responseText);
       // Typical action to be performed when the document is ready:
       var myArr = JSON.parse(this.responseText); /* Je transforme la réponse en array()*/
       var i;

       // console.log(myArr[0].nom);

       /*   */


// alert(nouvelleClass);
       for(i = 0; i < myArr.length; i++) {
       var div=''; /* Il faut forcement l'initialiser*/  
       leId = creerId();   	 
	 // div += '  <div class="row  contourLigneAppel">';
	 div += '	<div class="col-6">';
	 div += '		<div class="row">';
	 div += '			<div class="col-12 d-flex justify-content-center" style="font-size: 30px; font-weight: bold;">'+ myArr[i].ticket +' '+leId+'</div>';
	 div += '			<div class="col-12"><img src="{{ asset("images/fleche.png") }}" alt="" style="width:100%; height: 30px;"></div>';
	 div += '		</div>';
	 div += '	</div>';
	 div += '	<div class="col-6">';
	 div += '		<div class="row">';
	 div += '			<div class="col-12  d-flex justify-content-center" style="font-size:20px">Guichet</div>';
	 div += '			<div class="col-12  d-flex justify-content-center" style="font-weight: bold; font-size: 30px;">'+ myArr[i].guichet +'</div>';
	 div += '		</div>';
	 div += '	</div>';
	 // div += '</div>';
	 div += '';
	 div += '';



creerDiv(leId); /* Je l'appelle en précisant le id*/
document.getElementById(leId).innerHTML = div;
addTimeLine(leId);




// console.log(document.getElementById(leId));
		       }

/*		DEBUGAGE
  test = document.getElementById("reponseAPIv");
  if (test == null) {alert('vide; pas trouve')}else{alert('On trouve quelque chose')}
  console.log(test);

*/
		       // document.getElementById("reponseAPI").innerHTML = div;
		       // addTimeLine();
		       setTimeout(APIclientAppel, 1000); // mise à jour du contenu "timer" toutes les secondes
		   }
		};
		xhttp.open("GET", "{{route('APIclientAppel')}}", true);
		xhttp.send();
	}

/*  On va suprimer l'element dans les lignes d'appel*/
function removeElement(element) {
  if (typeof(element) === "string") {
    element = document.getElementById(element);
  }
  return function() {
    element.parentNode.removeChild(element);
  };
}






/* retarde l'exécution du programme mais avec ca selement, on attend que la boucle finisse avant de lancer l'annimation*/
function sleep(milliseconds) {
  const date = Date.now();
  let currentDate = null;
  do {
    currentDate = Date.now();
  } while (currentDate - date < milliseconds);
}




/* POUR CONVERTIR DES SECONDES EN TIME*/
function toTimeString(seconds) {
	 return (new Date(seconds * 1000)).toUTCString().match(/(\d\d:\d\d:\d\d)/)[0];
	}




/* POUR CREER UN NOUVEAU ID EN FONCTION DS LIGNES DEJA AFFICHE*/
function creerId(){
	for (var i = 0; i < 100; i++) {
		var nouveauID = 'ligne'+(i+1);
		 resultat = document.getElementById(nouveauID);
		if (resultat == null) {return nouveauID;}
	}
  }


/* CREATION D'UNE div QUI LE ID RECEMENT CREER  */
function creerDiv(leId) {
	let bloc = document.getElementById("reponseAPI");
    div = document.createElement('div');
    div.classList.add("row");
    div.classList.add("contourLigneAppel");
    div.id = leId;
	bloc.append(div);
}


/* AJOUTER A LA Time Line */
function addTimeLine(id){
	const TL = new TimelineMax({paused: false}); 
	/* paused: false active l'animation dèsle chargement*/
	const ligneAppel = document.getElementById(id);
	// console.log(ligneAppel);

	TL
	.from(ligneAppel,3,{opacity:0, x: -100})
	.to(ligneAppel,60, {opacity:1} )
	.call(removeElement(id))

}
/*		PRINCIPE
Je veux que à chaque fois que un guichet clique sur son bouton SUIVANT, je modifie le fichier 
nomGuichet.txt en mettant ceci à l'intérieur:
		appel=false 
		C-2
Quant à l'API, elle ira lire chaque fichier. Si on trouve false à l'intérieur, on récupere le ticket qui est à la ligne suivante et on l'ajoute à un tableau. En suite, on remplace false par true dans le dit fichier.

A la fin, ce tableau sera retourné.

BON QUAND ON RECOIT LE TABLEAU, ON FAIT QUOI AVEC ????

Pour chaque ligne du tableau reçu, on doit créer une div, lui associer un id unique (qui n'est pas encore dans une des lignes d'appel). En suite, on doit l'ajouter à un time Line de une minute

*/

?>



</script> 
 
<!-- xxxxxxxxxxxxxxxxxxxx le timine xxxxxxxxxxxxxxxxxxxxxxxxxx -->


</head>
<body onload="horloge(), APIclientAppel()">

<div class="container-fluid">

<!-- xxxxxxxxxxxxxxxx  nav bar xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
<a href="{{route('clientBienvenue')}}">clientBienvenue</a>
<a href="clientAppele">clientAppele</a>
<a href="clientInfoFile">clientInfoFile</a>
<a href="interfaeGuichetPersonnel"> interfaeGuichetPersonnel</a>
<!-- xxxxxxxxxxxxxxxx  nav bar xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->




<div class="row" style="">

	<div class="col-8" >
		<div class="row " style="background-color: white;">
			<div class="col-1" >
				<img src="{{ asset('images/logoUNA.png') }}" alt="SOTR UNA" class="logoUNA" style="margin: 0px;">
			</div>

			<div class="col-11 d-flex align-items-center justify-content-center">
				<div class="">
					<h1>FILE D’ATTENTE POUR LES CARTES DE BUS</h1>
				</div>
			</div>
		</div>
	</div>

	<!-- Alignement vertical et horizontal -->
	<div class="col-4  d-flex align-items-center justify-content-center bg-warning">
		<div class=" "><h1>Appel</h1></div>
	</div>

</div>


<div class="row">
	<div class="col-8" style="background-color: red; padding: 0px;">
		<div class="row">
			<div class="col-12">
				<img src="{{ asset('images/imgPub.jpg') }}" alt="Pub" style="width:100%; height: 500px;">
			</div>
		</div>
	</div>
	<div class="col-4" id="reponseAPI">

<!-- Début Une ligne d'appel -->
		<!-- <div class="row  contourLigneAppel">
			<div class="col-6">
				<div class="row">
					<div class="col-12 d-flex justify-content-center" style="font-size: 30px; font-weight: bold;">A-123</div>
					<div class="col-12"><img src="{{ asset('images/fleche.png') }}" alt="" style="width:100%; height: 30px;"></div>
				</div>
			</div>
			<div class="col-6">
				<div class="row">
					<div class="col-12  d-flex justify-content-center" style="font-size:20px">Guichet</div>
					<div class="col-12  d-flex justify-content-center" style="font-weight: bold; font-size: 30px;">A</div>
				</div>
			</div>
		</div> -->
<!-- fin Une ligne d'appel -->

<!-- Début Une ligne d'appel -->
		<!-- <div class="row  contourLigneAppel">
			<div class="col-6">
				<div class="row">
					<div class="col-12 d-flex justify-content-center" style="font-size: 30px; font-weight: bold;">A-123</div>
					<div class="col-12"><img src="{{ asset('images/fleche.png') }}" alt="" style="width:100%; height: 30px;"></div>
				</div>
			</div>
			<div class="col-6">
				<div class="row">
					<div class="col-12  d-flex justify-content-center" style="font-size:20px">Guichet</div>
					<div class="col-12  d-flex justify-content-center" style="font-weight: bold; font-size: 30px;">A</div>
				</div>
			</div>
		</div> -->
<!-- fin Une ligne d'appel -->
		
	</div>
</div>


<div class="row " style="height: 65px; font-size: 40px;">
	<div class="col-8  d-flex align-items-center justify-content-center bg-info">
		<marquee behavior="" direction="">
			Retirez vos cartes de bus sans faire désormain des rags unitils.
		</marquee>
	</div>
	<div class="col-4 d-flex align-items-center justify-content-center bg-warning"><div style="font-weight:bolder;"><div id="timer"></div></div></div>
</div>


</div>
	<script type="text/javascript" src="{{  asset('styles/js/TweenMax.min.js')  }}"></script> 
	<script type="text/javascript" src="{{  asset('styles/js/jquery3.4.1.js')  }}"></script>
</body>
</html>







