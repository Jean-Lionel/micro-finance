<?php

function set_active_router($route){
	return Route::is($route) ? 'active' : 'dark';
}

function pageTitle($title){
	$base_title = config('app.name') .  ' - coopdi | manager';

	if($title)
		return $title . ' | ' . $base_title;
	return 	$base_title;
	
}

function hello(){
	return 'Hacked';
}