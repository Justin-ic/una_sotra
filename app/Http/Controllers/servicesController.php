<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\service;
use App\Models\etudiant;
use App\Models\bilanEtudiant;

class servicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $liste = service::paginate(5);
                
        return view('services', compact('liste'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('formulaires.services_creer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'nom' => 'required'
        ]);

        $s = service::where('nom', '=', $request->nom)->first();
        // dd($s);
        if ($s != null) {
            return view('formulaires.services_creer');
        } else {
            service::create([
                'nom' => $request->nom
            ]);
            $message = "Créer avec succsès!";
            return redirect()->route('services.index')->with('message');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $le_service = service::findOrFail($id);  
      // OrFail: Il cherche le client; s'il ne le retrouve pas, il renvoie un 404.

      return view('detail_service',compact('le_service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = service::findOrFail($id);

        return view('formulaires.services_modif',compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'nom' => 'required'
        ]);

        $s = service::where('nom', $request->nom)->first();
        // dd($s);
        if ($s != null) {
            $service = service::findOrFail($id);
            return view('formulaires.services_modif', compact('service'));
        } else {
            $service = service::findOrFail($id);
            $service->update([
                'nom' => $request->nom
            ]);
            $message = "Modifier avec succsès!";
            return redirect()->route('services.index')->with('message');
        }

// math_tipe à ajouter sur le word


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = service::find($id)->delete();
        return redirect()->route('services.index')->with('message');
    }



/************************** Les Méthodes spécifiques ***********************************/

    /**
     * retourne la liste des services pour la vue clientBienvenue.
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function ListeService($idEtu)
    {
        $liste = service::all(); /*Je transporte l'idEtudiant*/
        // dd($etudiant);
        return view('clientDemande', compact('liste','idEtu'));
    }






    public function ConvertisseurTime($Time){
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
      
       $TimeFinal = "$heures".":"."$minutes".":"."$secondes2"; 
       return $TimeFinal; 
    }


    /**
     * Retourne le services et la liste des descriptions 
     * qui lui sont associer pour la vue autoEnregistreClient.
     * 
     * 
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function LeServiceDemander($idService,$idEtu)
    {

        $LeService = service::with('descriptions')->find($idService);
        $LeGuichet = service::with('guichet')->find($idService);
// dd($LeGuichet);
// dd($LeGuichet->guichet->lettre_guichet); // guichet est le nom de la relation

        $nomGuichet = $LeGuichet->guichet->lettre_guichet;
        // Nétoyage
            $nomGuichet = preg_replace("#^[\t\f\v ]+|[\t\f\v ]+$#m",'',$nomGuichet);
        // dd($nomGuichet); nomGuichet Corrigé avec succès
        $dd = date("Y-m-d");



        $etuExiste = bilanEtudiant::where('etudiants_id','=',$idEtu)
                     ->where('ticket', 'like', $nomGuichet.'-%')
                     ->where('created_at', '>', $dd.' 00:00:00')
                     ->where('etat', '=', 0)
                     ->first();
        if ($etuExiste != NULL) {
            return back()->withErrors('Vous êtes déjà dans cette file. Pour revoir votre rang, utilisez la deuxième option.');
        }


// on veut recupérer la liste  client en fonction du guichet qui est parqué par le nom du ticket
/*!!!!!!!!!!!!!!!!!!!!!!! clients du jour par guichet pour former le ticket !!!!!!!!!!!!!!!!!!!!!!!!!!!!*/

       $listeClientJour = bilanEtudiant::with('etudiant')
                  ->where('ticket', 'like', $nomGuichet.'-%')
                  ->where('created_at', '>', $dd.' 00:00:00')
                  ->get();
// dd(count($listeClientJour));
/*!!!!!!!!!!!!!!!!!!!!!!! clients du jour par guichet pour former le ticket !!!!!!!!!!!!!!!!!!!!!!!!!!!!*/



/*!!!!!!!!!!!!!!!!!!!! clients non servit du jour guichet !!!!!!!!!!!!!!!!!!*/

/*       $listeClientAvant = etudiant::whereHas(
        'bilanEtudiants' , function($query) use ($nomGuichet,$dd) {
            $query->where('ticket', 'like', $nomGuichet.'-%')
                  ->where('created_at', '>', $dd.' 00:00:00')
                  ->where('etat', '=', 0);
        })->with('bilanEtudiants')->get();*/

       $listeClientAvant = bilanEtudiant::with('etudiant')
                  ->where('ticket', 'like', $nomGuichet.'-%')
                  ->where('created_at', '>', $dd.' 00:00:00')
                  ->where('etat', '=', 0)
                  ->get();
// dd(count($listeClientAvant));
/*!!!!!!!!!!!!!!!!!!!!!!!! clients non servit du jour guichet !!!!!!!!!!!!!!!!!!!!!!!!!!!**/
/*echo 'nomGuichet=='.$nomGuichet.'==';
echo 'Nb Clients avant '.count($listeClientAvant);
echo ' Nb Clients listeClientJour '.count($listeClientJour) ;
        dd($listeClientAvant);*/
        $nbClientAvant = count($listeClientAvant);
        $nbClientDuJour = count($listeClientJour);
// dd($nbClientAvant);



/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
$tmoyen=30*60; // Le temps moyen est défini ici à 30 minutes. aussi dans clientsControleur
// $timm = ConvertisseurTime($nbClientAvant*$tmoyen);

/* Si heur actuel + tempsAttenteEstime > 16h30 On dit désolé la file est plainne, repasser demain*/

$localTime = localtime();
$heurActu = $localTime[2].":".$localTime[1].":".$localTime[0];

$heurActuSeconde = $localTime[2]*60*60 + $localTime[1]*60 + $localTime[0];

$TimeAttenEstim = $nbClientAvant*$tmoyen;


$TimeDebutService = $heurActuSeconde + $TimeAttenEstim; /* Heure à laquelle son tour arrivera */

// $finServicePersonnel = 16*60*60 + 30*60; /* Heure ouvrable: matin=7h30 le soire 16h30 */
$finServicePersonnel = 23*60*60 + 30*60; /* Heure ouvrable: matin=7h30 le soire 16h30 */

if ($TimeDebutService > $finServicePersonnel) {
    return back()->withErrors('Désolé ! Cette file est déjà plainne pour aujourd\'hui. Repasser demain !');
    // dd('Désolé ! Cette file est plainne. Repasser demain !');
}
/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/




$Time = $heurActuSeconde + $TimeAttenEstim;
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
      
      if ($heures==0) {
          $heures ="00";
      } 
      if ($minutes < 10) {
           $minutes = "0".$minutes;
       }

      if ($secondes2 < 10) {
           $secondes2 = "0".$secondes2;
       } 
      
       $TimeFinal = "$heures".":"."$minutes".":"."$secondes2";
// dd($TimeFinal);
 
        $etudiant = etudiant::find($idEtu);
        return view('autoEnregistreClient', compact('LeService','nbClientAvant', 'nbClientDuJour','nomGuichet','etudiant'));
    }



/************************** Les fonctions spécifiques ***********************************/

}



