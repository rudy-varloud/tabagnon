<?php

namespace App\Http\Controllers;

use App\metier\Avis_visite;
use App\metier\Avis_conference;
use App\metier\Visite;
use App\metier\Ligne_visite;
use App\metier\Date_visite;
use App\metier\Conference;
use Request;
use DateTime;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Facades\Input;

class HistoriqueController extends Controller {

    /* 
     * Créer l'appel pour récupèrer l'historique des visites/conférences
     * d'un utilisateur
     */
    public function monHistorique() {
        $idVis = Session::get('id');
        $uneConference = new Conference();
        $mesConferences = $uneConference->getConfUserEffec($idVis);
        $uneVisite = new Visite();
        $mesVisites = $uneVisite->getVisiteUserEffec($idVis);
        $avisVis = new Avis_visite();
        $mesAvisVis = $avisVis->getAvisVisite($idVis);
        $avisConf = new Avis_conference();
        $mesAvisConf = $avisConf->getAvisConference($idVis);
        return view('Reservation_Historique/historique', compact('mesConferences', 'mesVisites', 'mesAvisVis', 'mesAvisConf'));
    }

    /* 
     * Créer l'appel pour récupèrer les données du formulaire d'avis d'une visite
     * Vérifie si l'avis pour cette visite n'existe pas déja :
     * S'il existe, crér l'appel pour modifier l'avis
     * S'il n'existe pas, créer l'appel pour ajouter l'avis
     */
    public function avisVisite() {
        $cpt = Request::input('cptVisite');
        $avis = Request::input('avisV' . $cpt);
        $note = Request::input('noteV' . $cpt);
        $idVisite = Request::input('idVisite');
        $dateVisite = Request::input('dateVisite');
        $idVisiteur = Session::get('id');
        $avisVisite = new Avis_visite();
        $existance = $avisVisite->checkAvis($idVisite, $idVisiteur, $dateVisite);
        if ($existance) {
            $avisVisite->updateAvis($idVisite, $idVisiteur, $dateVisite, $note, $avis);
        } else {
            $avisVisite->addAvis($idVisite, $idVisiteur, $dateVisite, $note, $avis);
        }
        return redirect('/monHistorique/');
    }

    /* 
     * Créer l'appel pour récupèrer les données du formulaire d'avis d'une conférence
     * Vérifie si l'avis pour cette conférence n'existe pas déja :
     * S'il existe, crér l'appel pour modifier l'avis
     * S'il n'existe pas, créer l'appel pour ajouter l'avis
     */
    public function avisConference() {
        $cpt = Request::input('cptConf');
        $avis = Request::input('avisC' . $cpt);
        $note = Request::input('noteC' . $cpt);
        $idConf = Request::input('idConf');
        $idVisiteur = Session::get('id');
        $avisConf = new Avis_conference();
        $existance = $avisConf->checkAvis($idConf, $idVisiteur);
        if ($existance) {
            $avisConf->updateAvis($idConf, $idVisiteur, $note, $avis);
        } else {
            $avisConf->addAvis($idConf, $idVisiteur, $note, $avis);
        }
        return redirect('/monHistorique/');
    }

    /* 
     * Créer l'appel pour récupèrer l'ensemble des avis 
     */
    public function getAvis() {
        $Visite = new Visite();
        $Conference = new Conference();
        $avisVisite = new Avis_visite();
        $avisConference = new Avis_conference();
        $lesVisites = $Visite->getVisitesEffec();
        $placeVisites = $Visite->getPlaceRes();
        $lesConferences = $Conference->getConferencesEffec();
        $lesAvisVisite = $avisVisite-> getAvisVisites();
        $lesAvisConference = $avisConference->getAvisConferences();
        return view('Reservation_Historique/statistiquesAvis',compact('lesVisites','placeVisites','lesAvisVisite','lesConferences','lesAvisConference'));
    }

}
