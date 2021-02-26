<?php



/**
 * 
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KirimbaRapportController extends Controller
{
	
	public function index(){

		return view("kirimba.rapport");

	}

	public function history(){
		return view("kirimba.kirimbaHistory");
	}
}