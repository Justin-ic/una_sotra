/*Access-Control-Allow-Origin: http://localhost/una_sotra/public/APIclientAppel
Access-Control-Allow-Credentials: true
Access-Control-Expose-Headers: FooBar
Content-Type: text/html; charset=utf-8*/

	function horloge()
	{
        var tt = new Date().toLocaleTimeString();// hh:mm:ss
        
        document.getElementById("timer").innerHTML = tt;
        setTimeout(horloge, 1000); // mise à jour du contenu "timer" toutes les secondes
    }






var iii=0;


function APIclientAppel(){
iii++;
       document.getElementById('tours').value = iii;

var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		// alert(this.responseText);
       // Typical action to be performed when the document is ready:
       var myArr = JSON.parse(this.responseText); /* Je transforme la réponse en array()*/
       var i;

       // console.log(myArr[0].nom);


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



/* On envoi les données au ESP*/
Envoi_Au_ESP(myArr[i].ticket, myArr[i].guichet, myArr[i].numero);


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

}/* FIN APIclientAppel*/



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


// var IPDuEsp8266;
/******************** Recuperer ID ESP8266***********************/

    function IPEsp8266(){
    	var xhttp = new XMLHttpRequest();
    	xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
		       // Typical action to be performed when the document is ready:
		       var laReponse = this.responseText; /* Je recupère la réponse en string*/
		       console.log('ID du ESP est:'+laReponse);
		        alert('ID du ESP est:'+laReponse)
		       document.getElementById("IDEsp").value = laReponse;
		   }
		};

		// En production
		// url = "https://glacial-everglades-43629.herokuapp.com/public/API_IPESP8266";
		url = "http://localhost/una_sotra/public/API_IPESP8266";
		// alert(url);
		xhttp.open("GET", url, true);
		xhttp.send();
	}
/******************** Recuperer ID ESP8266***********************/





/******************** TRANSFERT DES DONNEES VERS LE ESP8266***********************/

    function Envoi_Au_ESP(ticketClientEnCours, guichet, numeroClientProchain){
    	var xhttp = new XMLHttpRequest();
    	xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
		       // Typical action to be performed when the document is ready:
		       var laReponse = this.responseText; /* Je recupère la réponse en string*/
		       console.log(laReponse);
		       document.getElementById("reponseEsp").innerHTML = laReponse;
		   }
		};
		
		IPDuEsp8266 = document.getElementById("IDEsp").value;

		url = "http://"+IPDuEsp8266+"/?ticket="+ticketClientEnCours+"&guichet="+guichet+"&numero="+numeroClientProchain;
		 // alert(url);
		 console.log(url);
		xhttp.open("GET", url, true);
		xhttp.send();
	}
  
/******************** TRANSFERT DES DONNEES VERS LE ESP8266**********************
 * <body onload="horloge(), APIclientAppel(), Envoi_Au_ESPTest('A-6','A',1233)">
*/




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
	console.log(position);
  x.innerHTML = "Latitude: " + position.coords.latitude +
  "<br>Longitude: " + position.coords.longitude;
}
// xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx


