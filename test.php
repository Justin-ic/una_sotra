 <?php

// votre API Access Key
= "XXXXXXX";

// URL du getLocation
= "http://run.orangeapi.com/location/getLocation.xml";

// URL du getAuthorization
= "http://run.orangeapi.com/location/createAuthorization.xml";

// le numéro du téléphone que vous souhaitez localiser (au format international)
= "336XXXXXXXX";

// executer la demande > trouver la localisation
= file_get_contents( . "?id=" . . "&number=" . $number);

// récupérer le message de réponse état de l'appel API
=simplexml_load_string();
if (->status->status_code = 450)

// exécuter la demande de l'API
= file_get_contents( . "?id=" . . "&number=" . );

// obtenir et afficher le message de réponse d'état de l'appel d'API
=simplexml_load_string();
echo(->status->status_code . " - " . ->status->status_msg . "<br />");
echo "S'il vous plaît, suivez les instructions reçues par SMS et de relancer le script";

else
echo("Code de retour : " . ->status->status_code . " - " . ->status->status_msg . "<br />");
echo("Coordonnées : " . ->location->X . " - " . ->location->Y);

 

?>



<?php
$phone_number = '2250777762144';
$text_message = urlencode("Hello world, sent with Orange API in PHP !");
$api_access_key = 'a1234b56789';
$url = "http://sms.beta.orange-api.net/sms/sendSMS.xml?id=$api_access_key&amp;to=$phone_number&amp;content=$text_message";
$response = file_get_contents($url);
$xml = simplexml_load_string($response);
echo "Status: ",$xml->status->status_msg;
?>







<?php 

    //date_diff nous donne maintenant des valeurs sur les représentations ci-dessus
// $today->format("Y-m-d H:i:s"); // OK
 $date = date("Y-m-d H:i:s");

 $dd = '2010-07-11 30:11:19';
 // $dd->format("m ([ .\t-])* dd [,.stndrh\t ]+ y");
 
echo '<br><br> nouveau format:=';
 echo $dd;
 echo $date;
 
/*    $interval = date_diff('2010-07-11 30:11:19', '2010-07-11 20:11:19');
    
    //on récupère les valeurs d'$interval qui nous intéresse
    $y=$interval->y;//années
    $m=$interval->m;//mois
    $d=$interval->d;//jours
    $h=$interval->h;//heures
    $i=$interval->i;//minutes
    $s=$interval->s;//secondes*/




 ?>
 <script type="text/javascript" src="https://localhost/una_sotra/public/styles/js/jquery3.4.1.js"></script>


 <script type="text/javascript">
 
    // $interval = date_diff('2010-07-11 30:11:19', '2010-07-11 20:11:19');
    
    // //on récupère les valeurs d'$interval qui nous intéresse
    // $y=$interval->y;//années
    // $m=$interval->m;//mois
    // $d=$interval->d;//jours
    // $h=$interval->h;//heures
    // $i=$interval->i;//minutes
    // $s=$interval->s;//secondes


/*ld = new Date('February 5, 2001 23:15:00');
jour = ld.getDate();
getHours = ld.getHours();
getMinutes = ld.getMinutes();
getSeconds = ld.getSeconds();
alert( 'jour '+jour+  ' getHours '+getHours+  ' getMinutes '+getMinutes+  ' getSeconds '+ getSeconds);

*/
   
/*var date_actuelle = new Date();
alert(date_actuelle);
*/



/*

OK OK OK OK 
function formatDate(){
  let date_ob = new Date();

// adjust 0 before single digit date
let date = ("0" + date_ob.getDate()).slice(-2);

// current month
let month = ("0" + (date_ob.getMonth() + 1)).slice(-2);

// current year
let year = date_ob.getFullYear();

// current hours
let hours = date_ob.getHours();

// current minutes
let minutes = date_ob.getMinutes();

// current seconds
let seconds = date_ob.getSeconds();

// prints date & time in YYYY-MM-DD HH:MM:SS format
// dateTime = console.log(year + "-" + month + "-" + date + " " + hours + ":" + minutes + ":" + seconds);
dateTime = year + "-" + month + "-" + date + " " + hours + ":" + minutes + ":" + seconds;

return dateTime;
}






*/


