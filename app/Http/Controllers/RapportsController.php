<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RapportsController extends Controller
{
	public function index()
	{

		$a = <<<EOL
		<h1>Rapport style wainting</h1>
		Renvoie des rapport quotidienne
		Renvoie des rapport Mensuelle
		Renvoie des rapport hebdomadaire
		   jjdj 

		EOL;

		return $a;
	}
	
}