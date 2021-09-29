@extends('layouts.app')

@section('contenu')

<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCYV20HH1FvJ0MOASehxOx0DsJ9IWrnFPg&callback=initMap">
</script>

<script type="text/javascript">

// Rechargement de la page après chaque 7s
/*
setTimeout(function () {
    initialize();
        location.href="AdminVewClientLocation";  
    }, 60000);*/



/*
LE LIEN POUR CREER MA CLE Googne Maps API

https://console.cloud.google.com/apis/dashboard

*/

// xxxxxxxxxxxxxxxxxxxxxxxxxxxxx Affiche les marquers xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
var Donnees = new Array();
 // setInterval(function () {   ,X} // ecécute la fonction chaque X Millie sécondes. La première exécution est automatique après le chargement de la page

// setTimeout ecécute la fonction après chaque X Millie sécondes. c'est lui qu'on utilise car on a déja dépasser la balise body pour utiliser onloade= "NomFonction()"

/*setInterval(function () {   

    AfficheMarqueurs();
    // location.href="AdminVewClientLocation";  
}, 30000);*/

AfficheMarqueurs();

// ***********  Actualisation de la page REDIRECTION IMPECABLE **************************
redirection();
function redirection(){
    setTimeout(direction,60000);

// location.href="http://localhost/una_sotra/public/clientBienvenue";
}

function direction(){
    location.href="AdminVewClientLocation";
}
// ***********  Actualisation de la page REDIRECTION IMPECABLE **************************



function AfficheMarqueurs(){
        if (navigator.geolocation) {

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           // Typical action to be performed when the document is ready:
           var myArr = JSON.parse(this.responseText); /* Je transforme la réponse en array()*/
           var i=0;
           Donnees = myArr;

         google.maps.event.addDomListener('window','load',loadMap());
           }
        };
        url = "{{route('APIMarqueurs')}}";
        xhttp.open("GET",url , true);
        xhttp.send();

    } else {
        alert('Activer la géolocalisation s\'il vous plait !');
    }

}



function loadMap(){
    // alert('Je suis bien appelé!');
    var mapOptions={
    zoom: 19, // 0 à 21
    center: new google.maps.LatLng(5.387056402459017,-4.016037567213115), // centre de la carte
    mapTypeId: google.maps.MapTypeId.ROADMAP, // ROADMAP, SATELLITE, HYBRID, TERRAIN
    }
    var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
    setMarkers(map,Donnees);
}






/* CREATION D'UNE div QUI LE ID RECEMENT CREER  */
/*function creerDiv(leId) {
    let bloc = document.getElementById("reponseAPI");
    div = document.createElement('div');
    div.classList.add("row");
    div.classList.add("contourLigneAppel");
    div.id = leId;
    bloc.append(div);
}*/



function setMarkers(map,locations){
    // alert('Je suis dans marker');
    console.log(locations);
    for(var i=0; i<locations.length; i++){
        var client = locations[i];
        console.log(client[1]);
        var myLatLng = new google.maps.LatLng(client[0],client[1]);
        var infoWindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker ({
            position: myLatLng,
            map: map,
            icon: "{{ asset('images/marker.png') }}",
            animation: google.maps.Animation.DROP
        });
        (function(i){
            google.maps.event.addListener(marker, "click", function(){
                var info = locations[i];
                infoWindow.close();
                infoWindow.setContent("<div>"+info[2]+" "+info[3]+"<br />Ticket: "+info[4]+"</div>");
                infoWindow.open(map, this);
            });
        })(i);
    }
}







</script>

<div class="table-responsive">
    <h1 class="MCenter">La liste des guichets de l'entreprise</h1>
    <table class="table table-bordered">
        <thead>
            <tr class="MCenter">
                <th>N°</th>
                <th>clientId</th>
                <th>clientNumero</th>
                <th>clientTicket</th>
                <th>nom</th>
                <th>prenom</th>
                <th>genre</th>
                <th>clientLatitude</th>
                <th>clientLongitude</th>

                <!-- <th colspan="2">Action</th> -->
            </tr>
        </thead>
<!--         <pre>
<?php 

 ?></pre> -->
        <tbody>
            <?php /*dd($infosClients);*/ $i=1; if ($infosClients->count() > 0):  ?>
                <?php foreach ($infosClients as $infosClient):  ?>
            <tr  class="MCenter">
<!-- clientId clientNumero clientTicket nom prenom genre clientLatitude clientLongitude -->
                <td><?=$i++ ?></td>
                <td>{{$infosClient->clientId}}</td>
                <td>{{$infosClient->clientNumero}}</td>
                <td>{{$infosClient->clientTicket}}</td>
                <td>{{$infosClient->nom}}</td>
                <td>{{$infosClient->prenom}}</td>
                <td>{{$infosClient->genre}}</td>
                <td>{{$infosClient->clientLatitude}}</td>
                <td>{{$infosClient->clientLongitude}}</td>

<!--                     <a href="route('guichets.edit', $Le_guichet->id)}}"><button class="btn btn-success">Modifier <span class="fas fa-edit"></span> </button>
                    </a>
                </td>
                <td>
                    <a href="route('destroy_guichet',$Le_guichet->id)}}"><button class="btn btn-danger">Supprimer <span class="fas fa-times-circle"></button></a>
                </td> -->

            </tr> 
                <?php endforeach ?> 
            <?php endif ?>

        </tbody>
        
        <tfoot  class="MCenter">
        	<th>N°</th>
            <th>clientId</th>
            <th>clientNumero</th>
            <th>clientTicket</th>
            <th>nom</th>
            <th>prenom</th>
            <th>genre</th>
            <th>clientLatitude</th>
            <th>clientLongitude</th>
        	<!-- <th colspan="2">Action</th> -->
        </tfoot>
    </table>


</div>

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>





<div class="row d-flex justify-content-center">
    <div class="col-12">
        <div id="map_canvas" style="width: 100%; height: 500px;"></div>
    </div>
    
</div>
        










<br>
<span>
    <!-- $liste->links() -->
</span>
<style >
svg.w-5 {
    /*vertical-align: middle;*/
    width: 30px;
    display: inline;
}
</style>
<br><br>
@endsection   