/* OK  OK OK
var upgradeTime = 172801;
var seconds = upgradeTime;
function timer() {
  var days        = Math.floor(seconds/24/60/60);
  var hoursLeft   = Math.floor((seconds) - (days*86400));
  var hours       = Math.floor(hoursLeft/3600);
  var minutesLeft = Math.floor((hoursLeft) - (hours*3600));
  var minutes     = Math.floor(minutesLeft/60);
  var remainingSeconds = seconds % 60;
  function pad(n) {
    return (n < 10 ? "0" + n : n);
  }
  document.getElementById('countdown').innerHTML = pad(days) + ":" + pad(hours) + ":" + pad(minutes) + ":" + pad(remainingSeconds);
  if (seconds == 0) {
    clearInterval(countdownTimer);
    document.getElementById('countdown').innerHTML = "Completed";
  } else {
    seconds--;
  }
}
var countdownTimer = setInterval('timer()', 1000);
*/


date = '00'

alert('aiiiiii');




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


laDistance2 = distance(59.3293371,13.4877472 , 59.3225525,13.4619422);
console.log(laDistance2);

 </script>

 <body>



<?php 

echo 'xxxxxxx=='.(strtotime('01:00:00') - 1632952800).'===xxxxx';

$datetimex = new DateTime('2010-07-11 20:11:19'); // Date dans le passé

$datetime2 = new DateTime(date("Y-m-d H:i:s"));   // Date du jour (2018-09-07 16:10:21)
/*$interval = $datetime1->diff($datetime2);
$laDate =  $interval->y.'-'.$interval->m.'-'.$interval->d.' '.$interval->h.':'.$interval->i.':'.$interval->s;*/
echo '<br><br> ladate=';
print_r( $datetime2);
echo '<br><br>datetime1=';
 ?>


    <div>Registration closes in <span id="time">05:00</span> minutes!</div>
<span id="countdown" class="timer"></span>
     
</body>


<!-- laravel data set -->



<!-- 
ORGANISATION TEMPLATE

TABLEAU
file:///C:/xampp/htdocs/Template/startbootstrap-sb-admin-2-gh-pages/startbootstrap-sb-admin-2-gh-pages/tables.html

LOGIN
file:///C:/xampp/htdocs/Template/startbootstrap-sb-admin-2-gh-pages/startbootstrap-sb-admin-2-gh-pages/login.html

CONNEXION ADMIN
file:///C:/xampp/htdocs/Template/startbootstrap-sb-admin-2-gh-pages/startbootstrap-sb-admin-2-gh-pages/register.html


PAGE 404
file:///C:/xampp/htdocs/Template/startbootstrap-sb-admin-2-gh-pages/startbootstrap-sb-admin-2-gh-pages/404.html





























 -->





\textbf{GSM} : \textit{\textbf{G}bject de \textbf{S}anagement \textbf{M}roup} \\

\textbf{GPS} : \textit{\textbf{G} \textbf{P} \textbf{S}} \\

\textbf{SIM} : \textit{\textbf{S}  \textbf{I} \textbf{M}} \\

\textbf{Firmware} : xxxxx \\

\textbf{GPIO} : \textit{\textbf{G}eneral  \textbf{P}urpose \textbf{I}nput/\textbf{O}utput }  \\ 


\textbf{FCFS} : \textit{\textbf{F}irst  \textbf{C}ome, \textbf{F}irst \textbf{S}erved } \\

\textbf{FIFO} : \textit{\textbf{F}irst  \textbf{I}n \textbf{F}irst \textbf{O}ut} \\

