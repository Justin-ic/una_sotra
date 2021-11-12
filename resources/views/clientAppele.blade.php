<!-- 
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/bootstrap/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('images/styleBienvenue.css') }}">

	<title>una_Scolatité</title> -->



@extends('layouts.app2')

@section('contenu')

<style type="text/css">
    body{
    /*background-image: url('imgBienvenue.jpg');*/
    /*background-repeat: no-repeat;*/
    background-color: #dee9ff;
}
</style>



<!-- ********************** Client Appel **************************************** -->
  <script type="text/javascript" src="{{  asset('styles/js/TweenMax.min.js')  }}"></script> 
  <script type="text/javascript" src="{{  asset('styles/js/clientAppel.js')  }}"></script> 
<!-- ********************** Client Appel **************************************** -->


<!-- <body onload="horloge(), APIclientAppel(), getLocation(), IPEsp8266()"> -->

<div class="container-fluid">


<!-- ----------------------------------------------------------- -->
<h1>la réponse du ESP (Serveur distant): <span id="reponseEsp">cc</span></h1>
<!-- ----------------------------------------------------------- -->

<!-- ----------------------------------------------------------- -->
<h1>lA POSITION DU CLIENT EST: <span id="demo">cc</span></h1>
<!-- ----------------------------------------------------------- -->


<!-- ----------------------------------------------------------- -->
<input type="text" name="" id="IDEsp">
<!-- ----------------------------------------------------------- -->


<!-- ----------------------------------------------------------- -->
<input type="text" name="c" id="tours">
<!-- ----------------------------------------------------------- -->



<!-- ----------------------------------------------------------- -->
<?php
  function getIp(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
  }
  echo 'L adresse IP de l utilisateur est : '.getIp();
?>
<!-- ----------------------------------------------------------- -->


<div class="row" style="">

	<div class="col-8" >
		<div class="row " style="background-color: white;">
			<div class="col-1" >
				<img src="{{ asset('images/logoUNA.png') }}" alt="SOTR UNA" class="logoUNA" style="margin: 0px;">
			</div>

			<div class="col-11 d-flex align-items-center justify-content-center">
				<div class="">
					<h1>FILE D’ATTENTE A LA SCOLARITE</h1> <!-- 07  56 96 55 82 -->
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
	<div class="col-8" style="/*background-color: red;*/ padding: 0px;">
		<div class="row">
			<div class="col-12">
				<img src="{{ asset('images/pub/imgPub1.jpg') }}" alt="Pub" style="width:100%; height: 500px;">
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


</div> <!-- Fin container-fluid -->

<script type="text/javascript">
	horloge(); APIclientAppel(); getLocation(); IPEsp8266();
</script>

	@endsection
<!-- 	
</body>
</html> -->










<!-- AT+SGNSPWR=1 ERROR -->
