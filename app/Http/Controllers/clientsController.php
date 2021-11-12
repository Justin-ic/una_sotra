<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; // pour utiliser les requêtes personnalisées
use Illuminate\Http\Request;
use App\Models\etudiant;
// use App\Models\descriptions;
use App\Models\service;
use App\Models\bilanEtudiant;
use App\Models\guichet;
// use App\Models\personnels;
use App\Models\clientsLocation;



/*header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST ,OPTIONS, PUT');
header("Access-Control-Allow-Headers: Origin, http://localhost/una_sotra/public/APIclientAppel, Content-Type, Accept");
*/

class clientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        // toArray() permet de transformer a en un tableau. mais pas intéressant car on ne poura pas utiliser les méthodes dessus.
        // $liste = etudiant::with('service')->get()->toArray();

        // le with() permet de lier la table de relation
        // 
        $liste = etudiant::with('bilanEtudiants')->get();
        $liste = etudiant::latest()->simplePaginate(5);
        // DB::table('users')->orderBy('id')->cursorPaginate(15);
        
        // $liste = etudiant::latest()->cursorPaginate(5);

        // $liste = etudiant::all(); //  IDEME
        // $liste = DB::table('etudiant')->get(); // IDEME
        // dd( $liste->find(2) );
        // dd( $liste );


// nom     numero  commentaire     service     created_at  updated_at  
                
        return view('home', compact('liste'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listeService = service::all();
        return view('formulaires.clients_creer', compact('listeService'));
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
            'nom' => 'required',
            'prenom' => 'required',
            'genre' => 'required',
            'nce' => 'required',
            'dateNaissance' => 'required',
            'numero' => 'required'
        ]);


        etudiant::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'genre' => $request->genre,
            'numero' => $request->numero,
            'nce' => $request->nce,
            'dateNaissance' => $request->dateNaissance
        ]);
        $message = "Créer avec succsès!";
        return redirect()->route('clients.index')->with('message');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $le_client = etudiant::findOrFail($id);  
      // OrFail: Il cherche le client; s'il ne le retrouve pas, il renvoie un 404.

      return view('detail_client',compact('le_client'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $retVal = (condition) ? a : b ;
        $listeService = service::all(); // Liste de tous les services pour le formulaire
        $client = etudiant::with('service')->find($id);
        // with('service'): service est la méthode service() du model
        // dd($listeService->find(1)->nom);
        return view('formulaires.clients_modif',compact('listeService','client'));
        
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
            'nom' => 'required',
            'prenom' => 'required',
            'genre' => 'required',
            'numero' => 'required',
            'nce' => 'required',
            'dateNaissance' => 'required'
        ]);
// <!-- nom     prenom  genre   numero  nce     dateNaissance -->

        $client = etudiant::find($request->id);
        $client->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'genre' => $request->genre,
            'numero' => $request->numero,
            'nce' => $request->nce,
            'dateNaissance' => $request->dateNaissance
        ]);
        $message = "Modifier avec succsès!";
        return redirect()->route('clients.index')->with('message');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $client = etudiant::find($id)->delete();
        return redirect()->route('clients.index')->with('message');
    }



    // ****************************************************************************
    /**
     * Affiche la liste des clients déjà servie.
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function client_servit()
    {
        return view('clientServit');
    }

 

    /**
     * Affiche la liste des clients déjà servie.
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function clientSuivant(Request $request, $id)
    {

// dd($request->numeroClintSuivant);
        $finService = date('H:m:s');
        request()->validate([
            // 'commentaireserveur' => 'required', //pas obligatoire
            'debutService' => 'required',
            'numeroClintSuivant' => 'required'
            // 'finService' => 'required'
        ]);

        
        $client = bilanEtudiant::where('etudiants_id', '=', $id);
        $client->update([
            'debutService' => $request->debutService,
            'finService' => $finService,
            'commentaire' => $request->commentaireserveur,
            'etat' => 1
        ]);

    //     services_id     ticket  tAttenteEstime  nbClientAvant   debutService    finService  commentaire     etat    etudiants_id    

/********************** UPDATE DE LA SALLE D'ATTENTE CLIENT **************************/
$liste = clientsLocation::all();
foreach ($liste as $ligne) {
    if ($ligne->clientId == $id) {
        $client = clientsLocation::where('clientId', '=', $id)->delete();
    } 
// pas de updadte. cette information nous servira à se souvenir de ce qu'on avait dit
    else {
        $client = clientsLocation::where('clientId', '=', $ligne->clientId)->first();
        // dd($client);
        $client->update([
            'nbClientAvant' => $ligne->nbClientAvant - 1
            // 'tAttenteEstime' => ($ligne->nbClientAvant - 1)*30*60 // Aussi dans autoEnregistreClient.blade
        ]);
    }
    
}

