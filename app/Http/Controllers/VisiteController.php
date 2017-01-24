<?php

namespace App\Http\Controllers;

use App\metier\Visiteur;
use App\metier\Visite;
use App\metier\Ligne_visite;
use App\metier\Date_visite;
use Request;
use DateTime;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Facades\Input;

class VisiteController extends Controller {

    public function ajoutVisite() {
        $cpt = Request::input('nbDate');
        $unVisiteur = new Visiteur();
        $mesVisiteurs = $unVisiteur->getVisiteurGuide();
        return view('formAjoutVisite', compact('mesVisiteurs', 'cpt'));
    }

    public function postFormVisite() {
        $nomVisite = Request::input('nomVisite');
        $lieuxVisite = Request::input('lieuxVisite');
        $descVisite = Request::input('description');
        $prixVisite = Request::input('prix');
        $nbPlaceVisite = Request::input('nbPlace');
        $idGuideVisite = Request::input('idGuideVisite');
        $uneVisite = new Visite();
        $id = $uneVisite->postFormVisite($nomVisite, $lieuxVisite, $descVisite, $prixVisite, $nbPlaceVisite, $idGuideVisite);
        $cpt = Request::input('cpt');
        $uneDateVisite = new Date_visite();
        While ($cpt > 0) {
            $date = new DateTime(trim(Request::input($cpt)));
            $date = $date->format('Y-m-d');
            $uneDateVisite->addDate($id, $date);
            $cpt -= 1;
        }
        return view('pageAdmin', compact('mesVisites'));
    }

    public function pageVisite() {
        $uneVisite = new Visite();
        $mesVisites = $uneVisite->getVisites();
        return view('pageVisite', compact('mesVisites'));
    }

    public function pageVisiteSpe($idVisite) {
        $Visites = new Visite();
        $mesVisites = $Visites->pageVisiteSpe($idVisite);
        return view('pageVisiteSpe', compact('mesVisites'));
    }

    public function reservationPlace() {
        $idVisite = Request::input('idVisite');
        $dateVisite = Request::input('dateVisite');
        $Visite = new Visite();
        $DateVisite = new Date_visite();
        $nbPlace = $Visite->nbPlace($idVisite);
        $nbPlaceRes = $DateVisite->nbPlaceRes($idVisite, $dateVisite);
        $nbPlaceDispo = $nbPlace - $nbPlaceRes;
        return view('postPageVisiteSpe', compact('nbPlaceDispo', 'dateVisite', 'idVisite'));
    }

    public function postReservationPlace() {
        $nbPlaceSouhaite = Request::input('nbPlaceVoulu');
        $dateVisite = Request::input('dateVisite');
        $idVisite = Request::input('idVisite');
        $uneVisite = new Date_visite();
        $uneVisite->reservationPlace($idVisite, $nbPlaceSouhaite, $dateVisite);
        return redirect('/accueil');
    }
    
    public function getVisiteReservation($idVisite) {
        $Visites = new Visite();
        $mesVisites = $Visites->pageVisiteSpe($idVisite);
        $Visite = new Visite();
        $uneVisite = $Visite->getVisite($idVisite);
        $lesReservations = null;
        return view('ficheVisite',compact('lesReservations','uneVisite','mesVisites'));
    }
    
    public function getReservation() {
        $dateVisite = Request::input('dateVisite');
        $idVisite = Request::input('idVisite');
        $VisiteRes = new Ligne_visite();
        $lesReservations = $VisiteRes->getReservations($dateVisite,$idVisite);
        $Visites = new Visite();
        $mesVisites = $Visites->pageVisiteSpe($idVisite);
        $Visite = new Visite();
        $uneVisite = $Visite->getVisite($idVisite);
        return view('ficheVisite',compact('lesReservations','uneVisite','mesVisites'));
    }
    
}