\textbf{LCFS} : \textit{\textbf{L}ast  \textbf{C}ome, \textbf{F}irst \textbf{S}erved } \\

\textbf{LIFO} : \textit{\textbf{L}ast  \textbf{I}n \textbf{F}irst \textbf{O}ut } \\

\textbf{EEPROM} : \textit{\textbf{E}lectrically-\textbf{E}rasable \textbf{P}rogrammable \textbf{R}ead-\textbf{O}nly \textbf{M}emory } \\

\textbf{PWM} : \textit{\textbf{P}ulse  \textbf{W}Width \textbf{M}Modulation } \\


FCFS: First Come, First Served\\

FIFO : First In, First Out\\

LCFS : Last Come, First Served\\

LIFO : Last In, First Out.\\

EEPROM : Electrically-Erasable Programmable Read-Only Memory\\

PWM : Pulse Width Modulation.\\
















<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="{{ asset('styles/bootstrap/bootstrap.min.css') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.png') }}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('styles/style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('styles/fontawesome/css/all.css') }}">
  <title>una_scolarite</title>

<!--  <script type="text/javascript">
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
  @include('inclusions.header')
<!--  <label for="exampleColorInput" class="form-label">Color picker</label>
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





  @yield('contenu')



  @include('inclusions.footer')
  <!-- popper pour dropdown et doit être placer avant les bootstraps.js-->
  <script type="text/javascript" src="{{  asset('styles/js/popper.min.js')  }}"></script> 
  <script type="text/javascript" src="{{  asset('styles/js/jquery3.4.1.js')  }}"></script>
  <script type="text/javascript" src="{{  asset('styles/js/bootstrap.min.js')  }}"></script>


</body>
</html>



Obtuni **************************************



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

  <title>una_scolarite</title>



<!--  <script type="text/javascript">
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


  @include('inclusions.header2')



<!--  <label for="exampleColorInput" class="form-label">Color picker</label>
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





  @yield('contenu')



  @include('inclusions.footer')

  <!-- popper pour dropdown et doit être placer avant les bootstraps.js-->

  <script type="text/javascript" src="{{  asset('styles/js/popper.min.js')  }}"></script> 
  <script type="text/javascript" src="{{  asset('styles/js/jquery3.4.1.js')  }}"></script>
  <script type="text/javascript" src="{{  asset('styles/js/bootstrap.min.js')  }}"></script>


<!-- ********************** Client Appel **************************************** -->
  <script type="text/javascript" src="{{  asset('styles/js/TweenMax.min.js')  }}"></script> 
  <script type="text/javascript" src="{{  asset('styles/js/clientAppel.js')  }}"></script> 
<!-- ********************** Client Appel **************************************** -->

  
<!-- ********************** Client Demande **************************************** -->
  <script type="text/javascript" src="{{  asset('styles/bootstrap/bootstrap.bundle.min.js')  }}"></script>
<!-- ********************** Client Demande **************************************** -->


  
<!-- ********************** Client info File **************************************** -->
  <script type="text/javascript" src="{{  asset('styles/js/clientInfoFile.js')  }}"></script> 
<!-- ********************** Client info File **************************************** -->

  
<!-- ********************** Client Location **************************************** -->
  <script type="text/javascript" src="{{  asset('styles/js/clientLocation.js')  }}"></script> 
<!-- ********************** Client Location **************************************** -->

  
<!-- ********************** Client Location **************************************** -->
  <script type="text/javascript" src="{{  asset('styles/js/interfaceGuichetPersonnel.js')  }}"></script> 
<!-- ********************** Client Location **************************************** -->


  
<!-- ********************** Client Ticket **************************************** -->
  <!-- popper pour dropdown et doit être placer avant les bootstraps.js-->
  <script type="text/javascript" src="{{  asset('styles/js/clientTicket.js')  }}"></script> 

<!-- ********************** Client Ticket **************************************** -->


</body>
</html>



@extends('layouts.app')

@section('contenu')


@endsection