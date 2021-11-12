
// <script type="text/javascript">
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
		       } else if (Tempsecouler > TAttenteEstimeSeconde  + 2*60) {
		       	  document.getElementById("NbClientRestant").innerHTML = NbClientRestant+'<br>Désoler pour le désagrement ! <br>Vous serez servie dans un instant.' ;
		          document.getElementById("Trestant").innerHTML = '00:00:00';
		           continuer = false;
		       }else{
		         	document.getElementById("NbClientRestant").innerHTML = NbClientRestant;
		          document.getElementById("Trestant").innerHTML = Tempsrestant;
		          // console.log('Tempsecouler='+Tempsecouler +' TempsAttenteEstime='+ (parseInt(TAttenteEstimeSeconde)));
		       }

		       // alert("Je suis ici");
		     }
		   };
		   		var idClient = document.getElementById("idClient").value; // Ne doit pas être dans le if
		   url = 'http://localhost/una_sotra/public/clientTicketInterface/'+idClient;
		   url = 'https://glacial-everglades-43629.herokuapp.com/clientTicketInterface/'+idClient;
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
		url = "http://localhost/una_sotra/public/ClientLocation/"+idClient+"/"+coordonnees[0]+"/"+coordonnees[1]+"/"+laDistance_En_m;
		// En ligne
		url = "https://glacial-everglades-43629.herokuapp.com/ClientLocation/"+idClient+"/"+coordonnees[0]+"/"+coordonnees[1]+"/"+laDistance_En_m;
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




/* On envoi les données au ESP*/

/******************** TRANSFERT DES DONNEES VERS LE ESP8266***********************/

    function Envoi_Au_ESP(){
    	var xhttp = new XMLHttpRequest();
    	xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
		       // Typical action to be performed when the document is ready:
		       var laReponse = this.responseText; /* Je recupère la réponse en string*/
		       console.log(laReponse);
		       document.getElementById("reponseEsp").innerHTML = laReponse;
		   }
		};
		
		IPDuEsp8266 = document.getElementById("IPEsp").value;
		numeroClient = document.getElementById("numeroClient").value;
		nom = document.getElementById("nom").value;
		prenom = document.getElementById("prenom").value;
		ticketClient = document.getElementById("ticketClient").value;
		guichet = document.getElementById("guichet").value;
		nbClientAvant = document.getElementById("nbClientAvant").value;
		tAttenteEstime = document.getElementById("tAttenteEstimeOK").value;
 // numeroClient nom prenom ticketClient guichet nbClientAvant tAttenteEstime





		url = "http://"+IPDuEsp8266+"/?numeroClient="+numeroClient+"&nom="+nom+"&prenom="+prenom+"&ticketClient="+ticketClient+"&guichet="+guichet+"&nbClientAvant="+nbClientAvant+"&tAttenteEstime="+tAttenteEstime;
		  // alert(url);
		 console.log(url);
		xhttp.open("GET", url, true);
		xhttp.send();
	}
  
/******************** TRANSFERT DES DONNEES VERS LE ESP8266**********************
 




/******************** TRANSFERT DES DONNEES VERS L IMPRIMANTE***********************/

    function Envoi_A_IMPRIMANTE(){
    	var xhttp = new XMLHttpRequest();
    	xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
		       // Typical action to be performed when the document is ready:
		       var laReponse = this.responseText; /* Je recupère la réponse en string*/
		       console.log(laReponse);
		       // document.getElementById("reponseEsp").innerHTML = laReponse;
		   }
		};
		
		nom = document.getElementById("nom").value;
		prenom = document.getElementById("prenom").value;
		ticketClient = document.getElementById("ticketClient").value;
		guichet = document.getElementById("guichet").value;
		nbClientAvant = document.getElementById("nbClientAvant").value;
		tAttenteEstime = document.getElementById("tAttenteEstime").value;
		date = document.getElementById("date").value;
 // numeroClient nom prenom ticketClient guichet nbClientAvant tAttenteEstime


url = "http://localhost/una_sotra/public/escpos_printer/example/interface/windows-usb.php/?nom="+nom+"&prenom="+prenom+"&ticketClient="+ticketClient+"&guichet="+guichet+"&nbClientAvant="+nbClientAvant+"&tAttenteEstime="+tAttenteEstime+"&date="+date;

		  // alert(url);
		 console.log(url);
		xhttp.open("GET", url, true);
		xhttp.send();
	}
  
/******************** TRANSFERT DES DONNEES VERS L IMPRIMANTE**********************

http://localhost/una_sotra/public/escpos_printer/example/interface/windows-usb.php/?nom=OUATTARA&prenom=Gninlnafanlan Justin&ticketClient=A-36&guichet=A&nbClientAvant=35&tAttenteEstime=1635273000











// var IPDuEsp8266;
/******************** Recuperer ID ESP8266***********************/

    function IPEsp8266VV(){
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
		url = "https://glacial-everglades-43629.herokuapp.com/public/API_IPESP8266";
		// alert(url);
		xhttp.open("GET", url, true);
		xhttp.send();
	}
/******************** Recuperer ID ESP8266***********************/

// ********************** Client Ticket **************************************** 

    // APIclients_locationsUpdate(); TempsRestant(); Envoi_Au_ESP(); Envoi_A_IMPRIMANTE(); 

// ********************** Client Ticket ****************************************
// </script>