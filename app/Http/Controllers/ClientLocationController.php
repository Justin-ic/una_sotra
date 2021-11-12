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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ReconnectionClient(Request $request)
    {

        $infosClient = clientsLocation::where('clientNumero','=', $request->numero)
                                  ->where('clientTicket','=', $request->ticket)
                                  ->get()
                                  ->first();
        // dd($infosClient->created_at); infosClient
        if ($infosClient == null ) {
            ?><!--  <script type="text/javascript">
                alert('Il semble que ce ticket ne vous appartient pas !');
            </script> -->
            <?php

            // return redirect()->route('clientBienvenue');
            return back()->withErrors('Il semble que ce ticket ne vous appartient pas !');
        } else {
            session_start();
            $_SESSION['idClient'] = $infosClient->clientId;

            return view('clientTicket',compact('infosClient'));
        }
        


    }





    /**
     * Retourne: 
     * le nombre de clients restant en temps réel,
     * le temps d'attente estimé au départ en seconde,
     * la date de création donc d'enregistrement du client en seconde.
     *  
     * API appeler dans la page clientsTiket chaque 2 minutes.
     * 
     *
     * @param  int  $idClient 
     * @return \Illuminate\Http\Response 
     */
    public function ApiTempsRestantReel($idClient)
    {
$dd = date("Y-m-d");

     $donneesClient = clientsLocation::where('clientId','=', $idClient)
                                       ->where('created_at', '>', $dd.' 00:00:00')
                                       ->first();
     // dd($donneesClient->nbClientAvant);
     $infosClients = array();
     $infosClients[0] = $donneesClient->nbClientAvant;
     $infosClients[1] = strtotime($donneesClient->tAttenteEstime);
     $infosClients[2] = strtotime($donneesClient->created_at);
     
       return $infosClients;

    }






    // ===============================================================================
    /**
     * Fait la mise à jour des informations clients_locations longitude et latitude 
     *
     * @param  int  $id $latitude  $longitude du client 
     * @return \Illuminate\Http\Response
     */
    public function APIclients_locationsUpdate($id, $latitude, $longitude, $distance)
    {

        $infosClient = clientsLocation::where('clientId','=', $id);
        $infosClient->update([
            'clientLatitude' => $latitude,
            'clientLongitude' => $longitude,
            'distance' => $distance
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
                '9' => $client->clientLongitude,
                '10' => $client->distance
            ];
        }
        return $coordonnees; 
    }
// clientId clientNumero clientTicket nbClientAvant tAttenteEstime clientLatitude clientLongitude
 // clientId clientNumero clientTicket nbClientAvant tAttenteEstime nom prenom genre clientLatitude clientLongitude




    // ===============================================================================
    /**
     * Fait la mise à jour des informations clients_locations longitude et latitude 
     *
     * @param  int  $id $latitude  $longitude du client 
     * @return \Illuminate\Http\Response
     */
    public function APIEnLigne($idClient)
    {

/*     if (auth()->guest()) {   // Retourne vrai si le client n'est pas conneté
        return redirect('/connexion')->withErrors([
            'email' => "Vous devez être connecté pour voir cette page.",
        ]);
        }
*/

            $data = clientsLocation::where('clientId','=',$idClient)->first();
            
            // echo "Le id==".$idClient."==";
            // S'il est ligne dans dans les 20 dernières minutes
            $temps_actuel = date('U');
            $tempsEcouler = $temps_actuel - strtotime($data->updated_at);
            // echo '<br>temps_actuel= '.$temps_actuel;
            // echo '<br>updated_at= '.strtotime($data->updated_at);

            // echo '<br>distance= '.$data->distance;
            $LaDistance = round($data->distance);
            $LaDistance = intval($LaDistance);

            // dd($LaDistance);
            if ($tempsEcouler < 20) {

                // Il est en ligne. S'il est à coté, on le prend 05 84 01 84 40 N 07 69 11 99 15
                if ($data->distance < 100) {
                    return "Dans la file ! dd=".$LaDistance."m";
                } else {
                    return "Pas dans la file ! dd=".$LaDistance."m";
                }
                
            } else {
                // Il n'est connecté mais ne fait pas de mise à jour
                if (auth()->check()) { // Retourne vrai si le client est conneté
                    return 'Localisation non autoriée';
                }else {
                    // if($data->distance == null || $data->distance == "")
                    // return 'Non Connecté !'.$tempsEcouler;
                    return 'Non Connecté !';
                }

                // return '?????';
            }


    }

// clientId clientNumero clientTicket nbClientAvant tAttenteEstime clientLatitude clientLongitude



    /**
     * afficher le formulaire pour deffinir l'IP du ESP
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function EditeIPESP8266()
    {
        return view('formulaires.IpEsp8266');
    }


    /**
     * Ecrit l'IP du ESP dans IpEsp8266.txt
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function StoreIPESP8266(Request $request)
    {
        $fichier = fopen('temporaires/IpEsp8266.txt', 'w+');
        $ip = $request->ip;
        $ip = preg_replace("#\n|\t|\r#","",$ip);

        fwrite($fichier, $ip );
        fclose($fichier);
        return view('bienVenusAdmin');
    }




    /**
     * Retourne l'IP du ESP qui est dans le fichier IpEsp8266.txt
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function API_IPESP8266()
    {
        $fichier = fopen('temporaires/IpEsp8266.txt', 'r');

        $ip = fgets($fichier);
        $ip = preg_replace("#\n|\t|\r#","",$ip);
        fclose($fichier);

        return $ip;
    }




}// FIN CLASS
