<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\descriptions;
use App\Models\services;


class descriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index() 
    {

        // $service = services::with('descriptions')->get();
/*        // $liste = descriptions::all();
        $liste = descriptions::with('service')->get();
        dd($service);
*/
        $liste = descriptions::with('service')->paginate(5);
        
        return view('descriptions', compact('liste'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listeService = services::all();
        return view('formulaires.descriptions_creer', compact('listeService'));
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
            'detail' => 'required',
            'service_id' => 'required'
        ]);
// detail  services_id  created_at  updated_at  
         descriptions::create([
            'detail' => $request->detail,
            'services_id' => $request->service_id
        ]);
        $message = "Créer avec succsès!";
        return redirect()->route('descriptions.index')->with('message');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $le_description = descriptions::findOrFail($id);  
      // OrFail: Il cherche le client; s'il ne le retrouve pas, il renvoie un 404.

      return view('detail_description',compact('le_description'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $description = descriptions::findOrFail($id);
        $listeService = services::all();
        // with('service'): service est la méthode service() du model
        // dd($listeService->find(1)->nom);
        return view('formulaires.descriptions_modif',compact('description','listeService'));
        
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
            'detail' => 'required',
            'service_id' => 'required'
        ]);

        $description = descriptions::find($request->id);
        $description->update([
            'detail' => $request->detail,
            'services_id' => $request->service_id
        ]);
        $message = "Modifier avec succsès!";
        return redirect()->route('descriptions.index')->with('message');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $description = descriptions::find($id)->delete();
        return redirect()->route('descriptions.index')->with('message');
    }
}
