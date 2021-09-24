
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<!-- http-equiv="refresh" content="30" -->
	<meta  name="viewport" content="width=device-width, initial-scale=1.0">
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
    function APIclientInfoFile(){
iii++;
    	var xhttp = new XMLHttpRequest();
    	xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
		       // Typical action to be performed when the document is ready:
		       var myArr = JSON.parse(this.responseText); /* Je transforme la réponse en array()*/
		       var i;
		       var div=''; /* Il faut forcement l'initialiser*/
		       // console.log(myArr[0].nom);

		       for(i = 0; i < myArr.length; i++) {
		       	 
	 div += '<div class="row  contourLigneFile">'+ iii +'s<!-- Début Une ligne de détail d appel -->';
	 div += '	<div class="col-12">';
	 div += '		<div class="row">';
	 div += '		<div class="col-12 d-flex justify-content-center" style="font-size: 30px; font-weight: bold;">';
	 div += '		Guichet '+ myArr[i].nom +': ==>  '+ myArr[i].nbClient +'</div>';
	 div += '		</div>';
	 div += '	</div>';
	 div += '</div><!-- fin Une ligne de détail d appel -->';
	 div += '';
	 div += '';

		       }
		       document.getElementById("reponseAPI").innerHTML = div;
		       setTimeout(APIclientInfoFile, 1000); // mise à jour du contenu "timer" toutes les secondes
		   }
		};
		xhttp.open("GET", "{{route('APIclientInfoFile')}}", true);
		xhttp.send();
	}


</script> 
 
<!-- xxxxxxxxxxxxxxxxxxxx le timine xxxxxxxxxxxxxxxxxxxxxxxxxx -->


</head>
<body onload="horloge(), APIclientInfoFile()">

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
					<h1>FILE D’ATTENTE A LA SCOLARITE</h1>
				</div>
			</div>
		</div>
	</div>

	<!-- Alignement vertical et horizontal -->
	<div class="col-4  d-flex align-items-center justify-content-center sectionFile">
		<div class=" "><h1>Avancement de la file</h1></div>
	</div>

</div>


<div class="row">
	<div class="col-8" style="background-color: red; padding: 0px;">
		<div class="row">
			<div class="col-12" style="">
			<!-- <div class="col-12" style=" height: 500px; margin: 0px; padding:0px;"> -->
				<!-- <img src="{{ asset('images/imgPub.jpg') }}" alt="Pub" style="width:100%; height: 500px;"> -->




<!-- *********************la publicite ici *********************** -->
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" >
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('images/imgPub.jpg') }}" class="d-block w-100" alt="..." style=" height: 500px;">
<!--       <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div> -->
    </div>
    <div class="carousel-item">
      <img src="{{ asset('images/imgPub.jpg') }}" class="d-block w-100" alt="..." style=" height: 500px;">
<!--       <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>Some representative placeholder content for the second slide.</p>
      </div> -->
    </div>
    <div class="carousel-item">
      <img src="{{ asset('images/imgPub.jpg') }}" class="d-block w-100" alt="..." style=" height: 500px;">
  <!--     <div class="carousel-caption d-none d-md-block">
        <h5>Third slide label</h5>
        <p>Some representative placeholder content for the third slide.</p>
      </div> -->
    </div>
  </div>
<!--   <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button> -->
<!--   <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button> -->
</div>
<!-- *********************la publicite ici *********************** -->






			</div>
		</div>
	</div>

	<div class="col-4 sectionFileDroite" id="reponseAPI">

<!--   CE CODE EST REMPLACER PAR LE JavaScript

		<div class="row  contourLigneFile">Début Une ligne de détail d'appel
			<div class="col-12">
				<div class="row">
					<div class="col-12 d-flex justify-content-center" style="font-size: 30px; font-weight: bold;">A-123</div>
				</div>
			</div>
		</div>fin Une ligne de détail d'appel
 -->
	</div>
</div>


<div class="row " style="height: 65px; font-size: 40px;">
	<div class="col-8  d-flex align-items-center justify-content-center bg-info">
		<marquee behavior="" direction="">
			Retirez vos cartes de bus sans faire désormain des rangs unitils.
		</marquee>
	</div>
	<div class="col-4 d-flex align-items-center justify-content-center sectionFile"><div style="font-weight:bolder;"><div id="timer"></div></div></div>
</div>



</div>

	<!-- popper pour dropdown et doit être placer avant les bootstraps.js-->
	<script type="text/javascript" src="{{  asset('styles/js/popper.min.js')  }}"></script> 
	<script type="text/javascript" src="{{  asset('styles/js/jquery3.4.1.js')  }}"></script>
	<script type="text/javascript" src="{{  asset('styles/js/bootstrap.min.js')  }}"></script>

</body>
</html>










