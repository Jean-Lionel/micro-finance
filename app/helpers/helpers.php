<?php

use MercurySeries\Flashy\flashy;


define('TENU_COMPTE_MENSUELLE', 500);


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
	
	return number_format($number, 2, ',', ' ');
}


function testLionel(){
	return "JEAN";
}