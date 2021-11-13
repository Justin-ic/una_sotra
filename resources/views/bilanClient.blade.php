@extends('layouts.app')

@section('contenu')
<?php use Illuminate\Support\Carbon; ?>
<div class="row d-flex justify-content-center align-items-center">
    <div class="col-12 col-md-9">

<!--   
created_at nom prénom NCE services_id ticket  etat ->  Principal      

service demande  nbClientAvant tAttenteEstime tAttenteMis -> Détails
-->

<div class="table-responsive">
    <h1 class="MCenter">Le BILAN des étudiants</h1>
    <table class="table table-bordered table-striped">
        <thead>
            <tr class="MCenter">
                <th>N°</th>
                <th>Le</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>NCE</th>
                <th>Service</th>
                <th>Ticket</th>
                <th>Etat</th>
                <th>Action</th>
            </tr>
        </thead>   
<!--         <pre>
<?php  ?></pre> -->
        <tbody>
            <?php $i=1; if ($liste->count() > 0):  if (isset($_GET['page'])) { $i=$_GET['page']*5 - 4;} ?>
                <?php foreach ($liste as $bilant): /*dd($Le_guichet->service);*/ ?>
            <tr  class="MCenter">
                <td><?=$i++ ?></td>
                <td>{{$bilant->created_at->format('d/m/Y')}}</td>
                <td>{{$bilant->etudiant->nom}}</td>
                <td>{{$bilant->etudiant->prenom}}</td>
                <td>{{$bilant->etudiant->nce}}</td>
                <td>{{$bilant->service->nom}}</td>
                <td>{{$bilant->ticket}}</td>
                <?php if ($bilant->etat == 1) {  
                  ?>  <td><span class="fas fa-check-circle faServit"></span></td>  <?php   
                } else {
                  ?>  <td><span class="fas fa-times-circle faNonServit"></span></td>  <?php   
                }
                ?>

                <td>
                    <?php 
                        $LeDetail[0] = $bilant->service->nom;
                        $LeDetail[1] = $bilant->demande;
                        $LeDetail[2] = $bilant->nbClientAvant;
                        $LeDetail[3] = $bilant->tAttenteEstime;


/************************* Temps service ******************************/
        $timeDebut = $bilant->debutService;
        $timeFin = $bilant->finService;
        $secondsDebut = strtotime("1970-01-01 $timeDebut UTC"); /*conversion en sécondes*/
        $secondsFin = strtotime("1970-01-01 $timeFin UTC");

        $TempsServiceSec = $secondsFin-$secondsDebut;
        // echo $TempsServiceSec;

        $TempsServiceH = ConvertisseurTime($TempsServiceSec);
/************************* Temps service ******************************/

/************************* Temps Séjour ******************************/
        $DebutSejour = $bilant->created_at->format("H:m:i");
        $FinSejour = $bilant->finService;
        $DebutSec = strtotime("1970-01-01 $DebutSejour UTC"); /*conversion en sécondes*/
        $FinSec = strtotime("1970-01-01 $FinSejour UTC");

        $TempsSejourS = ($FinSec-$DebutSec);
        /*echo ' xxx'.$DebutSejour.' **'.$FinSejour.'xxx ';
        echo $TempsSejourS;*/

        $TempsSejourH = ConvertisseurTime($TempsSejourS);
/************************* Temps Séjour ******************************/


                        if ($TempsServiceSec == 0) {
                            $LeDetail[4] = "NAN";
                            $LeDetail[5] = "NAN";
                        } else {
                           $LeDetail[4] = $TempsServiceH;
                           $LeDetail[5] = $TempsSejourH;
                        }
                        
                        

// echo $secondsDebut.'  '.$secondsFin;


                        $nomPrenom = $bilant->etudiant->nom.' '.$bilant->etudiant->prenom;
                        $nomPrenom = str_replace("'", " ", $nomPrenom);
                        // echo $nomPrenom;
                     ?>
                    <button onclick='AfficheTitre(<?php print_r( json_encode($nomPrenom)); ?>), afficheModale(<?php echo json_encode($LeDetail); ?>)' class="btn btn-success modif_sup" data-bs-toggle="modal" data-bs-target="#exampleModal">Détails <span class="fas fa-edit"></span> </button>

                  <!--   <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                          Launch demo modal
                      </button> -->
                    
                </td>


            </tr> 
                <?php endforeach ?> 
            <?php endif ?>
