<?php

namespace App\Http\Controllers;
use App\metier\Visiteur;
use App\metier\Visite;
use Request;
use Illuminate\Support\Facades\Session;
use Exception;
use  Illuminate\Support\Facades\Input;

class VisiteController extends Controller {
   
    public function ajoutVisite(){
        $unVisiteur = new Visiteur();
        $mesVisiteurs = $unVisiteur->getVisiteurGuide();
        return view('formAjoutVisite', compact('mesVisiteurs'));
    }
    
    public function postFormVisite(){
        $nomVisite = Request::input('nomVisite');
        $lieuxVisite = Request::input('lieuxVisite');
        $descVisite = Request::input('description');
        $dateVisite = Request::input('date');
        $prixVisite = Request::input('prix');
        $nbPlaceVisite = Request::input('nbPlace');
        $nomGuideVisite = Request::input('nomGuideVisite');
        $uneVisite = new Visite();
        $mesVisites = $uneVisite->postFormVisite($nomVisite, $lieuxVisite, $descVisite, $dateVisite, $prixVisite,
                $nbPlaceVisite, $nomGuideVisite);
        return view('pageAdmin', compact('mesVisites'));
    }
    
    public function pageVisite(){
        $uneVisite = new Visite();
        $mesVisites = $uneVisite->getVisite();
        return view('pageVisite', compact ('mesVisites'));
    }
    
    public function pageVisiteSpe($idVisite){
        $uneVisite = new Visite();
        $mesVisites = $uneVisite->pageVisiteSpe($idVisite);
        return view('pageVisiteSpe', compact('mesVisites'));
    }
    
    public function reservationPlace(){
        $nbPlaceSouhaite = Request::input('nbPlaceVoulu');
        $uneVisite = new Visite();
        $mesVisites = $uneVisite->reservationPlace($nbPlaceSouhaite);
        return view('pageAdmin');
    }
   
}