/********************** UPDATE DE LA SALLE D'ATTENTE CLIENT **************************/






        /* On écrit le numéro du client suivant*/
        if ($request->numeroClintSuivant != 0) {
            $fichier = fopen('temporaires/'.$request->nomGuichet.".txt", 'w+'); 
            fwrite($fichier, 'appel=false 
'.$request->ticket.'
'.$request->numeroClintSuivant);
            fclose($fichier);
        }
        $message = "Modifier avec succsès!";
    
        // dd("Impecable");
        return redirect()->route('interfaceGuichetPersonnel'); 

    }


    /**
     * Affiche la liste des clients déjà servie.
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function ClientsNonServie() /* $id = id du personnel pour sa photo et son nom*/
    {
        // dd($id);
        session_start();
        // dd($_SESSION['personnel']->id);
        $id = $_SESSION['personnel']->id;
        $LeGuichet = guichet::where('personnel_id', '=', $id)->first();

        $nomGuichet = str_replace(' ', '', $LeGuichet->lettre_guichet); 
// on trouvera le guichet en fonction du personne

        


        // dd($nomGuichet);

        // $nomGuichet = 'A';
        $dd = date("Y-m-d");

// RECUPERER TOUS LES CLIENTS ET LEURS TICKETS DONT LE NOM DU TICKET COMMENCE PAR A-


/******* ON RECUPERE LES CLIENTS ET LEUR TICKTE DONT LE NOM-TICKET COMMENCE PAR A-non servit ***/
$ClientsNonServie = bilanEtudiant::with('etudiant')
                  ->where('ticket', 'like', $nomGuichet.'-%')
                  ->where('created_at', '>', $dd.' 00:00:00')
                  ->where('etat', '=', 0)
                  ->get();

/*       $ClientsNonServie = etudiant::whereHas(
        'bilanEtudiants' , function($query) use ($nomGuichet) {
            $query->where('ticket', 'like', ''.$nomGuichet.'-%')
                  ->where('etat', '=', 0);
        })->where('created_at', '>', $dd.' 00:00:00')->with('bilanEtudiants')->get();*/
// dd($ClientsNonServie);
/****** ON RECUPERE LES CLIENTS ET LEUR TICKTE DONT LE NOM-TICKET COMMENCE PAR A- non servit *****/


/********** ON RECUPERE LES CLIENTS ET LEUR TICKTE DONT LE NOM-TICKET COMMENCE PAR A- servit ******/
$ClientsServie = bilanEtudiant::with('etudiant')
                  ->where('ticket', 'like', $nomGuichet.'-%')
                  ->where('created_at', '>', $dd.' 00:00:00')
                  ->where('etat', '=', 1)
                  ->get();

/*       $ClientsServie = etudiant::whereHas(
        'bilanEtudiants' , function($query) use ($nomGuichet) {
            $query->where('ticket', 'like', ''.$nomGuichet.'-%')
                  ->where('etat', '=', 1);
        })->where('created_at', '>', $dd.' 00:00:00')->with('bilanEtudiants')->get();*/

/********** ON RECUPERE LES CLIENTS ET LEUR TICKTE DONT LE NOM-TICKET COMMENCE PAR A- servit ******/


/************* ON RECUPERE LES CLIENTS ET LEUR TICKTE DONT LE NOM-TICKET COMMENCE PAR A- ******/
   /*    $lesClient = clients::with([
        'tickets' => function($query) use ($nomGuichet) {
            $query->where('ticket', 'like', ''.$nomGuichet.'-%');
        }])->where('created_at', '>', $dd.' 00:00:00');*/
//  AVEC CETTE METHODE, ON RECUPERE LES CLIENTS DONT LE TICKET EST PRECISER ET CEUX DONT LE TICKET N'EST PAS PRECISER AUSSI
/************* ON RECUPERE LES CLIENTS ET LEUR TICKTE DONT LE NOM-TICKET COMMENCE PAR A- ******/


// dd($lesClient->get()); POURQUOI ???????????????????????????????????????????????
  /*      $lesClientGarde = $lesClient;
       $ClientsNonServie = $lesClient->where('servit', '=', 0)->get(); Qui ne sont pas servit
       $ClientsNonss = $lesClient->where('servit', '=', 1)->get(); Qui ne sont pas servit*/

// dd($ClientsNonServie[0]->etudiant->genre);

        if ( count($ClientsNonServie) == 0) {
             /*On a besoin des deux premiers*/

             $genre1 = "";
             $genre2 = "";
             $clientEnCours = null;
             $leClientSuivant = null;
        } else if ( count($ClientsNonServie) == 1){
                // code...
             /*On a besoin des deux premiers*/
             if ($ClientsNonServie[0]->etudiant->genre == 'H') {
                 $genre1 = "Mr.";
             } else {
                 $genre1 = "Mme";
             }

             $genre2 = "";
             $clientEnCours = $ClientsNonServie[0];
             $leClientSuivant = null;
        }else{
             /*On a besoin des deux premiers*/
             if ($ClientsNonServie[0]->etudiant->genre == 'H') {
                 $genre1 = "Mr.";
             } else {
                 $genre1 = "Mme";
             }

             if ($ClientsNonServie[1]->etudiant->genre == 'H') {
                 $genre2 = "Mr.";
             } else {
                 $genre2 = "Mme";
             }
             $clientEnCours = $ClientsNonServie[0];
             $leClientSuivant = $ClientsNonServie[1];
        }

        // ON EST SUR QU'UN CLIENT PEUT AVOIR PLUSIEURS TICKETS. MAIS LE MÊME JOUR, IL A UN ET UN SEUL TICKTE. ON PEUT DONC UTILISER first()

// dd($clientEnCours->tickets->first()->description);

       $nbClientAttent = count($ClientsNonServie);
       $nbClientServit = count($ClientsServie);
// dd($nbClientServit);
       /*
        les clients en attente
        les clients de la journée servi

        le nom du personnel connecté
       */


       // dd($leClientSuivant->ticket->description);
        return view('interfaceGuichetPersonnel', compact('clientEnCours', 'leClientSuivant', 'nbClientAttent', 'nbClientServit' , 'genre1','genre2'));
    }



    /**
     * Affiche la liste des clients déjà servie.
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function autoSotreClient(Request $request)
    {
        request()->validate([
            'choix' => 'required',
            /*'nom' => 'required',
            'prenom' => 'required',
            'genre' => 'required',
            'numero' => 'required',
            'nce' => 'required',*/

            'nomGuichet' => 'required',
            'tAttenteEstime' => 'required',
            'idEtu' => 'required',
            'nbClientAvant' => 'required'
        ]);



