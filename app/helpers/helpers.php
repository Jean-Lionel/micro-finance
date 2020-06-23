<?php

use MercurySeries\Flashy\flashy;



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


function testLionel(){
	return "JEAN";
}