<?php

use App\Models\User;
use MercurySeries\Flashy\flashy;
define('TENU_COMPTE_MENSUELLE', 500);
define('NOMBRE_AGENCE', 3);
function get_user_ById($id){
	$user = User::find($id);
	return $user->first_name . " " . $user->last_name;
}
function set_active_router($route){
	return Route::is($route) ? 'active' : '';
}
function pageTitle($title){
	$base_title = config('app.name') .  ' - coopdi | manager';
	if($title)
		return $title . ' | ' . $base_title;
	return 	$base_title;
}
function successMessage($message = 'Opération réussi'){
	  flashy()->success($message);
}
function errorMessage($message = 'Opération echoué'){
	  flashy()->error($message);
}
function warningMessage($message = 'Opération echoué'){
	  flashy()->warning($message);
}
//Formatage des chiffres 
function numberFormat($number){
	return number_format($number,2, ',', ' ');
}

function dateFormat($date){
	$noTime = (date('H:i:s', strtotime($date)) == '00:00:00');
	if($noTime)
		return date('d/m/Y', strtotime($date));

	return  date('d/m/Y à H:i:s', strtotime($date));
}
function testLionel(){
	dump();
	return "JEAN";
}
///testLionel();