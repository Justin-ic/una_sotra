<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\guichets;
use App\Models\services;
use App\Models\personnels;

class guichetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index() 
    {
        $guichet = guichets::with('service', 'personnel')->get(); 
        // service et personnel sont les noms de  méthode du model guichets

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
        $listeService = services::all();
        $listePersonnel = personnels::all();
        return view('formulaires.guichets_creer', compact('listeService','listePersonnel'));
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
        $La_lettre= guichets::where('lettre_guichet', '=', $l)->first();
        // dd($La_lettre); // Retourne un objet
        if ($La_lettre != null) {
            $listeService = services::all();
            $listePersonnel = personnels::all();
            return view('formulaires.guichets_creer', compact('listeService','listePersonnel'));
        } else {
            guichets::create([
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
      $guichet = guichets::with('service', 'personnel')->findOrFail($id);
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
        $listeService = services::all();
        $listePersonnel = personnels::all();
        // guichet pour accéder au service et personnel qui était là 
        $guichet = guichets::with('service', 'personnel')->findOrFail($id); 
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
        $La_lettre= guichets::where('lettre_guichet', '=', $l)->first();
        // dd($La_lettre); // Retourne un objet
        if ($La_lettre != null) {
            $listeService = services::all();
            $listePersonnel = personnels::all();
            // guichet pour accéder au service et personnel qui était là 
            $guichet = guichets::with('service', 'personnel')->findOrFail($id);
            return view('formulaires.guichets_modif', compact('guichet', 'listeService','listePersonnel'));
        } else {
            $guichet = guichets::find($request->id);
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
        $guichet = guichets::find($id)->delete();
        return redirect()->route('guichets.index')->with('message');
    }
}
