<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\personnel;
use App\Models\guichet;

class personnelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index() 
    {
        $liste = personnel::latest()->paginate(5);
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
        personnel::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'dateNaissance' => $request->dateNaissance,
            'user' => $request->user,
            'pass' => $request->pass,
            'type' => 'personnel'
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
          $le_client = personnel::findOrFail($id);  
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
        $personnel = personnel::findOrFail($id);
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
    

            $personnels = personnel::all();
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
         $personnel = personnel::find($id)->delete();
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
       $personnels = personnel::all();
/*       echo "<pre>";
       echo "Liste des personnels:";
       print_r($personnels);
       echo "</pre>";
       // die();*/

/*       // Nétoyage
        $user = preg_replace("#^[\t\f\v ]+|[\t\f\v ]+$#m",'',$request->user);
        $pass = preg_replace("#^[\t\f\v ]+|[\t\f\v ]+$#m",'',$request->pass);
 
 */
       $personnel = personnel::where('user','=',$request->user)->where('pass','=',$request->pass)->get()->first();
// dd($personnel);
       // foreach ($personnels as $personnel) {

             ?> 
            <!-- <script type="text/javascript">
            alert('J ai recuperé le Personne');
            </script> -->
            <?php
           if ($personnel != null) {

            // echo "Nom formater: request->user=X".$request->user."X Formater=X".$user."X<br>";
            echo "A cause de toi; Petit espace la. ";
            echo "<br>ERREUR: <br>personnel->type =XXXX".$personnel->type."XXXX <br>";

            echo "<br>";
            $typeBd = str_replace(' ', '', $personnel->type);
            echo "CORRECTION: XXXX".$typeBd."XXXX <br>";

            echo "5h pour trouver <br>";

            ?> 
            <!-- <script type="text/javascript">
             alert('Je Il y a bien un personne; on va voir s il est admin ou pas');
            </script>  -->
            <?php
            if ( $typeBd == "admin") {
                                  ?> 
           <!--  <script type="text/javascript">
            alert('admin admin admin: Je vais faire la redirection vers bienVenusAdmin car ce sont les coordonnées de admin');
            </script> -->
            <?php
            // dd('J arrive ici pour dir que je sui admin');
                return redirect()->route('bienVenusAdmin');
            } else if ($typeBd == 'personnel') {
                session_start();

                                 ?> 
            <!-- <script type="text/javascript">
            alert('Je vais prendre le guichets car ce sont les coordonnées de Personne');
            </script> -->
            <?php
                $_SESSION['guichet'] = guichet::where('personnel_id', '=', $personnel->id)->first();

                $_SESSION['personnel'] = $personnel;
                // dd($_SESSION['personnel']);


                /* INITIALISATION DU FICHIER POUR LES APPELS*/
                $fichier = fopen('temporaires/'.$_SESSION['guichet']->lettre_guichet.".txt", 'w+'); 
            fwrite($fichier, 'appel=true 
00');
            fclose($fichier);


                return redirect()->route('interfaceGuichetPersonnel');
            }else{echo "En faite L'espace était mon problème";}

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
         <!--    <script type="text/javascript">
            alert('Etape 1: Je Suis dans initBD');
            </script> -->
            <?php
        $personnels = personnel::all();
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
           $typePersonnel = $personnels->where('type', '=', 'personnel')->get();
           if (count($typePersonnel) == 0) {
            ?> 
<!--             <script type="text/javascript">
            alert('Connectez-vous en tant que Administrateur pour indiquer des services, des descriptions et des guichets');
            </script> -->
            <?php
               return  view('formulaires.connexion')->with(['message' => 'Connectez-vous en tant que Administrateur pour indiquer des services, des descriptions et des guichets.']);
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

 /*       $nom = preg_replace("#^[\t\f\v ]+|[\t\f\v ]+$#m",'',$request->nom);
        $prenom = preg_replace("#^[\t\f\v ]+|[\t\f\v ]+$#m",'',$request->prenom);
        $dateNaissance = preg_replace("#^[\t\f\v ]+|[\t\f\v ]+$#m",'',$request->dateNaissance);
        $user = preg_replace("#^[\t\f\v ]+|[\t\f\v ]+$#m",'',$request->user);
        $pass = preg_replace("#^[\t\f\v ]+|[\t\f\v ]+$#m",'',$request->pass);
 
 
 echo  "Nom formater=== nom=".$request->nom  ."X prenom=".$request->prenom ."X dateNaissance=".$request->dateNaissance  ."X user=".$request->user ."X pass=".$request->pass."X";

 echo  " nom=".$nom  ."X prenom=".$prenom ."X dateNaissance=".$dateNaissance  ."X user=".$user ."X pass=".$pass."X";
 die();

                                TOUT EST BIEN FORMATER
 */
            ?> 
            <script type="text/javascript">
            alert("Netoyage OK: nom=X");
            </script>
            <?php
 
             // dd("Tout se passe bien !!");

        personnel::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'dateNaissance' => $request->dateNaissance,
            'user' => $request->user,
            'pass' => $request->pass,
            'type' => $request->type
            // 'type' => "admin" Cette manière ajoute un espace unitile à la fin du taxte
        ]);
        $message = "Créer avec succsès!";

echo "request->type XX". $request->type."XX";

       $personnels = personnel::all();
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
