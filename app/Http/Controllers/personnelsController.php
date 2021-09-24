<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\personnels;
use App\Models\guichets;

class personnelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index() 
    {
        $liste = personnels::latest()->paginate(5);
        return view('personnels', compact('liste'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('formulaires.personnels_creer');
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
            'dateNaissance' => 'required',
            'user' => 'required',
            'pass' => 'required'
        ]);

    // <!-- 'nom', 'prenom', 'dateNaissance', 'user', 'pass' -->
        personnels::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'dateNaissance' => $request->dateNaissance,
            'user' => $request->user,
            'pass' => $request->pass,
            'type' => "personnel"
        ]);
        $message = "Créer avec succsès!";
        return redirect()->route('personnels.index')->with('message');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $le_client = personnels::findOrFail($id);  
      // OrFail: Il cherche le client; s'il ne le retrouve pas, il renvoie un 404.

      return view('detail_personnel',compact('le_personnel'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $personnel = personnels::findOrFail($id);
        // with('service'): service est la méthode service() du model
        // dd($listeService->find(1)->nom);
        return view('formulaires.personnels_modif',compact('personnel'));
        
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
            'dateNaissance' => 'required',
            'user' => 'required',
            'pass' => 'required'
        ]);
    

            $personnels = personnels::all();
            // $nom = $personnels->find($id);
            // $nom = $personnels->where(['nom','prenom'], '=', [$request->nom, $request->prenom])->get();
            // dd($nom);

            // Comme j'ai recupérer à partir d'une variable, je n'est plus besoin de get()
            $nom = $personnels->where('nom', '=', $request->nom); 
            $prenom = $personnels->where('prenom', '=', $request->prenom);
            $fNom = $request->nom; 
            $fPreNom = $request->prenom; 

            $personnel = $personnels->find($request->id);

        if ($nom.' '.$prenom == $fNom.' '.$fPreNom) {
            return view('formulaires.personnels_modif',compact('personnel'));
        } else {
            $personnel->update([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'dateNaissance' => $request->dateNaissance,
                'user' => $request->user,
                'pass' => $request->pass,
                'type' => 'personnel'
            ]);
            $message = "Modifier avec succsès!";
            return redirect()->route('personnels.index')->with('message');
        }
        


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $personnel = personnels::find($id)->delete();
        return redirect()->route('personnels.index')->with('message');
    }

    /**
     * Déconnecte le personnel et le ramenne à la page de connexion
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deconnexion()
    {
        session_start();
        session_destroy();
        return redirect()->route('connexion');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function authentification(Request $request)
    {
                                      ?> 
            <script type="text/javascript">
            alert('Je Suis dans authentification');
            </script>
            <?php
       $personnels = personnels::all();
/*       echo "<pre>";
       echo "Liste des personnels:";
       print_r($personnels);
       echo "</pre>";
       // die();*/

       // Nétoyage
        $user = preg_replace("#^[\t\f\v ]+|[\t\f\v ]+$#m",'',$request->user);
        $pass = preg_replace("#^[\t\f\v ]+|[\t\f\v ]+$#m",'',$request->pass);
 
 
       $personnel = personnels::where('user','=',$user)->where('pass','=',$pass)->get()->first();
// dd($personnel);
       // foreach ($personnels as $personnel) {

                                      ?> 
            <script type="text/javascript">
            alert('J ai recuperé le Personne');
            </script>
            <?php
           if ($personnel != null) {

            echo "Nom formater: request->user=X".$request->user."X Formater=X".$user."X<br>";
            echo "personnel->type =X".$personnel->type."X<br>";

            ?> 
            <script type="text/javascript">
            alert('Je Il y a bien un personne; on va voir s il est admin ou pas');
            </script>
            <?php
            if ($personnel->type == "admin") {
                                  ?> 
            <script type="text/javascript">
            alert('admin admin admin: Je vais faire la redirection vers bienVenusAdmin car ce sont les coordonnées de admin');
            </script>
            <?php
                return redirect()->route('bienVenusAdmin');
            } else if ($personnel->type == 'personnel') {
                session_start();

                                 ?> 
            <script type="text/javascript">
            alert('Je vais prendre le guichets car ce sont les coordonnées de Personne');
            </script>
            <?php
                $_SESSION['guichet'] = guichets::where('personnel_id', '=', $personnel->id)->first();

                $_SESSION['personnel'] = $personnel;
                // dd($_SESSION['personnel']);


                /* INITIALISATION DU FICHIER POUR LES APPELS*/
                $fichier = fopen('temporaires/'.$_SESSION['guichet']->lettre_guichet.".txt", 'w+'); 
            fwrite($fichier, 'appel=true 
00');
            fclose($fichier);


                return redirect()->route('interfaceGuichetPersonnel');
            }/*else{
                return view('formulaires.connexion');
            }
*/
        }else{return view('formulaires.connexion')->with(['message' => 'Coordonnées Non valide !']);}
     // }

    }



    /**
     * Initialisation de la base de données: 
     * Création de l'admine à la première connexion
     * Il doit créer des services en suite leurs descriptions et enfin le guichet.
     * 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function initBD()
    {
                                      ?> 
            <script type="text/javascript">
            alert('Etape 1: Je Suis dans initBD');
            </script>
            <?php
        $personnels = personnels::all();
       /*echo "<pre>";
       echo "Liste des personnels:";
       print_r($personnels);
       echo "</pre>";
       die();*/
       // dd(count($personnels));

