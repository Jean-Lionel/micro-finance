<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgenceController extends Controller
{
    //
    public function index() {
    	return view("agences.index");
    }
    public function gestion(){
    	return view("agences.gestion");
    }
    public function caissier(){
    	return view("caissiers.index");
    }
    public function historique($id){
        $post = $id;
        return view("caissiers.historique", compact('post'));
    }
}