// *************************** CONTROLE DE DUPLICATION *******************
/*        $numExiste  = etudiant::where('numero', '=', $request->numero)->first();
        if ($numExiste != null) {
            ?> <script type="text/javascript"> 
                alert('Ce numéro a déjà un ticket ou vous vous êtes trompé! Veuillez reprendre SVP!');  
                </script> <?php
            //return redirect()->route('clientBienvenue');
            // return redirect()->route('clientBienvenue')->with('message' =>'Ce numéro a déjà un ticket ou vous vous êtes trompé!');
        }*/
        
// *************************** CONTROLE DE DUPLICATION *******************


/************** enregistrement du client *********************************/
// dd("j'arrive ici");
/*        etudiant::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'genre' => $request->genre,
            'numero' => $request->numero,
            'nce' => $request->nce,
            'servit' => 0
        ]);

$dernierclient = etudiant::latest()->first();*/
/************** enregistrement du client *********************************/



/************************** Création du ticket ******************/
    $description="";
    foreach ($request->choix as $detail) {
        $description = $description."; ".$detail;
    }
     $description = substr($description, 1); /* Enlève le premier caractère qui est ;*/
     $ticket = $request->nomGuichet.'-'.($request->nbClientDuJour+1);
     bilanEtudiant::create([
        'demande' => $description,
        'ticket' => $ticket,
        'tAttenteEstime' => $request->tAttenteEstime,
        'nbClientAvant' => $request->nbClientAvant,
        'etudiants_id' => $request->idEtu,
        'services_id' => $request->idServ,
        'etat' => "0"
    ]);


     // dd($dernierTicket);
