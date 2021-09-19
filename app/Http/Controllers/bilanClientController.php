<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\bilanClients;


class bilanClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index() 
    {
        $liste = bilanClients::with('clients')->latest()->paginate(5);
        return view('bilanClient', compact('liste'));
    }
// clients_id  etat    commentaire     tempsArrive     debutService    finService  created_at  updated_at  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $liste = bilanClients::with('clients')->latest()->paginate(5);
        return view('formulaires.bilanClients_creer', compact('liste'));
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
            'clients_id' => 'required',
            'etat' => 'required',
            'commentaire' => 'required',
            'tempsArrive' => 'required',
            'debutService' => 'required',
            'finService' => 'required'
        ]);

//                       created_at  updated_at          
        bilanClients::create([
            'clients_id' => $request->clients_id,
            'etat' => $request->etat,
            'commentaire' => $request->commentaire,
            'tempsArrive' => $request->tempsArrive,
            'debutService' => $request->debutService,
            'finService' => $request->finService
        ]);
        $message = "Créer avec succsès!";
        return redirect()->route('bilanClients.index')->with('message');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $le_bilanClients = bilanClients::with('clients')->findOrFail($id);  
      // OrFail: Il cherche le client; s'il ne le retrouve pas, il renvoie un 404.

      return view('detail_bilanClients',compact('le_bilanClients'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bilanClient = bilanClients::with('clients')->findOrFail($id);
        // with('service'): service est la méthode service() du model
        // dd($listeService->find(1)->nom);
        return view('formulaires.bilanClients_modif',compact('bilanClient'));
        
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
            'clients_id' => 'required',
            'etat' => 'required',
            'commentaire' => 'required',
            'tempsArrive' => 'required',
            'debutService' => 'required',
            'finService' => 'required'
        ]);

        $bilanClient = bilanClients::find($request->id);
        $bilanClient->update([
            'clients_id' => $request->clients_id,
            'etat' => $request->etat,
            'commentaire' => $request->commentaire,
            'tempsArrive' => $request->tempsArrive,
            'debutService' => $request->debutService,
            'finService' => $request->finService
        ]);
        $message = "Modifier avec succsès!";
        return redirect()->route('bilanClients.index')->with('message');
    }
// clients_id  etat    commentaire     tempsArrive     debutService    finService  created_at  updated_at  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $bilanClients = bilanClients::find($id)->delete();
        return redirect()->route('bilanClients.index')->with('message');
    }
}






