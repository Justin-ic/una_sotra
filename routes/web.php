<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\clientsController;
use App\Http\Controllers\descriptionsController;
use App\Http\Controllers\guichetsController;
use App\Http\Controllers\personnelsController;
use App\Http\Controllers\servicesController;
use App\Http\Controllers\bilanClientController;
use App\Http\Controllers\ClientLocationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





/*Route::get('/', function () {
    return view('welcome');
});*/


/*Organisation des routes

*/


//si on met le name space use \App\Http\Controllers\clientController; en haut, on passe un trableau de parametre


// LA ROUTE D'ACCUEIL. Elle est obligatoire sur ce format. Ainsi, elle oriente automatiquement l'accueil



// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!


/******************authentificationPersonnel*********************/
/*Route::get('/', function () {
    return view('formulaires.connexion');
})->name('connexion');*/

Route::get('/', [personnelsController::class,'initBD'])->name('connexion');

/*****************************authentificationPersonnel************************************/

/******************   initBDStore   *********************/
Route::post('storAdmin', [personnelsController::class,'initBDStore'])->name('storAdmin');

/*****************************   initBDStore   ************************************/


/******************   BienVenusAdmin   *********************/
// Route::get('BienVenusAdmin', [personnelsController::class,'BienVenusAdmin'])->name('BienVenusAdmin');

Route::get('bienVenusAdmin', function () {
                  ?> 
            <!-- <script type="text/javascript">
            alert('Je m apprête à afficher  bienVenusAdmin');
            </script> -->
            <?php
    return view('bienVenusAdmin');
})->name('bienVenusAdmin');
/*****************************   BienVenusAdmin   ************************************/
// bienVenusAdmin

/******************authentificationPersonnel*********************/
Route::get('deconnexion', [personnelsController::class,'deconnexion'])->name('deconnexion');

/*****************************authentificationPersonnel************************************/



/******************interfaeGuichetPersonnel********************  authentification*/ 
Route::POST('loginPersonnel', [personnelsController::class,'authentification'])->name('loginPersonnel');
/*****************************interfaeGuichetPersonnel************************************/


/******************interfaeGuichetPersonnel********************  authentification*/ 
Route::get('interfaceGuichetPersonnel', [clientsController::class,'ClientsNonServie'])->name('interfaceGuichetPersonnel');
/*****************************interfaeGuichetPersonnel************************************/


// On peut nommer une rooute en utilisant name('nom')
Route::get('homeAdmine', [clientsController::class,'index'])->name('homeAdmine'); 
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!



















                //     SI ON CLIQUE SUR UN BOUTON

/*****************************clients************************************/
Route::resource('clients', clientsController::class); 
// Dans ce cas, nous même, on ne nomme pas les routes car la nomination est faite automatiquement 
// Nom_route_Auto==clients.nom_méthode_du_controleur
// Finalement, on a une route pour les controller complexes (contenent plusieurs méthodes)


Route::post('clients/update_client/{id}', [clientsController::class,'update'])->name('update_client'); 
Route::get('clients/destroy_client/{id}', [clientsController::class,'destroy'])->name('destroy_client'); 

// Si on n'utilise pas ressource(), on sera obligé de définir une route pour chaque méthde du controller
/*****************************clients************************************/


/*****************************services************************************/
Route::resource('services', servicesController::class); 

Route::post('services/update_service/{id}', [servicesController::class,'update'])->name('update_service');
Route::get('services/destroy_service/{id}', [servicesController::class,'destroy'])->name('destroy_service'); 

/*****************************services************************************/


/*****************************personnels************************************/
Route::resource('personnels', personnelsController::class); 

Route::post('personnels/update_personnel/{id}', [personnelsController::class,'update'])->name('update_personnel');  
Route::get('personnels/destroy_personnel/{id}', [personnelsController::class,'destroy'])->name('destroy_personnel'); 
/*****************************personnels************************************/


/*****************************guichets************************************/
Route::resource('guichets', guichetsController::class); 

Route::post('guichets/update_guichet/{id}', [guichetsController::class,'update'])->name('update_guichet');
Route::get('guichets/destroy_guichet/{id}', [guichetsController::class,'destroy'])->name('destroy_guichet'); 
/*****************************guichets************************************/


/*****************************descriptions************************************/
Route::resource('descriptions', descriptionsController::class); 

Route::post('descriptions/update_description/{id}', [descriptionsController::class,'update'])->name('update_description');
Route::get('descriptions/destroy_description/{id}', [descriptionsController::class,'destroy'])->name('destroy_description'); 
/*****************************descriptions************************************/


/*****************************descriptions************************************/
Route::resource('bilan_clients', bilanClientController::class); 

Route::post('bilan_clients/update_bilan_clients/{id}', [personnelsController::class,'update'])->name('update_bilan_clients');
Route::get('bilan_clients/destroy_bilan_clients/{id}', [personnelsController::class,'destroy'])->name('destroy_bilan_clients'); 
/*****************************descriptions************************************/





                        /*+++++++++++++  CONNEXION ETUDIANT +++++++++++++*/

