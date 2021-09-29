<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\clientsLocation;

class ClientLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }




    // ===============================================================================
    /**
     * Retourne le temps restant. appeler seulement lors de l'actualisation de la page clientsTiket
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ApiTempsRestant(Request $request)
    {


/*

$firstDate  = new DateTime("2019-01-01");
$secondDate = new DateTime("2020-03-04");

$intvl = $firstDate->diff($secondDate);

echo $intvl->y . " year, " . $intvl->m." months and ".$intvl->d." day"; 
echo "\n";
// Total amount of days
echo $intvl->days . " days ";

//output: 1 year, 2 months and 1 day
//        428 days





$date = new DateTime( '2009-10-05 18:07:13' );
$date2 = new DateTime( '2009-10-05 18:11:08' );

$diffInSeconds = $date2->getTimestamp() - $date->getTimestamp();




    //date_diff nous donne maintenant des valeurs sur les représentations ci-dessus
    $interval = date_diff($maintenant, $UneDate);
    
    //on récupère les valeurs d'$interval qui nous intéresse
    $y=$interval->y;//années
    $m=$interval->m;//mois
    $d=$interval->d;//jours
    $h=$interval->h;//heures
    $i=$interval->i;//minutes
    $s=$interval->s;//secondes




*/
/*
     * CALCULS
     * date création --> tAttenteEstime
     * date actuel -->  X? = temps restant
     * date actuel - date création - tAttenteEstime == temps restant
*/

        $infosClient = clientsLocation::where('clientTicket','=',$request->ticket)
                                        ->where('clientNumero','=',$request->numero)->get();

       dd($infosClient);

       return view('clientTicket', compact('infosClient'));

    }






    // ===============================================================================
    /**
     * Fait la mise à jour des informations clients_locations longitude et latitude 
     *
     * @param  int  $id $latitude  $longitude du client 
     * @return \Illuminate\Http\Response
     */
    public function APIclients_locationsUpdate($id, $latitude, $longitude)
    {
/*         if (auth()->guest()) {
        return redirect('/connexion')->withErrors([
            'email' => "Vous devez être connecté pour voir cette page.",
        ]);
        }*/

        $infosClient = clientsLocation::where('clientId','=', $id);
        $infosClient->update([
            'clientLatitude' => $latitude,
            'clientLongitude' => $longitude
        ]);

        $infos = clientsLocation::where('clientId','=', $id);
        $message = "Modifier avec succsès! INFOS: LAT=".$latitude." LOG=".$longitude;
        return $message;
    }

// clientId clientNumero clientTicket nbClientAvant tAttenteEstime clientLatitude clientLongitude




    // ===============================================================================
    /**
     * Fait la mise à jour des informations clients_locations longitude et latitude 
     *
     * @param  int  $id $latitude  $longitude du client 
     * @return \Illuminate\Http\Response
     */
    public function AdminVewClientLocation()
    {

        $infosClients = clientsLocation::all();
// dd($infosClients);
        return view('clientsLocation',compact('infosClients'));
    }

// clientId clientNumero clientTicket nbClientAvant tAttenteEstime clientLatitude clientLongitude







    // ===============================================================================
    /**
     * Fait la mise à jour des informations clients_locations longitude et latitude 
     *
     * @param  int  id latitude  longitude du client 
     * @return \Illuminate\Http\Response
     */
    public function APIMarqueurs()
    {

        $infosClients = clientsLocation::all();
        $coordonnees = array();
        $i=0;
        foreach ($infosClients as $client) {
            $coordonnees[$i++] =  [
                '0' => $client->clientId,
                '1' => $client->clientNumero,
                '2' => $client->clientTicket,
                '3' => $client->nbClientAvant,
                '4' => $client->tAttenteEstime,
                '5' => $client->nom,
                '6' => $client->prenom,
                '7' => $client->genre,
                '8' => $client->clientLatitude,
                '9' => $client->clientLongitude
            ];
        }
        return $coordonnees;
    }
// clientId clientNumero clientTicket nbClientAvant tAttenteEstime clientLatitude clientLongitude
 // clientId clientNumero clientTicket nbClientAvant tAttenteEstime nom prenom genre clientLatitude clientLongitude


}// FIN CLASS
