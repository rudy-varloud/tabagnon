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
       $placeDispoConf = Request::input('placeDispoConf');
       $contenuConf = Request::input('contenu');
       $adresseConf = Request::input('adresseConf');
       $cpConf = Request::input('cpConf');
       $dateConf = Request::input('dateConf');
       $heureConf = Request::input('heureConf');
       $uneConf = new Conference();
       $mesConferences = $uneConf->postAjoutConf($nomConf, $prixConf, $placeDispoConf, $contenuConf, $adresseConf, $cpConf, $dateConf, $heureConf);
       return view('pageAdmin');
    }
    
    public function getConference(){
        $uneConference = new Conference();
        $mesConferences = $uneConference->getConference();
        return view('listeConference', compact ('mesConferences'));
    }
    
    public function getConferenceSpe($idConf){
        $uneConference = new Conference();
        $mesConferences = $uneConference->getConferenceSpe($idConf);
        return view('listeConfSpe', compact('mesConferences'));
    }
    
    public function postFromReserveConf(){
        $idVis = Session::get('id');
        $idConf = Request::input('idConf');
        $placeSouhaite = Request::input('placeSouhaite');
        $uneConference = new Conference();
        $mesConferences = $uneConference->postFromReserveConf($idConf, $placeSouhaite);
        $uneConference2 = new Conference();
        $mesConferences2 = $uneConference2->postLigneReserve($idVis, $idConf, $placeSouhaite);
        return redirect ('/accueil');
    }
    
    public function getUserConf($idConf){
        $uneConference = new Conference();
        $mesConferences = $uneConference->getUserConf($idConf);
        return view('listeUserConf', compact('mesConferences'));
    }
   
}