// bilanEtudiant
 // demande     ticket  tAttenteEstime  nbClientAvant   debutService    finService  commentaire     etat    etudiants_id 
/************************** Création du ticket ******************/



//**************************** Stockage des infos pour la géolocalisation *********************
   $etudiant = etudiant::find($request->idEtu);

    if ($etudiant->genre == 'H') {
       $genre = "Mr.";
   } else {
       $genre = "Mme.";
   }
        clientsLocation::create([
            'clientId' => $etudiant->id, // Pour le update
            'clientNumero' => $etudiant->numero, // Pour reconnecte
            'clientTicket' => $ticket,  // Pour reconnecte et infos
            'nom' => $etudiant->nom,  // Pour infos
            'prenom' => $etudiant->prenom,  // Pour infos
            'genre' => $genre,  // Pour infos
            'nbClientAvant' => $request->nbClientAvant, // Pour infos. Sera mis à jours
            'tAttenteEstime' => $request->tAttenteEstime // Pour infos. Sera mis à jours
        ]);

//**************************** Stockage des infos pour la géolocalisation *********************


    // nom     prenom  genre   numero  nce     ticket_id   servit  created_at  updated_at 
/*    $nom = $request->nom; 
    $prenom = $request->prenom;  
    $nbClientAvant = $request->nbClientAvant; 
    $tAttenteEstime = $request->tAttenteEstime;
    $ticket; 
*/
   
   session_start();
    $_SESSION['idClient']= $etudiant->id;

    $infosClient = clientsLocation::where('clientId','=',$_SESSION['idClient'])
                                    ->where('clientTicket', 'like', ''.$request->nomGuichet.'-%')
                                    ->first(); /*latest*/


       $fichier = fopen('temporaires/IpEsp8266.txt', 'r');

        $ipESP = fgets($fichier);
        $ipESP = preg_replace("#\n|\t|\r#","",$ipESP);
        fclose($fichier);


    // dd($_SESSION['idClient']);
        return view('clientTicket', compact('infosClient','ipESP'));
    }

// infosClient ==> clientId clientNumero clientTicket nom prenom genre nbClientAvant tAttenteEstime



    /**
     * Retourne la liste des clients du jour non servit et leur tickets.
     *
     * @return \Illuminate\Http\Response
     */
    public function clientDuJour()
    {


        $listeGuichet = guichet::all();



        // $nomGuichet = 'A';
        $dd = date("Y-m-d");

        // RECUPERER TOUS LES CLIENTS ET LEURS TICKETS DONT LE NOM DU TICKET COMMENCE PAR A-


        /************* ON RECUPERE LES CLIENTS ET LEUR TICKTE DONT LE NOM-TICKET COMMENCE PAR A- ******/
 /*       $infoFile = array();
        foreach ($listeGuichet as $guichet) {
            $nomGuichet = $guichet->lettre_guichet;
            $infoFile[$guichet->lettre_guichet] =  clients::with([
            'tickets' => function($query) use ($nomGuichet) {
                // $query->where('ticket', 'like', 'A-%') ; 
                $query->where('ticket', 'like', $nomGuichet.'-%') ; 
            }])
            // ->where('created_at', '>', $dd.' 00:00:00')
            // ->where('servit', '=', 0)
            ->get();
        }
*/
        $infoFile = array(); $i=0;
        foreach ($listeGuichet as $guichet) {
            $nomGuichet = $guichet->lettre_guichet;


/********** ON RECUPERE LES CLIENTS ET LEUR TICKTE DONT LE NOM-TICKET COMMENCE PAR A- servit ******/
       $nbClient = etudiant::whereHas(
        'bilanEtudiants' , function($query) use ($nomGuichet) {
            $query->where('ticket', 'like', ''.$nomGuichet.'-%');
        })->where('created_at', '>', $dd.' 00:00:00')->with('bilanEtudiants')
          ->where('servit', '=', 0)->get();
/********** ON RECUPERE LES CLIENTS ET LEUR TICKTE DONT LE NOM-TICKET COMMENCE PAR A- servit ******/

        
            $infoFile[$i++] = array('nom' => $guichet->lettre_guichet, 'nbClient' =>  count($nbClient) );
        }


/*foreach ($infoFile as $key => $value) {
    echo "GUICHET ".$key." ==  ".count($value)."<br>";
}*/
        /************* ON RECUPERE LES CLIENTS ET LEUR TICKTE DONT LE NOM-TICKET COMMENCE PAR A- ******/
        // return view('clientTicket', compact('infoFile'));
        return $infoFile; /* On ne veut pas actualiser la page*/
    }



    /**
     *API pour faire la mise à jour de la page des appels.
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function APIclientAppel()
    {

        
        $reponse = array(); $cpt=0;
        $contenu = scandir('temporaires/');
/*        echo "<pre>";
        print_r($contenu);
        echo "</pre>";*/
