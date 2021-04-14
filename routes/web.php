<?php


use Illuminate\Support\Facades\Route;

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



//Route::permanentRedirect('/', '/home');

Route::get('/','DashboardController@index');



Route::resource('clients','ClientController');
Route::resource('operations','OperationController');
Route::resource('comptes','CompteController');

Route::get('comptes/ajouter/{id}', 'CompteController@createCompte')->name('create_compte');
Route::resource('placements','PlacementController');
Route::resource('decouverts','DecouvertController');
Route::resource('tenuecomptes','TenueCompteController');
Route::resource('placementPaiement','PlacementPaimentController');
Route::resource('rapports','RapportsController');
Route::get('userOperation','RapportsController@userOperation')->name('user_oparation');
Route::resource('reboursement-decouverts','ReboursementDecouvertController');
Route::namespace('Controllers')->prefix('app')->group(function(){
});
//Admin Router
Route::namespace('Admin')->prefix('admin')
->middleware('can:manager-user')->group(function(){
	Route::resource('users', 'UsersController');
});

//Fin admin Router

Route::get('find_decouvert', 'ReboursementDecouvertController@ajaxfindDecouvert')->name('find_decouvert');

Auth::routes();

Route::get('/home', 'DashboardController@index')->name('home');

Route::get('pdf','PDFController@generatePDF');

Route::get('depense',function(){

	return view('depenses.depenses');
});




Route::get('finaliser/{placement}','PlacementController@finaliser')->name('finaliser');

//ajax Router

Route::get('client_by_compte_name','CompteController@getClientCompteName')->name('client_by_compte_name');

Route::get('client_by_compte_placement_name','ComptePlacementController@getClientCompteName')->name('client_by_compte_placement_name');

Route::get('find_rapport','RapportsController@rapport')->name('rapport');
Route::get('tenueMensuelle','TenueCompteController@tenueMensuelle')->name('tenueMensuelle');
Route::get('historique_compte','CompteController@getHisotirique')->name('historique_compte');

Route::get('operation_details', 'OperationController@operation_details')->name('operation_details');


//Fin ajax router

Route::resource('posts', 'PostController');

//Route pour le placement

Route::resource('placement-client','PlacementClientController');

//IKIRIMBA PROJECT 

Route::get('ikirimba-membre', 'KirimbaMembreController@index')->name('ikirimba-membre');

Route::get('ikirimba-operation', 'KirimbaOperationController@index')->name('ikirimba-operation');

Route::get('ikirimba-rapport', 'KirimbaRapportController@index')->name('ikirimba-rapport');
Route::get('ikirimba-history', 'KirimbaRapportController@history')->name('ikirimba-history');

Route::get('kirimba-rapport-dette', 'KirimbaRapportController@rapportKirimba')->name('kirimba-rapport-dette');

//GESTION DES AGANCES 

Route::get('agences', 'AgenceController@index');

