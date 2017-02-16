<?php

namespace App\Http\Controllers;

use App\metier\Reunion;
use Request;
use DateTime;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Facades\Input;

class ReunionController extends Controller {
    
    public function ajoutReunion(){
        return view('/Reunion/formAjoutReunion');
    }
}