/*****************************clientBienvenue: connexion etudiant**********************************/
Route::get('clientBienvenue', [clientsController::class,'clientConnexion'])->name('clientBienvenue');
/*****************************clientBienvenue************************************/

/*****************************clientBienvenue: connexion etudiant**********************************/
Route::post('Connexion', [clientsController::class,'Connexion'])->name('loginClient');
/*****************************clientBienvenue************************************/

                        /*+++++++++++++  CONNEXION ETUDIANT +++++++++++++*/


/***************************** choix client **********************************/
Route::get('demandeEtudiant/{idEtu}', [servicesController::class,'ListeService'])->name('demandeEtudiant');
/*****************************  choix client ************************************/


/******************autoEnregistreClient*********************/
Route::get('autoEnregistreClient/{idService}/{idEtu}', [servicesController::class,'LeServiceDemander'])->name('autoEnregistreClient');

/*****************************autoEnregistreClient************************************/


/******************clientTicket***********************************************/
Route::POST('clientTicket', [clientsController::class,'autoSotreClient'])->name('clientTicket');
/*****************************clientTicket************************************/



/******************InterfaceclientTicket***********************************************/
Route::get('clientTicketInterface/{idClient}', [ClientLocationController::class,'ApiTempsRestantReel']);
/*****************************InterfaceclientTicket************************************/



/******************InterfaceclientTicket***********************************************/
Route::post('clientTicketInterface', [ClientLocationController::class,'ReconnectionClient'])->name('reConnectClient');
/*****************************InterfaceclientTicket************************************/


/******************clientAppele*********************/

Route::get('clientAppele', function () {
    return view('clientAppele');
})->name('clientAppele');
/*****************************clientAppele************************************/


/******************clientInfoFile*********************/

Route::get('clientInfoFile', function () {
    return view('clientInfoFile');
})->name('clientInfoFile');
/*****************************clientInfoFile************************************/



/******************ClientSuivant*********************/ 
Route::POST('clientSuivant/{id}', [clientsController::class,'clientSuivant'])->name('clientSuivant');
/*****************************ClientSuivant************************************/



/******************clientInfoFile*********************/
Route::get('APIclientInfoFile', [clientsController::class,'clientDuJour'])->name('APIclientInfoFile');
/*****************************clientInfoFile************************************/



/******************clientInfoFile*********************/
Route::get('APIclientAppel', [clientsController::class,'APIclientAppel'])->name('APIclientAppel');
/*****************************clientInfoFile************************************/




/******************API_clients_locationsUpdate*********************/
Route::get('ClientLocation/{id}/{latitude}/{longitude}/{distance}', [ClientLocationController::class,'APIclients_locationsUpdate'])->name('APIclients_locationsUpdate');
/*****************************API_clients_locationsUpdate************************************/




/******************API_AdminVewClientLocation********************/
Route::get('AdminVewClientLocation', [ClientLocationController::class,'AdminVewClientLocation'])->name('AdminVewClientLocation');
/*****************************API_AdminVewClientLocation***********************************/





/******************clientDeconnecter********************/
Route::get('clientDeconnecter', [clientsController::class,'clientDeconnecter'])->name('clientDeconnecter');
/*****************************clientDeconnecter***********************************/





/******************APIMarqueurs********************/ 
Route::get('APIMarqueurs', [ClientLocationController::class,'APIMarqueurs'])->name('APIMarqueurs');
/*****************************APIMarqueurs***********************************/



/******************APIEnLigne********************/
Route::get('APIEnLigne/{idClient}', [ClientLocationController::class,'APIEnLigne'])->name('APIEnLigne');
/*****************************APIEnLigne***********************************/




/****************** Route général pour ClientLocationController ************************/
Route::resource('ClientLocation', ClientLocationController::class); 
/****************** Route général pour ClientLocationController ************************/





/******************Definir_IP_ESP8266********************/
Route::get('EditeIPESP8266', [ClientLocationController::class,'EditeIPESP8266'])->name('EditeIPESP8266');
/*****************************Definir_IP_ESP8266***********************************/



/******************Definir_IP_ESP8266********************/
Route::POST('StoreIPESP8266', [ClientLocationController::class,'StoreIPESP8266'])->name('StoreIPESP8266');
/*****************************Definir_IP_ESP8266***********************************/



/******************API_IPESP8266********************/
Route::get('API_IPESP8266', [ClientLocationController::class,'API_IPESP8266'])->name('API_IPESP8266');
/*****************************API_IPESP8266***********************************/


/*

// ENCAPSULATION DES DONNES
 $Conf = "Conf";
 if (is_dir($Conf)) {
    
 }else{mkdir($Conf);}

$MOISCORRIGE = "Conf/MOIS_CORRIGE";                                     
 if (is_dir($MOISCORRIGE)) {
    
 }else{mkdir($MOISCORRIGE);}





*/