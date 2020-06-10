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

Route::permanentRedirect('/', '/clients');

Route::resource('clients','ClientController');
Route::resource('operations','OperationController');
Route::resource('comptes','CompteController');
Route::resource('placements','PlacementController');
Route::resource('decouverts','DecouvertController');
Route::resource('reboursement-decouverts','ReboursementDecouvertController');

Route::get('comptes/ajouter/{id}', 'CompteController@createCompte')->name('create_compte');
