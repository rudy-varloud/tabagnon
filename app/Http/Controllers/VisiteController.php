<?php

namespace App\Http\Controllers;

use App\metier\Visiteur;
use App\metier\Ligne_visite;
use App\metier\Date_visite;
use App\metier\Visite;
use App\metier\Avis_visite;
use App\metier\Conference;
use App\metier\Carousel;
use App\metier\Article;
use Request;
use DateTime;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class VisiteController extends Controller {
    /*
     * Récupére le nombre de date lié à la création de la visite
     * et créer l'appel pour obtenir la liste des guides puis les renvoie
     * sur le formulaire d'ajout d'une visite
     */

    public function ajoutVisite() {
        $cpt = Request::input('nbDate');
        $unVisiteur = new Visiteur();
        $mesVisiteurs = $unVisiteur->getVisiteurGuide();
        $idGuide = null;
        return view('/Visite/formAjoutVisite', compact('mesVisiteurs', 'cpt', 'idGuide'));
    }

    /*
     * Récupèrer les données du formulaire d'ajout d'une visite
     * puis créer l'appel pour ajouter une visite
     */

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
            $message = "La visite a bien été ajoutée.";
            $mesVisites = $uneVisite->getVisites();
            $mesVisitesND = $uneVisite->getVisitesND();
            return view('/Visite/pageVisite', compact('mesVisites', 'mesVisitesND', 'message'));
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
            return view('/Visite/formAjoutVisite', compact('nomVisite', 'descVisite', 'prixVisite', 'nbPlaceVisite', 'lieuxVisite', 'idGuide', 'cpt', 'mesVisiteurs'));
        }
    }

    /*
     * Créer l'appel récupérer la liste de l'ensemble des visites non dépassées
     */

    public function pageVisite() {
        $uneVisite = new Visite();
        $mesVisites = $uneVisite->getVisites();
        $mesVisitesND = $uneVisite->getVisitesND();
        $message = "";
        return view('/Visite/pageVisite', compact('mesVisites', 'mesVisitesND', 'message'));
    }

    /*
     * Créer l'appel récupérer une visite particulière
     */

    public function pageVisiteSpe($idVisite) {
        $Visites = new Visite();
        $mesVisites = $Visites->pageVisiteSpe($idVisite);
        return view('/Visite/pageVisiteSpe', compact('mesVisites'));
    }

    /*
     * Récupère les données de reservation d'un place
     * puis vérifie si il reste assez de place 
     */

    public function reservationPlace() {
        $idVisite = Request::input('idVisite');
        $dateVisite = Request::input('dateVisite');
        $Visite = new Visite();
        $DateVisite = new Date_visite();
        $ligneVisite = new Ligne_visite();
        $nbPlace = $Visite->nbPlace($idVisite);
        $nbPlaceRes = $DateVisite->nbPlaceRes($idVisite, $dateVisite);
        $idVisiteur = Session::get('id');
        $alerte = $ligneVisite->checkReservation($idVisite, $dateVisite, $idVisiteur);
        $nbPlaceDispo = $nbPlace - $nbPlaceRes;
        return view('/Visite/postPageVisiteSpe', compact('nbPlaceDispo', 'dateVisite', 'idVisite', 'alerte'));
    }

    /*
     * Récupère les données d'ajout de reservation d'une place
     * et créer l'appel de reservation d'une place
     */

    public function postReservationPlace() {
        $nbPlaceSouhaite = Request::input('nbPlaceVoulu');
        $dateVisite = Request::input('dateVisite');
        $idVisite = Request::input('idVisite');
        $idVisiteur = Session::get('id');
        $unVisiteur = new Visiteur();
        $mail = $unVisiteur->getVisiteur($idVisiteur)->mailVis;
        $uneDateVisite = new Date_visite();
        $uneDateVisite->reservationPlace($idVisite, $nbPlaceSouhaite, $dateVisite);
        $uneLigneVisite = new Ligne_visite();
        $uneLigneVisite->reservationPlace($idVisite, $idVisiteur, $nbPlaceSouhaite, $dateVisite);
        $uneVisite = new Visite();
        $visite = $uneVisite->getVisite($idVisite);
        $title = "Votre réservation pour la visite : " . $visite->libelleVisite;
        $content = "je suis le contenu du mail";
        $data = ['uneVisite' => $visite, 'dateVisite' => $dateVisite, 'qteBillet' => $nbPlaceSouhaite, 'subject' => $title, 'content' => $content, 'email' => $mail];
        Mail::send('mailResVisite', $data, function($message) use($data) {

            $subject = $data['subject'];
            $message->from('tabagnon.saintgenis@gmail.com');
            $message->to($data['email'], $data['email'])->subject($subject);
        });
        $message = 'Votre réservation a été prise en compte. Un mail récapitulatif vous a été envoyé.';
        $unArticle = new Article();
        $lesArticles = $unArticle->getLastArticle();
        $Carousel = new Carousel;
        $lesImages = $Carousel->getImagesCarouselTrue();
        $uneConference = new Conference();
        $lesVisites = $uneVisite->getLastVisite();
        $lesConferences = $uneConference->getLastConference();
        return view('accueil', compact('lesArticles', 'lesImages', 'lesVisites', 'lesConferences', 'message'));
    }

    /*
     * Créer l'appel récupérer la liste des utilisateurs qui ont reservés
     * pour une visite 
     */

    public function getVisiteReservation($idVisite) {
        $Visites = new Visite();
        $mesVisites = $Visites->pageVisiteSpe($idVisite);
        $Visite = new Visite();
        $uneVisite = $Visite->getVisite($idVisite);
        $lesReservations = null;
        return view('/Visite/ficheVisite', compact('lesReservations', 'uneVisite', 'mesVisites'));
    }

    /*
     * Créer l'appel récupérer la liste des reservations pour une visite
     */

    public function getReservation() {
        $dateVisite = Request::input('dateVisite');
        $idVisite = Request::input('idVisite');
        $VisiteRes = new Ligne_visite();
        $lesReservations = $VisiteRes->getReservations($dateVisite, $idVisite);
        $Visite = new Visite();
        $mesVisites = $Visite->pageVisiteSpe($idVisite);
        $uneVisite = $Visite->getVisite($idVisite);
        return view('/Visite/ficheVisite', compact('lesReservations', 'uneVisite', 'mesVisites'));
    }

    /*
     * Créer l'appel récupérer la liste des reservations d'un utilisateur
     */

    public function mesReservations() {
        $idVis = Session::get('id');
        $uneConference = new Conference();
        $mesConferences = $uneConference->getConfUser($idVis);
        $uneVisite = new Visite();
        $mesVisites = $uneVisite->getVisiteUser($idVis);
        return view('Reservation_Historique/listeReservation', compact('mesConferences', 'mesVisites'));
    }

    /*
     * Créer l'appel pour supprimer une visite ainsi que les avis, les dates et les lignes qui y sont liés
     */

    public function supprimerVisEffec($idVisite) {
        $visite = new Visite();
        $avisVisite = new Avis_visite();
        $dateVisite = new Date_visite();
        $ligneVisite = new Ligne_visite();
        $dateVisite->supprimerDateEff($idVisite);
        $avisVisite->supprimerAvisEff($idVisite);
        $ligneVisite->supprimerLigneEff($idVisite);
        $visite->supprimerVisEff($idVisite);
        return redirect('/getAvis');
    }

    public function supprimerDateVisite() {
        $visite = new Visite();
        $dateVisite = new Date_visite();
        $idVisite = Request::input('idVisite');
        $cpt = Request::input('cpt');
        $cptV = 0;
        while ($cpt >= 0) {
            if (Request::input('choixdateVisite' . $cpt) != null) {
                $DateVisite = Request::input('dateVisite' . $cpt);
                $dateVisite->supprimerDateVis($idVisite, $DateVisite);
                $cptV += 1;
            }
            $cpt -= 1;
        }
        $datesVisite = $dateVisite->getDatesVisite($idVisite);
        if ($datesVisite == null) {
            $visite->supprimerVisEff($idVisite);
        }
        if ($cptV > 1) {
            $message = "Les dates ont bien été supprimées.";
        } else {
            $message = "La date a bien été supprimée.";
        }
        $mesVisites = $visite->getVisites();
        $mesVisitesND = $visite->getVisitesND();
        return view('/Visite/pageVisite', compact('mesVisites', 'mesVisitesND', 'message'));
    }

    public function modifierVisite($idVisite) {
        $Visite = new Visite();
        $maVisite = $Visite->getVisite($idVisite);
        $unVisiteur = new Visiteur();
        $mesVisiteurs = $unVisiteur->getVisiteurGuide();
        return view('/Visite/formModifVisite', compact('maVisite', 'mesVisiteurs'));
    }

    public function postModifierVisite() {
        $uneVisite = new Visite();
        $idVisite = Request::input('idVisite');
        $nomVisite = Request::input('nomVisite');
        $lieuxVisite = Request::input('lieuxVisite');
        $descVisite = Request::input('description');
        $idGuideVisite = Request::input('idGuideVisite');
        $uneVisite->updateVisite($idVisite, $nomVisite, $lieuxVisite, $descVisite, $idGuideVisite);
        $message = "La visite a bien été modifiée.";
        $mesVisites = $uneVisite->getVisites();
        $mesVisitesND = $uneVisite->getVisitesND();
        return view('/Visite/pageVisite', compact('mesVisites', 'mesVisitesND', 'message'));
    }

    public function supprResaVisite() {
        $idVisite = Request::input('idVisite');
        $idVisiteur = Request::input('idVisiteur');
        $dateVisite = Request::input('dateVisite');
        $qteBillet = Request::input('qteBillet');
        $uneLigneVisite = new Ligne_visite();
        $Visite = new Visite();
        $uneDateVisite = new Date_visite();
        $uneLigneVisite->supprResaVisite($idVisite, $idVisiteur, $dateVisite);
        $lesReservations = $uneLigneVisite->getReservations($dateVisite, $idVisite); 
        $mesVisites = $Visite->pageVisiteSpe($idVisite);
        $uneVisite = $Visite->getVisite($idVisite);
        $uneDateVisite->decrementPlaceRes($idVisite,$dateVisite,$qteBillet);
        return view('/Visite/ficheVisite', compact('lesReservations', 'uneVisite', 'mesVisites'));
    }

}
