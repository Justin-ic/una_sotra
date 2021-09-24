<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; // pour utiliser les requêtes personnalisées
use Illuminate\Http\Request;
use App\Models\clients;
use App\Models\descriptions;
use App\Models\services;
use App\Models\ticket;
use App\Models\guichets;
use App\Models\personnels;



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
        echo "Test de git";
        // toArray() permet de transformer a en un tableau. mais pas intéressant car on ne poura pas utiliser les méthodes dessus.
        // $liste = clients::with('service')->get()->toArray();

        // le with() permet de lier la table de relation
        // 
        $liste = clients::with('tickets')->get();
        $liste = clients::latest()->simplePaginate(5);
        // DB::table('users')->orderBy('id')->cursorPaginate(15);
        
        // $liste = clients::latest()->cursorPaginate(5);

        // $liste = clients::all(); //  IDEME
        // $liste = DB::table('clients')->get(); // IDEME
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
        $listeService = services::all();
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
            'numero' => 'required',
            'ticket' => 'required',
            'commentaire' => 'required',
            'service_id' => 'required'
        ]);


        clients::create([
            'nom' => $request->nom,
            'numero' => $request->numero,
            'ticket' => $request->ticket,
            'commentaire' => $request->commentaire,
            'service_id' => $request->service_id
        ]);
        $message = "Créer avec succsès!";
        return redirect()->route('home')->with('message');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $le_client = clients::findOrFail($id);  
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
        $listeService = services::all(); // Liste de tous les services pour le formulaire
        $client = clients::with('service')->find($id);
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
            'numero' => 'required',
            'commentaire' => 'required',
            'service_id' => 'required'
        ]);

        $client = clients::find($request->id);
        $client->update([
            'nom' => $request->nom,
            'numero' => $request->numero,
            'commentaire' => $request->commentaire,
            'service_id' => $request->service_id
        ]);
        $message = "Modifier avec succsès!";
        return redirect()->route('home')->with('message');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $client = clients::find($id)->delete();
        return redirect()->route('home')->with('message');
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
        $client = clients::find($id);
        $client->update([
            'debutService' => $request->debutService,
            'finService' => $finService,
            'commentaire' => $request->commentaireserveur,
            'servit' => 1
        ]);

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
        $LeGuichet = guichets::where('personnel_id', '=', $id)->first();

        $nomGuichet = str_replace(' ', '', $LeGuichet->lettre_guichet); 
// on trouvera le guichet en fonction du personne

        


        // dd($nomGuichet);

        // $nomGuichet = 'A';
        $dd = date("Y-m-d");

// RECUPERER TOUS LES CLIENTS ET LEURS TICKETS DONT LE NOM DU TICKET COMMENCE PAR A-


/******* ON RECUPERE LES CLIENTS ET LEUR TICKTE DONT LE NOM-TICKET COMMENCE PAR A-non servit ***/
       $ClientsNonServie = clients::whereHas(
        'tickets' , function($query) use ($nomGuichet) {
            $query->where('ticket', 'like', ''.$nomGuichet.'-%');
        })->where('created_at', '>', $dd.' 00:00:00')->with('tickets')
          ->where('servit', '=', 0)->get();
// dd($ClientsNonServie);
/****** ON RECUPERE LES CLIENTS ET LEUR TICKTE DONT LE NOM-TICKET COMMENCE PAR A- non servit *****/


/********** ON RECUPERE LES CLIENTS ET LEUR TICKTE DONT LE NOM-TICKET COMMENCE PAR A- servit ******/
       $ClientsServie = clients::whereHas(
        'tickets' , function($query) use ($nomGuichet) {
            $query->where('ticket', 'like', ''.$nomGuichet.'-%');
        })->where('created_at', '>', $dd.' 00:00:00')->with('tickets')
          ->where('servit', '=', 1)->get();

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


        if ( count($ClientsNonServie) == 0) {
             /*On a besoin des deux premiers*/

             $genre1 = "";
             $genre2 = "";
             $clientEnCours = null;
             $leClientSuivant = null;
        } else if ( count($ClientsNonServie) == 1){
                // code...
             /*On a besoin des deux premiers*/
             if ($ClientsNonServie[0]->genre == 'H') {
                 $genre1 = "Mr.";
             } else {
                 $genre1 = "Mme";
             }

             $genre2 = "";
             $clientEnCours = $ClientsNonServie[0];
             $leClientSuivant = null;
        }else{
             /*On a besoin des deux premiers*/
             if ($ClientsNonServie[0]->genre == 'H') {
                 $genre1 = "Mr.";
             } else {
                 $genre1 = "Mme";
             }

             if ($ClientsNonServie[1]->genre == 'H') {
                 $genre2 = "Mr.";
             } else {
                 $genre2 = "Mme";
             }
             $clientEnCours = $ClientsNonServie[0];
             $leClientSuivant = $ClientsNonServie[1];
        }
        // ON EST SUR QU'UN CLIENT PEUT AVOIR PLUSIEURS TICKETS. MAIS LE MÊME JOUR, IL A UN ET UN SEUL TICKTE. ON PEUT DONC UTILISER first()

// dd($clientEnCours);
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
            'nom' => 'required',
            'prenom' => 'required',
            'genre' => 'required',
            'numero' => 'required',
            'choix' => 'required',
            'nce' => 'required',

            'nomGuichet' => 'required',
            'tAttenteEstime' => 'required',
            'nbClientAvant' => 'required'
        ]);




/************** enregistrement du client *********************************/
// dd("j'arrive ici");
        clients::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'genre' => $request->genre,
            'numero' => $request->numero,
            'nce' => $request->nce,
            // 'ticket_id' => $dernierTicket->id,
            'servit' => 0
        ]);

$dernierclient = clients::latest()->first();
/************** enregistrement du client *********************************/



/************************** Création du ticket ******************/
    $description="";
    foreach ($request->choix as $detail) {
        $description = $description.";".$detail;
    }
     $description = substr($description, 1); /* Enlève le premier caractère qui est ;*/
     $ticket = $request->nomGuichet.'-'.($request->nbClientDuJour+1);
     ticket::create([
        'description' => $description,
        'ticket' => $ticket,
        'tAttenteEstime' => $request->tAttenteEstime,
        'clients_id' => $dernierclient->id,
        'nbClientAvant' => $request->nbClientAvant
    ]);

     



     // dd($dernierTicket);
// description     ticket  tAttenteEstime  nbClientAvant   created_at  updated_at  
/************************** Création du ticket ******************/






    // nom     prenom  genre   numero  nce     ticket_id   servit  created_at  updated_at 
    $nom = $request->nom; 
    $prenom = $request->prenom;  
    $nbClientAvant = $request->nbClientAvant; 
    $tAttenteEstime = $request->tAttenteEstime;
    $ticket; 
    if ($request->genre == 'H') {
             $genre = "Mr.";
         } else {
             $genre = "Mme.";
         }
              
        return view('clientTicket', compact('nom', 'prenom',  'nbClientAvant',  'tAttenteEstime',  'ticket',  'genre'));
    }





    /**
     * Retourne la liste des clients du jour non servit et leur tickets.
     *
     * @return \Illuminate\Http\Response
     */
    public function clientDuJour()
    {


        $listeGuichet = guichets::all();



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
       $nbClient = clients::whereHas(
        'tickets' , function($query) use ($nomGuichet) {
            $query->where('ticket', 'like', ''.$nomGuichet.'-%');
        })->where('created_at', '>', $dd.' 00:00:00')->with('tickets')
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



    

}/* FIN DE LA CLASS*/


