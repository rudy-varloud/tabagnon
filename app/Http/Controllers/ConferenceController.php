<?php

namespace App\Http\Controllers;
use App\metier\Conference;
use App\metier\Visite;
use App\metier\Ligne_conference;
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
       $date = Request::input('date');
       $heure = Request::input('heure');
       $datetime = $date." ".$heure;
       $uneConf = new Conference();
       $uneConf->postAjoutConf($nomConf, $prixConf, $placeDispoConf, $contenuConf, $adresseConf, $cpConf, $datetime);
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
        $uneConference->postFromReserveConf($idConf, $placeSouhaite);
        $uneConference->postLigneReserve($idVis, $idConf, $placeSouhaite);
        return redirect ('/accueil');
    }
    
    public function getUserConf($idConf){
        $uneConference = new Conference();
        $mesConferences = $uneConference->getUserConf($idConf);
        return view('listeUserConf', compact('mesConferences'));
    }
    
    public function annulerConf(){
        $idVis = Request::input('idVis');
        $idConf = Request::input('idConf');
        $qteBillet = Request::input('qteBillet');
        $uneConference = new Conference();
        $uneLigneConference = new Ligne_conference();
        $uneLigneConference->annulerConf($idConf,$idVis);
        $uneConference->rajoutBillet($idConf,$qteBillet);
        $mesConferences = $uneConference->getConfUser($idVis);
        $uneVisite = new Visite();
        $mesVisites = $uneVisite->getVisiteUser($idVis);
        return view('listeReservation', compact('mesConferences', 'mesVisites'));
    }
    public function modifierPlaceConf(){
        $idVis = Request::input('idVis');
        $idConf = Request::input('idConf');
        $qteBillet = Request::input('qteBillet');
        $placeRes = Request::input('nbPlaceRes');
        $uneConference = new Conference();
        $uneLigneConference = new Ligne_conference();
        $uneLigneConference->modifierPlaceConf($idConf,$idVis,$qteBillet);
        $uneConference->modifierPlaceLibre($idConf,$qteBillet,$placeRes);
        $mesConferences = $uneConference->getConfUser($idVis);
        $uneVisite = new Visite();
        $mesVisites = $uneVisite->getVisiteUser($idVis);
        return view('listeReservation', compact('mesConferences', 'mesVisites'));
    }
    
    public function modifConf($idConf){
        $uneConference = new Conference();
        $mesConferences = $uneConference->modifConf($idConf);
        return view('pageModifConf', compact('mesConferences'));
    }
    
    public function postModifAjoutConf(){
        $id = Request::input('id');
        $nom = Request::input('nomConf');
        $prix = Request::input('prixConf');
        $place = Request::input('placeDispoConf');
        $contenu = Request::input('contenu');
        $adresseConf = Request::input('adresseConf');
        $cpConf = Request::input('cpConf');
        $date = Request::input('date');
        $heure = Request::input('heure');
        
        $uneConference = new Conference();
        $mesConferences = $uneConference->postModifAjoutConf($id, $nom, $prix, $place, $contenu, $adresseConf, $cpConf, $date, $heure);
        return redirect('/getPageConference');
    }
    
    public function supprConf($idConf){
        $uneConference = new Conference();
        $mesConferences = $uneConference->supprConf($idConf);
        return redirect('/getPageConference');
    }
   
}