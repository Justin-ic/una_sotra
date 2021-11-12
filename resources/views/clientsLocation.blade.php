@extends('layouts.app')

@section('contenu')

<!-- <button onclick="viderTableau()">xxxxx</button> -->
<!-- <button onclick="">AfficherTableau</button> -->

<div class="table-responsive" style="margin: 10px;">
    <h1 class="MCenter">La liste des étudiants en attente</h1>
    <table class="table table-bordered" id="MonTableau">
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
                <th>Distace</th>

                <!-- <th colspan="2">Action</th> -->
            </tr>
        </thead>
<!--         <pre>
<?php 
$i=0;
 ?></pre> -->

<!-- clientId clientNumero clientTicket nom prenom genre clientLatitude clientLongitude -->
 <!-- clientId clientNumero clientTicket nbClientAvant tAttenteEstime nom prenom genre clientLatitude clientLongitude -->

        <tbody id="Tbody">

            <tr  class="MCenter" id="tr">
                <td>a</td>
                <td>b</td>
                <td>c</td>
                <td>d</td>
                <td>e</td>
                <td>f</td>
                <td>g</td>
                <td>h</td>
                <td>i</td>

            </tr> 
            
            <tr  class="MCenter" id="tr">
                <td>a</td>
                <td>b</td>
                <td>c</td>
                <td>d</td>
                <td>e</td>
                <td>f</td>
                <td>g</td>
                <td>h</td>
                <td>i</td>

            </tr> 
            
            <tr  class="MCenter" id="tr">
                <td>a</td>
                <td>b</td>
                <td>c</td>
                <td>d</td>
                <td>e</td>
                <td>f</td>
                <td>g</td>
                <td>h</td>
                <td>i</td>

            </tr> 

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
            <th>Distace</th>
        	<!-- <th colspan="2">Action</th> -->
        </tfoot>
    </table>

</div>

<!-- <nav aria-label="Page navigation example">
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
</nav> -->



<br><br><br>

<div class="container-fluid">
    
    <div class="row d-flex justify-content-center">
        <div class="col-12 d-flex justify-content-center">
            <b style="font-size:25px;">L'AFFICHAGE GRAPHIQUE</b>
        </div>

    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-12">
            <div id="map_canvas" style="width: 100%; height: 500px;"></div>
        </div>

    </div>


</div>


<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCYV20HH1FvJ0MOASehxOx0DsJ9IWrnFPg&callback=initMap">
</script>

<!-- ********************** Client Location **************************************** -->
  <script type="text/javascript" src="{{  asset('styles/js/clientLocation.js')  }}"></script> 
<!-- ********************** Client Location **************************************** -->


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