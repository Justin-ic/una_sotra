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
            'pass' => $request->pass
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
                'pass' => $request->pass
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
       $personnels = personnels::all();
/*       echo "<pre>";
       print_r($personnels);
       echo "</pre>";
       die();*/
       foreach ($personnels as $personnel) {
           if ($personnel->user == $request->user && $personnel->pass == $request->pass) {
            if ($personnel->type == 'admin') {
                return redirect()->route('homeAdmine');
            } else if ($personnel->type == 'personnel') {
                session_start();

                $_SESSION['guichet'] = guichets::where('personnel_id', '=', $personnel->id)->first();

                $_SESSION['personnel'] = $personnel;
                // dd($_SESSION['personnel']);


                /* INITIALISATION DU FICHIER POUR LES APPELS*/
                $fichier = fopen('temporaires/'.$_SESSION['guichet']->lettre_guichet.".txt", 'w+'); 
            fwrite($fichier, 'appel=true 
00');
            fclose($fichier);


                return redirect()->route('interfaceGuichetPersonnel');
            }else{
                return view('formulaires.connexion');
            }

        }
    }

}
}
