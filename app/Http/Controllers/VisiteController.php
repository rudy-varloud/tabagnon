<?php

namespace App\Http\Controllers;

use App\metier\Visiteur;
use App\metier\Visite;
use App\metier\Ligne_visite;
use App\metier\Date_visite;
use App\metier\Conference;
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
        $idGuide = null;
        return view('formAjoutVisite', compact('mesVisiteurs', 'cpt', 'idGuide'));
    }

    public function postFormVisite() {
        $formCheck = Request::input('formCheck');
        if ($formCheck != 1) {
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
                $date = Request::input("date" . $cpt);
                $heure = Request::input("heure" . $cpt);
                $datetime = $date . " " . $heure;
                $uneDateVisite->addDate($id, $datetime);
                $cpt -= 1;
            }
            return view('pageAdmin', compact('mesVisites'));
        } else {
            $nomVisite = Request::input('nomVisite');
            $lieuxVisite = Request::input('lieuxVisite');
            $descVisite = Request::input('description');
            $prixVisite = Request::input('prix');
            $nbPlaceVisite = Request::input('nbPlace');
            $prenomUser = Request::input('prenomGuideMan');
            $nomUser = Request::input('nomGuideMan');
            $mdp_encyrpt = encrypt($nomUser);
            $unVisiteur = new Visiteur();
            $idGuide = $unVisiteur->subGuideMan($prenomUser, $nomUser, $mdp_encyrpt);
            $cpt = Request::input('cpt');
            $mesVisiteurs = $unVisiteur->getVisiteurGuide();
            return view('formAjoutVisite', compact('nomVisite','descVisite','prixVisite','nbPlaceVisite','lieuxVisite','idGuide', 'cpt', 'mesVisiteurs'));
        }
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
        $ligneVisite = new Ligne_visite();
        $nbPlace = $Visite->nbPlace($idVisite);
        $nbPlaceRes = $DateVisite->nbPlaceRes($idVisite, $dateVisite);
        $idVisiteur = Session::get('id');
        $alerte = $ligneVisite->checkReservation($idVisite,$dateVisite,$idVisiteur);
        $nbPlaceDispo = $nbPlace - $nbPlaceRes;
        return view('postPageVisiteSpe', compact('nbPlaceDispo', 'dateVisite', 'idVisite','alerte'));
    }

    public function postReservationPlace() {
        $nbPlaceSouhaite = Request::input('nbPlaceVoulu');
        $dateVisite = Request::input('dateVisite');
        $idVisite = Request::input('idVisite');
        $idVisiteur = Session::get('id');
        $uneVisite = new Date_visite();
        $uneVisite->reservationPlace($idVisite, $nbPlaceSouhaite, $dateVisite);
        $uneLigneVisite = new Ligne_visite();
        $uneLigneVisite->reservationPlace($idVisite, $idVisiteur, $nbPlaceSouhaite, $dateVisite);
        return redirect('/accueil');
    }

    public function getVisiteReservation($idVisite) {
        $Visites = new Visite();
        $mesVisites = $Visites->pageVisiteSpe($idVisite);
        $Visite = new Visite();
        $uneVisite = $Visite->getVisite($idVisite);
        $lesReservations = null;
        return view('ficheVisite', compact('lesReservations', 'uneVisite', 'mesVisites'));
    }

    public function getReservation() {
        $dateVisite = Request::input('dateVisite');
        $idVisite = Request::input('idVisite');
        $VisiteRes = new Ligne_visite();
        $lesReservations = $VisiteRes->getReservations($dateVisite, $idVisite);
        $Visites = new Visite();
        $mesVisites = $Visites->pageVisiteSpe($idVisite);
        $Visite = new Visite();
        $uneVisite = $Visite->getVisite($idVisite);
        return view('ficheVisite', compact('lesReservations', 'uneVisite', 'mesVisites'));
    }

    public function mesReservations($idVis) {
        $uneConference = new Conference();
        $mesConferences = $uneConference->getConfUser($idVis);
        $uneVisite = new Visite();
        $mesVisites = $uneVisite->getVisiteUser($idVis);
        return view('listeReservation', compact('mesConferences', 'mesVisites'));
    }

    public function annulerVis() {
        $idVisite = Request::input('idVisite');
        $idVisiteur = Request::input('idVisiteur');
        $qteBillet = Request::input('qteBillet');
        $dateVisite = Request::input('dateVisite');
        $uneDateVisite = new Date_visite();
        $uneLigneVisite = new Ligne_visite();
        $uneLigneVisite->annulerVis($idVisite, $idVisiteur, $dateVisite);
        $uneDateVisite->rajoutBillet($idVisite, $dateVisite, $qteBillet);
        $uneConference = new Conference();
        $mesConferences = $uneConference->getConfUser($idVisiteur);
        $uneVisite = new Visite();
        $mesVisites = $uneVisite->getVisiteUser($idVisiteur);
        return view('listeReservation', compact('mesConferences', 'mesVisites'));
    }

}
