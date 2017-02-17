<?php

namespace App\Http\Controllers;

use App\metier\Conference;
use App\metier\Visite;
use App\metier\Ligne_conference;
use App\metier\Avis_conference;
use App\metier\Visiteur;
use App\metier\Carousel;
use App\metier\Article;
use Request;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class ConferenceController extends Controller {
    /*
     * Récupère les données du formulaire d'ajout de conférence et
     * créer l'appel pour ajouter une conférence
     */

    public function postFormAjoutConf() {
        $nomConf = Request::input('nomConf');
        $prixConf = Request::input('prixConf');
        $placeDispoConf = Request::input('placeDispoConf');
        $contenuConf = Request::input('contenu');
        $adresseConf = Request::input('adresseConf');
        $cpConf = Request::input('cpConf');
        $date = Request::input('date');
        $heure = Request::input('heure');
        $datetime = $date . " " . $heure;
        $uneConf = new Conference();
        $uneConf->postAjoutConf($nomConf, $prixConf, $placeDispoConf, $contenuConf, $adresseConf, $cpConf, $datetime);
        $message = "La conférence a bien été ajoutée.";
        $mesConferences = $uneConf->getConference();
        return view('/Conference/listeConference', compact('mesConferences', 'message'));
    }

    /*
     * Créer l'appel pour récupèrer l'ensemble des conférences
     */

    public function getConference() {
        $uneConference = new Conference();
        $mesConferences = $uneConference->getConference();
        $message = '';
        return view('/Conference/listeConference', compact('mesConferences', 'message'));
    }

    /*
     * Créer l'appel pour récupèrer une conférence particulière
     */

    public function getConferenceSpe($idConf) {
        $uneConference = new Conference();
        $mesConferences = $uneConference->getConferenceSpe($idConf);
        return view('/Conference/listeConfSpe', compact('mesConferences'));
    }

    /*
     * Créer l'appel pour réserver des places pour une conférence
     */

    public function postFromReserveConf() {
        $idVis = Session::get('id');
        $idConf = Request::input('idConf');
        $placeSouhaite = Request::input('placeSouhaite');
        $Conference = new Conference();
        $unVisiteur = new Visiteur();
        $uneConference = $Conference->getConferenceSpe($idConf);
        $LigneConference = new Ligne_conference();
        $Conference->postFromReserveConf($idConf, $placeSouhaite);
        $LigneConference->postLigneReserve($idVis, $idConf, $placeSouhaite);
        $mail = $unVisiteur->getVisiteur($idVis)->mailVis;
        $title = "Votre réservation pour la conférence : " . $uneConference->libConf;
        $content = "je suis le contenu du mail";
        $data = ['uneConference' => $uneConference, 'qteBillet' => $placeSouhaite, 'subject' => $title, 'content' => $content, 'email' => $mail];
        Mail::send('mailResConference', $data, function($message) use($data) {

            $subject = $data['subject'];
            $message->from('tabagnon.saintgenis@gmail.com');
            $message->to($data['email'], $data['email'])->subject($subject);
        });
        $message = 'Votre réservation a été prise en compte. Un mail récapitulatif vous a été envoyé.';
        $uneVisite = new Visite();
        $unArticle = new Article();
        $lesArticles = $unArticle->getLastArticle();
        $Carousel = new Carousel;
        $lesImages = $Carousel->getImagesCarouselTrue();
        $lesVisites = $uneVisite->getLastVisite();
        $lesConferences = $Conference->getLastConference();
        return view('accueil', compact('lesArticles', 'lesImages', 'lesVisites', 'lesConferences', 'message'));
    }

    /*
     * Créer l'appel pour récupèrer les conférences effectuées par un utilisateur
     */

    public function getUserConf($idConf) {
        $uneConference = new Conference();
        $mesConferences = $uneConference->getUserConf($idConf);
        return view('/Conference/listeUserConf', compact('mesConferences'));
    }

    /*
     * Créer l'appel pour envoyer une conférence au formulaire de modification de conférence
     */

    public function modifConf($idConf) {
        $uneConference = new Conference();
        $mesConferences = $uneConference->modifConf($idConf);
        return view('/Conference/pageModifConf', compact('mesConferences'));
    }

    /*
     * Créer l'appel pour modifier une conférence
     */

    public function postModifAjoutConf() {
        $id = Request::input('id');
        $nom = Request::input('nomConf');
        $place = Request::input('placeDispoConf');
        $contenu = Request::input('contenu');
        $adresseConf = Request::input('adresseConf');
        $cpConf = Request::input('cpConf');
        $placeRes = Request::input('place');
        if ($place < $placeRes) {
            $uneConference = new Conference();
            $mesConferences = $uneConference->modifConf($id);
            $erreur = 'Veuillez entrer un nombre de place supérieur au nombre de place réservées !';
            return view('/Conference/pageModifConf', compact('mesConferences', 'erreur'));
        } else {

            $uneConference = new Conference();
            $uneConference->postModifAjoutConf($id, $nom, $place, $contenu, $adresseConf, $cpConf);
            $message = "La conférence a bien été modifiée";
            $mesConferences = $uneConference->getConference();
            return view('/Conference/listeConference', compact('mesConferences', 'message'));
        }
    }

    /*
     * Créer l'appel pour supprimer une conférence particulière
     */

    public function supprConf($idConf) {
        $uneConference = new Conference();
        $uneConference->supprConf($idConf);
        $message = "La conférence a bien été supprimée";
        $mesConferences = $uneConference->getConference();
        return view('/Conference/listeConference', compact('mesConferences', 'message'));
    }

    /*
     * Créer l'appel pour supprimer une conférence effectué ainsi que les lignes et avis liés.
     */

    public function supprimerConfEffec($idConf) {
        $uneConference = new Conference();
        $avisConference = new Avis_conference();
        $ligneConference = new Ligne_conference();
        $avisConference->supprimerAvisEff($idConf);
        $ligneConference->supprimerLigneEff($idConf);
        $uneConference->supprimerConfEff($idConf);
        return redirect('/getAvis');
    }

}
