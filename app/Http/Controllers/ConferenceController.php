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
    
    public function postFormAjoutConf(){
       $nomConf = Request::input('nomConf');
       $prixConf = Request::input('prixConf');
       $contenuConf = Request::input('contenu');
       $adresseConf = Request::input('adresseConf');
       $cpConf = Request::input('cpConf');
       $dateConf = Request::input('dateConf');
       $heureConf = Request::input('heureConf');
       $uneConf = new Conference();
       $mesConferences = $uneConf->postAjoutConf($nomConf, $prixConf, $contenuConf, $adresseConf, $cpConf, $dateConf, $heureConf);
       return view('pageAdmin');
    }
    
    public function getConference(){
        $uneConference = new Conference();
        $mesConferences = $uneConference->getConference();
        return view('listeConference', compact ('mesConferences'));
    }
    
   
}