<!-- lettre_guichet
service_id
personnel_id -->


        </tbody>
        
        <tfoot  class="MCenter">
            <tr class="MCenter">
                <th>N°</th>
                <th>Le</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>NCE</th>
                <th>Service</th>
                <th>Ticket</th>
                <th>Etat</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>

</div>

    </div> <!-- fin  -->
</div> <!-- fin row -->


<div class="d-flex justify-content-center">
    {{$liste->links()}}   
</div>


<script type="text/javascript">
    // !!!!!!!!!!!!!!!!!!!    REMPLISSAGE DU TABLEAU   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

function afficheModale(LeDetail){

// service demande  nbClientAvant tAttenteEstime tAttenteMis -> Détails
// alert('Je suis la');
console.log('Je commence');
console.log(LeDetail);
var TrTd ='';
            var str = 'welcom_to_waytolearnx.com';
            var str = str.replace(/_/g, "-");

TrTd +='      <tr  class="MCenter"  id="tr">';
TrTd +="                <td>" +LeDetail[0]+ "</td>";
TrTd +="                <td>" +LeDetail[1]+ "</td>";
TrTd +="                <td>" +LeDetail[2]+ "</td>";
TrTd +="                <td>" +LeDetail[3]+ "</td>";
TrTd +="                <td>" +LeDetail[4]+ "</td>";
TrTd +="                <td>" +LeDetail[5]+ "</td>";

TrTd +="       </tr>";
TrTd +='';
TrTd +='';

    console.log(TrTd);

document.getElementById('ModalTbody').innerHTML = TrTd;

} // Fin function


function AfficheTitre(nomPrenom){
    console.log("dddddddddddddddddddddddddd");
document.getElementById('NomPrenom').innerHTML = nomPrenom;
}

// !!!!!!!!!!!!!!!!!!!    REMPLISSAGE DU TABLEAU   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
</script>



<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header ">
        <h1 class="modal-title " id="exampleModalLabel">
            Bilan de <span id="NomPrenom"></span>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body modal-dialog modal-dialog-scrollable" id="modal-body">
       

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr class="MCenter">
                <th>Service</th>
                <th>Détails</th>
                <th>Nb Client Avant</th>
                <th>Temps Attente prévu</th>
                <th>Temps Service</th>
                <th>Temps de séjour</th>
            </tr>
        </thead> 
        <!-- // service demande  nbClientAvant tAttenteEstime tAttenteMis -> Détails -->
  
<!--         <pre>
<?php  ?></pre> -->
        <tbody id="ModalTbody">

            <tr class="MCenter">
                <td>{{$bilant->service->nom}}</td>
                <td>{{$bilant->demande}}</td>
                <td>{{$bilant->nbClientAvant}}</td>
                <td>{{$bilant->tAttenteEstime}}</td>
                <td>{{$bilant->tAttenteEstime}}</td>
            </tr> 
<!-- 
lettre_guichet
service_id
personnel_id 
-->


        </tbody>
    </table>

</div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<?php 

     function ConvertisseurTime($Time){
     if($Time < 3600){ 
       $heures = 0; 
       
       if($Time < 60){$minutes = 0;} 
       else{$minutes = round($Time / 60);} 
       
       $secondes = floor($Time % 60); 
       } 
       else{ 
       $heures = round($Time / 3600); 
       $secondes = round($Time % 3600); 
       $minutes = floor($secondes / 60); 
       } 
       
       $secondes2 = round($secondes % 60); 
       $minutes = ($minutes<10) ? "0".$minutes : $minutes ;
       $secondes2 = ($secondes2<10) ? "0".$secondes2 : $secondes2 ;
      
       $TimeFinal = "$heures".":"."$minutes".":"."$secondes2"; 
       return $TimeFinal; 
    }
 ?>
<!-- 
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
 -->



<!-- <br>
<span>
    $liste->links()
</span>
<style >
svg.w-5 {
    vertical-align: middle;
    width: 30px;
    display: inline;
}
</style>
<br><br> -->

@endsection