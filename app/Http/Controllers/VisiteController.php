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
   
}
