<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\services;
use App\Models\clients;

class servicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $liste = services::paginate(5);
                
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

        $s = services::where('nom', '=', $request->nom)->first();
        // dd($s);
        if ($s != null) {
            return view('formulaires.services_creer');
        } else {
            services::create([
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
       $le_service = services::findOrFail($id);  
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
        $service = services::findOrFail($id);

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

        $s = services::where('nom', $request->nom)->first();
        // dd($s);
        if ($s != null) {
            $service = services::findOrFail($id);
            return view('formulaires.services_modif', compact('service'));
        } else {
            $service = services::findOrFail($id);
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
        $service = services::find($id)->delete();
        return redirect()->route('services.index')->with('message');
    }



/************************** Les Méthodes spécifiques ***********************************/

    /**
     * retourne la liste des services pour la vue clientBienvenue.
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function ListeService()
    {
        $liste = services::all();
        return view('clientBienvenue', compact('liste'));
    }



    /**
     * Retourne le services et la liste des descriptions 
     * qui lui sont associer pour la vue autoEnregistreClient.
     * 
     * 
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function LeServiceDemander($id)
    {
        $LeService = services::with('descriptions')->find($id);
        $LeGuichet = services::with('guichet')->find($id);

// dd($LeGuichet->guichet->lettre_guichet); // guichet est le nom de la relation

        $nomGuichet = $LeGuichet->guichet->lettre_guichet;
        // dd($nomGuichet);
        $dd = date("Y-m-d");

// on veut recupérer la liste  client en fonction du guichet qui est parqué par le nom du ticket
/*!!!!!!!!!!!!!!!!!!!!!!! clients du jour par guichet !!!!!!!!!!!!!!!!!!!!!!!!!!!!*/

       $listeClientJour = clients::whereHas(
        'tickets' , function($query) use ($nomGuichet) {
            $query->where('ticket', 'like', ''.$nomGuichet.'-%');
        })->where('created_at', '>', $dd.' 00:00:00')->with('tickets')
          ->get();

/*!!!!!!!!!!!!!!!!!!!!!!! clients du jour par guichet !!!!!!!!!!!!!!!!!!!!!!!!!!!!*/



/*!!!!!!!!!!!!!!!!!!!! clients non servit du jour guichet !!!!!!!!!!!!!!!!!!*/

       $listeClientAvant = clients::whereHas(
        'tickets' , function($query) use ($nomGuichet) {
            $query->where('ticket', 'like', ''.$nomGuichet.'-%');
        })->where('created_at', '>', $dd.' 00:00:00')->with('tickets')
          ->where('servit', '=', 0)
          ->get();

/*!!!!!!!!!!!!!!!!!!!!!!!! clients non servit du jour guichet !!!!!!!!!!!!!!!!!!!!!!!!!!!**/
echo 'nomGuichet=='.$nomGuichet.'==';
echo 'Nb Clients avant '.count($listeClientAvant);
echo ' Nb Clients listeClientJour '.count($listeClientJour) ;
        dd($listeClientAvant);
        $nbClientAvant = count($listeClientAvant);
        $nbClientDuJour = count($listeClientJour);
// dd($nbClientDuJour);
        return view('autoEnregistreClient', compact('LeService','nbClientAvant', 'nbClientDuJour','nomGuichet'));
    }



/************************** Les fonctions spécifiques ***********************************/

}