// echo count($contenu);
        for ($i=2; $i < count($contenu); $i++) { 
            // echo "Le fichier ".$contenu[$i]."<br>";

            $fichier = fopen('temporaires/'.$contenu[$i], 'r');
            $appel = fgets($fichier);
            $ticketDuSuivant = fgets($fichier);
            $numeroDuProchin = fgets($fichier);

            // Nétoyage
            $ticketDuSuivant=preg_replace("#\n|\t|\r#","",$ticketDuSuivant);
            $numeroDuProchin=preg_replace("#\n|\t|\r#","",$numeroDuProchin);

            // echo "WW".$ticketDuSuivant."WW";
            fclose($fichier);

            $position = strpos($appel, 'false');
            // echo "Le fichier ".$contenu[$i]." contient:  ".$appel.". On trouve false ici: ".$position ."<br><br>";
            if ($position != "") {
               $nouveauText = str_replace('false', 'true', $appel);
                $fichier = fopen('temporaires/'.$contenu[$i], 'w+');
               fwrite($fichier, $nouveauText.$ticketDuSuivant);
               // echo "Pas encore appeler. On remplace le contenu par: ".$nouveauText."<br>".$ticketDuSuivant."<br><br>";
               //  ON VA APPELER CE CLIENT
               // echo "XX".$guichet."XX";
               $reponse[$cpt++] = array('ticket' => $ticketDuSuivant, 'guichet' => $ticketDuSuivant[0], 'numero' => $numeroDuProchin);
               // fclose($fichier);
            }else{
   /*            $nouveauText = str_replace('true', 'false', $appel);
                $fichier = fopen('temporaires/'.$contenu[$i], 'w+');
               fwrite($fichier, $nouveauText.$ticketDuSuivant);
               // echo "Deja appeler. On remplace le contenu par: ".$nouveauText."<br>".$ticketDuSuivant."<br><br>";
                 }
                 fclose($fichier);*/
        }

    }


   /*     echo "<pre>";
        print_r($reponse);
        echo "</pre>";*/
        return $reponse; /* Pour afficher du JSON dans une page, on ne doit pas avoir du texte avant */

    }








    /**
     * La connexion de l'étudiant
     *
     * @return \Illuminate\Http\Response
     */
    public function clientConnexion()
    {
        return view('formulaires.connexionClient');
    }




    /**
     * Vérification des paramètres de connexion de l'étudiant
     *
     * @return \Illuminate\Http\Response
     */
    public function Connexion(Request $request)
    {
        $etuExiste = etudiant::where('nce','=',$request->nce)->first();
        // dd($etuExiste);
        if ($etuExiste != NULL) {
            if (isset($_SESSION['sessionClient'])) {
                session_destroy();
            } else {
                session_start();
            $_SESSION['sessionClient']= $etuExiste->id;
            }
            
            
            return redirect()->route('demandeEtudiant',$etuExiste->id);
        } else {
            return back()->withErrors(['Désoler! NCE incorrecte ou Vous n\'etes pas étudiant!']);
            
        }
        
        

        return view('formulaires.connexionClient');
    }





    /**
     * clientDeconnecter
     *
     * @return \Illuminate\Http\Response
     */
    public function clientDeconnecter()
    {
        $fichier = fopen('clientDeconnecter.txt', 'a+');
        fwrite($fichier, 'Le client est clientDeconnecter');
        fclose($fichier);
    }




}/* FIN DE LA CLASS*/


