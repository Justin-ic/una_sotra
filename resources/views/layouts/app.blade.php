<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/bootstrap/bootstrap.min.css') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/fontawesome/css/all.css') }}">

  <link rel="stylesheet" type="text/css" href="{{ asset('images/styleBienvenue.css') }}">
  
  <!-- Matérial designe -->
  <!-- <link rel="stylesheet" href="{{  asset('styles/MDB5/ css/mdb.min.css')  }}" /> -->


	<title>una_scolarite</title>

<!-- 	<script type="text/javascript">
function horloge()
{
        var tt = new Date().toLocaleTimeString();// hh:mm:ss
        
        document.getElementById("timer").innerHTML = tt;
        setTimeout(horloge, 1000); // mise à jour du contenu "timer" toutes les secondes
}
</script>  -->

</head>
<!-- <body onload="horloge()"> -->
<body>

<!-- <?php if (isset($_SESSION['sessionClient'])): ?>
  include('inclusions.header2')
<?php else: ?>
  
<?php endif ?> -->

@include('inclusions.header')

<!-- 	<label for="exampleColorInput" class="form-label">Color picker</label>
	<input type="color" class="form-control form-control-color" id="exampleColorInput" value="#563d7c" title="Choose your color"> <mark>math_tipe à ajouter sur le word</mark>

 -->




<!-- 

<br><br><br>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
  <label class="form-check-label" for="flexSwitchCheckDefault">Default switch checkbox input</label>
</div>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
  <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label>
</div>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="flexSwitchCheckDisabled" disabled>
  <label class="form-check-label" for="flexSwitchCheckDisabled">Disabled switch checkbox input</label>
</div>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="flexSwitchCheckCheckedDisabled" checked disabled>
  <label class="form-check-label" for="flexSwitchCheckCheckedDisabled">Disabled checked switch checkbox input</label>
</div>

 -->



<!-- nnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn -->


<!-- <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    Dropdown button
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    <li><a class="dropdown-item" href="#">Action</a></li>
    <li><a class="dropdown-item" href="#">Another action</a></li>
    <li><a class="dropdown-item" href="#">Something else here</a></li>
  </ul>
</div>
 -->


<!-- nnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn -->





<div class="container-fluid">
    @yield('contenu')
</div>



	@include('inclusions.footer')


  <!-- popper pour dropdown et doit être placer avant les bootstraps.js-->


  
<!-- ********************** Matérial designe**************************************** -->
    <!-- <script type="text/javascript" src="{{  asset('styles/MDB5/js/mdb.min.js')  }}"></script> -->
<!-- ********************** Matérial designe **************************************** -->

  <script type="text/javascript" src="{{  asset('styles/js/popper.min.js')  }}"></script> 
  <script type="text/javascript" src="{{  asset('styles/js/jquery3.4.1.js')  }}"></script>
  <script type="text/javascript" src="{{  asset('styles/js/bootstrap.min.js')  }}"></script>


<!-- ********************** Client Appel **************************************** -->
  <script type="text/javascript" src="{{  asset('styles/js/TweenMax.min.js')  }}"></script> 
<!-- ********************** Client Appel **************************************** -->

  
<!-- ********************** Client Demande **************************************** -->
  <script type="text/javascript" src="{{  asset('styles/bootstrap/bootstrap.bundle.min.js')  }}"></script>
<!-- ********************** Client Demande **************************************** -->

  
<!-- ********************** Client info File **************************************** -->
<!-- ********************** Client info File **************************************** -->


  
<!-- ********************** Client Ticket **************************************** -->

<!-- ********************** Client Ticket **************************************** -->




</body>
</html>