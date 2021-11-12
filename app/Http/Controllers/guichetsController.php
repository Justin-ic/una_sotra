<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\guichet;
use App\Models\service;
use App\Models\personnel;

class guichetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index() 
    {
        $guichet = guichet::with('service', 'personnel')->get(); 
        // service et personnel sont les noms de  méthode du model guichets
        // dd($guichet);
        // $guichet = guichetsController::latest()->paginate(5);
        return view('guichet', compact('guichet'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listeService = service::all(); 
        $listePersonnel = personnel::where('type','=',"personnel")->get();

        $i=0;$personnelLibre=null; // Initialisé à null au cas où il n'iy a pas de personnel
                                    // On prend null pour pouvoir le transforme en un un tableau
       
        foreach ($listePersonnel as $personnel) {
            $idp = $personnel->id;
            $guichet = guichet::where('personnel_id','=',$idp)->get();

            if (count($guichet) == 0) {
                // Il n'a pas de gichet encror donc on peut le prendre
                $personnelLibre[$i++] = $personnel;
            }            
        }

        $i=0;$serviceLibre=null; // Initialisé à 0 au cas où il n'iy a pas de service
                                // On prend null pour pouvoir le transforme en un un tableau

        foreach ($listeService as $service) {
            $ids = $service->id;
            $guichet = guichet::where('service_id','=',$ids)->get();

            if (count($guichet) == 0) {
                // Il n'a pas de gichet encror donc on peut le prendre
                $serviceLibre[$i++] = $service;
            }            
        }
/*dd($serviceLibre);
         dd($personnelLibre);*/

/*        $listePersonnel = personnels::with('guichets')
                                      ->where('type','=',"personnel")->get();


$listePersonnel = personnels::whereHas(
        'guichet' , function($query) {
            $query->whereNotNull('id','<>',"");
        })->where('type','=',"personnel")->with('guichet')->get();

*/
/* l'idée est de recupérer seul les personnels qui ont des guichets.
 Pour faire simple, je passe par le fils qui est guchets. 
Chaque ligne du guichet a un seul personnel associé.
 */
/*     faire le contraire de ce code
       $listeGuichet = guichets::whereHas(
        'personnel' , function($query) {
            $query->where('type','=',"personnel");
        })->with('personnel')->get();
*/
// $listeGuichet->first()
        return view('formulaires.guichets_creer', compact('serviceLibre','personnelLibre'));
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
            'lettre_guichet' => 'required',
            'service_id' => 'required',
            'personnel_id' => 'required'
        ]);

// lettre_guichet  service_id  personnel_id    created_at  updated_at  
        $l=strtoupper($request->lettre_guichet);
        $La_lettre= guichet::where('lettre_guichet', '=', $l)->first();
        // dd($La_lettre); // Retourne un objet
        if ($La_lettre != null) {
            $listeService = service::all();
            $listePersonnel = personnel::where('type','=',"personnel")->get();
            return view('formulaires.guichets_creer', compact('listeService','listePersonnel'));
        } else {
            guichet::create([
                'lettre_guichet' => strtoupper($request->lettre_guichet),
                'service_id' => $request->service_id,
                'personnel_id' => $request->personnel_id
            ]);
            $message = "Créer avec succsès!";
            return redirect()->route('guichets.index')->with('message');
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
      $guichet = guichet::with('service', 'personnel')->findOrFail($id);
        // $guichet = guichetsController::latest()->paginate(5);

      return view('detail_guichet',compact('guichet'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $listeService = service::all();
        $listePersonnel = personnel::with('guichet')->where('type','=',"personnel")->get();
        // dd($listePersonnel);
        // guichet pour accéder au service et personnel qui était là 
        $guichet = guichet::with('service', 'personnel')->findOrFail($id); 
        return view('formulaires.guichets_modif',compact('guichet', 'listeService', 'listePersonnel'));
        
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
            'lettre_guichet' => 'required',
            'service_id' => 'required',
            'personnel_id' => 'required'
        ]);

// lettre_guichet  service_id  personnel_id    created_at  updated_at  
        $l=strtoupper($request->lettre_guichet);
        $La_lettre= guichet::where('lettre_guichet', '=', $l)->first();
        // dd($La_lettre); // Retourne un objet
        if ($La_lettre != null) {
            $listeService = service::all();
            $listePersonnel = personnel::all();
            // guichet pour accéder au service et personnel qui était là 
            $guichet = guichet::with('service', 'personnel')->findOrFail($id);
            return view('formulaires.guichets_modif', compact('guichet', 'listeService','listePersonnel'));
        } else {
            $guichet = guichet::find($request->id);
            $guichet->update([
                'lettre_guichet' => strtoupper($request->lettre_guichet),
                'service_id' => $request->service_id,
                'personnel_id' => $request->personnel_id
            // 'updated_at' => now('Y','m','d')
            ]);
            $message = "Modifier avec succsès!";
            return redirect()->route('guichets.index')->with('message');
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
        $guichet = guichet::find($id)->delete();
        return redirect()->route('guichets.index')->with('message');
    }
}