//************ INSCRIPTION DE L'ADMIN ************************
       if (count($personnels) == 0) {
           return  view('formulaires.initAdmin');
       } else {
           $typePersonnel = $personnels->where('type', '=', 'personnel');
           if (count($typePersonnel) == 0) {
            ?> 
            <script type="text/javascript">
            alert('Connectez-vous en tant que Administrateur pour indiquer des services, des descriptions et des guichets');
            </script>
            <?php
               return  view('formulaires.connexion');
           } else {
               return view('formulaires.connexion');
           }
           
       }
       
//************ INSCRIPTION DE L'ADMIN ************************
        // return  view('');
    }



    /**
     * Initialisation de la base de données: 
     * Création de l'admine à la première connexion
     * Il doit créer des services en suite leurs descriptions et enfin le guichet.
     * 
     * On stocke les informations de l'administrateur
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function initBDStore(Request $request)
    {
             ?> 
            <script type="text/javascript">
            alert('Je suis dans initBDStore pour le stockage');
            </script>
            <?php
       // dd("Tout se passe bien !!");

//************ INSCRIPTION DE L'ADMIN ************************
    request()->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'dateNaissance' => 'required',
            'user' => 'required',
            'pass' => 'required'
        ]);

    // <!-- 'nom', 'prenom', 'dateNaissance', 'user', 'pass' -->
            ?> 
            <script type="text/javascript">
            alert('Netoyage des données request');
            </script>
            <?php

        $nom = preg_replace("#^[\t\f\v ]+|[\t\f\v ]+$#m",'',$request->nom);
        $prenom = preg_replace("#^[\t\f\v ]+|[\t\f\v ]+$#m",'',$request->prenom);
        $dateNaissance = preg_replace("#^[\t\f\v ]+|[\t\f\v ]+$#m",'',$request->dateNaissance);
        $user = preg_replace("#^[\t\f\v ]+|[\t\f\v ]+$#m",'',$request->user);
        $pass = preg_replace("#^[\t\f\v ]+|[\t\f\v ]+$#m",'',$request->pass);
 
 
 echo  "Nom formater=== nom=".$request->nom  ."X prenom=".$request->prenom ."X dateNaissance=".$request->dateNaissance  ."X user=".$request->user ."X pass=".$request->pass."X";

 echo  " nom=".$nom  ."X prenom=".$prenom ."X dateNaissance=".$dateNaissance  ."X user=".$user ."X pass=".$pass."X";
            ?> 
            <script type="text/javascript">
            alert("Netoyage OK: nom=X");
            </script>
            <?php
 
             // dd("Tout se passe bien !!");

        personnels::create([
            'nom' => $nom,
            'prenom' => $prenom,
            'dateNaissance' => $dateNaissance,
            'user' => $user,
            'pass' => $pass,
            'type' => "admin"
        ]);
        $message = "Créer avec succsès!";


       $personnels = personnels::all();
/*       echo "<pre>";
       echo "Liste des personnels:";
       print_r($personnels);
       echo "</pre>";
       // die();*/

                     ?> 
            <script type="text/javascript">
            alert('Administrateur Ajouter avec succcés. Cette fois je fais une redirection vers bienVenusAdmin');
            </script>
            <?php
       // return view('bienVenusAdmin');
        return redirect()->route('bienVenusAdmin'); 
       
//************ INSCRIPTION DE L'ADMIN ************************
    }






}
