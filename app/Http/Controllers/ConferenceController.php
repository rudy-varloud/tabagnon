<?php

namespace App\Http\Controllers;
use App\metier\Conference;
use Request;
use Illuminate\Support\Facades\Session;
use Exception;
use  Illuminate\Support\Facades\Input;

class ConferenceController extends Controller {
    
    public function ajoutConference(){
        return view('formAjoutConference');
    }
    
   
}