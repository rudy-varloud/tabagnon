<?php

namespace App\Http\Controllers;

use App\metier\Visiteur;
use App\metier\Like_image;
use App\metier\Ligne_visite;
use App\metier\Ligne_conference;
use App\metier\Mosaique;
use App\metier\Avis_visite;
use App\metier\Avis_conference;
use App\metier\Carousel;
use App\metier\Article;
use App\metier\Visite;
use App\metier\Conference;
use Request;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class VisiteurController extends Controller {

    public function connect() {
        $login = Request::input('login');
        $pwd = Request::input('pwd');
        $unVisiteur = new Visiteur();
        $connected = $unVisiteur->login($login, $pwd);
        if ($connected) {
            $id = Session::get('id');
            $unV = $unVisiteur->getUser($id);
            if ($unV->ncptVis == 5) {
                return redirect('/modifierProfil');
            }
            return redirect('/accueil');
        } else {
            $erreur = "Login ou mot de passe inconnu, veuillez réessayer !";
            return view('/Connection/formLogin', compact('erreur'));
        }
    }

    public function verifDispoCompte() {
        $login = Request::input('login');
        $unVisiteur = new Visiteur;
        $desVisiteurs = $unVisiteur->verifDispo($login);
        return view('/signIn', compact('desVisiteurs'));
    }

    public function getLogin() {
        $erreur = "";
        return view('/Connection/formLogin', compact('erreur'));
    }

    public function signOut() {
        //Création d'un objet, et appel d'une méthode pour cette objet
        $unVisteur = new Visiteur();
        $unVisteur->logout();
        return redirect('/accueil');
    }

    //Renvoie sur le formulaire d'inscription

    public function getSubscribe() {
        $erreur = "";
        return view('/Connection/formSubscribe', compact('erreur'));
    }

    /* Récupère en post les données du formulaire d'inscription 
     * puis créer l'appel d'inscription en passant ces données
     * et créer l'appel de connexion si l'inscription a fonctionné ou renvoie sur la page d'inscription avec un message d'erreur le cas échéant.  
     */

    public function SubscribeIn() {
        $login = Request::input('login');
        $pwd = Request::input('pwd');
        $pwd_encrypt = encrypt($pwd);
        $nom = Request::input('nom');
        $prenom = Request::input('prenom');
        $mail = Request::input('mail');
        $adr = Request::input('adr');
        $tel = Request::input('tel');
        $mobile = Request::input('mobile');
        $ville = Request::input('ville');
        $cp = Request::input('cp');
        $unVisiteur = new Visiteur();
        $inscription = $unVisiteur->subscribe($login, $pwd_encrypt, $nom, $prenom, $mail, $adr, $tel, $mobile, $ville, $cp);
        if ($inscription) {
            $user_name = $nom . " " . $prenom;
            $title = "Welcome";
            $content = "je suis le contenu du mail";
            $data = ['email' => $mail, 'name' => $user_name, 'login' => $login, 'mdp' => $pwd, 'subject' => $title, 'content' => $content]; // ici ce sont les données qui sont transmis dans le view utilisé lors de l'envoi du mail
            Mail::send('mail', $data, function($message) use($data) { //fonction send qui va envoyer la view " mail "
                $subject = $data['subject'];
                $message->from('tabagnon.saintgenis@gmail.com');  //Adresse email de l'emetteur de l'email
                $message->to($data['email'], $data['email'])->subject($subject); //ici on definit l'adresse à laquelle on envoie le mail
            });
            $message = 'Merci de vous être inscrit. Un mail récapitulant vos identifiants vous a été envoyé.';
            $unVisiteur = new Visiteur();
            $unVisiteur->login($login, $pwd);
            $unArticle = new Article();
            $lesArticles = $unArticle->getLastArticle();
            $Carousel = new Carousel;
            $lesImages = $Carousel->getImagesCarouselTrue();
            $uneVisite = new Visite();
            $uneConference = new Conference();
            $lesVisites = $uneVisite->getLastVisite();
            $lesConferences = $uneConference->getLastConference();
            return view('accueil', compact('lesArticles', 'lesImages', 'lesVisites', 'lesConferences', 'message'));
        } else {
            $exemple = $prenom . "." . $nom;
            if ($unVisiteur->verificationLogin($exemple))
                $erreur = "Identifiant déja pris, veuillez en choisir un autre. Suggestion: " . $exemple;
            else
                $erreur = "Identifiant déja pris, veuillez en choisir un autre.";
            return view('/Connection/formSubscribe', compact('erreur', 'login', 'nom', 'prenom', 'mail', 'adr', 'tel', 'ville', 'cp'));
        }
    }

    //Renvoie le formulaire de mot de passe oublié. 

    public function Mdpoublie() {
        $erreur = "";
        return view('formMdpOublie', compact('erreur'));
    }

    public function listeUser() {
        $unVisiteur = new Visiteur();
        $mesVisiteurs = $unVisiteur->listeUser();
        $unVisiteur2 = new Visiteur();
        $mesVisiteurs2 = $unVisiteur2->countUser();
        return view('/Utilisateur/formListeVis', compact('mesVisiteurs', 'mesVisiteurs2'));
    }

    public function modifUser($idVis) {
        $unVisiteur = new Visiteur();
        $mesVisiteurs = $unVisiteur->getUser($idVis);
        return view('/Utilisateur/formModifCompte', compact('mesVisiteurs'));
    }

    public function postModifUser() {
        $idVis = Request::input('idVis');
        $id_type = Request::input('id_type');
        $unVisiteur = new Visiteur();
        $unVisiteur->postModifUser($idVis, $id_type);
        return redirect('/listeUser');
    }

    public function listeUserSpe() {
        $user = Request::input('filtre');
        $unVisiteur = new Visiteur();
        $mesVisiteurs = $unVisiteur->listeUserSpe($user);
        return view('/Utilisateur/formListeVisSpe', compact('mesVisiteurs', 'user'));
    }

    /* Créer l'appel de récupération des données d'un client 
     * et renvoie ces données au formulaire de modification d'un client.   
     */

    public function modifierProfil() {
        $message = "";
        $id = Session::get('id');
        $unVisiteur = new Visiteur();
        $unV = $unVisiteur->getUser($id);
        if ($unV->ncptVis == 5)
            $message = "Merci de modifier vos informations pour valider votre compte.";
        return view('/Utilisateur/formProfil', compact('message', 'unV'));
    }

    /* Récupère en post les données du formulaire de modification d'un client
     * et créer l'appel de la modification des données d'un client 
     * puis renvoie la page profil du client.     
     */

    public function postModifierProfil() {
        $unVisiteur = new Visiteur();
        $adresse = Request::input('adressecli');
        $tel = Request::input('telcli');
        $mobile = Request::input('mobile');
        $mdp = Request::input('mdp');
        $mdp_encrypt = encrypt($mdp);
        $mail = Request::input('mail');
        $nom = Request::input('nom');
        $prenom = Request::input('prenom');
        $login = Request::input('login');
        $id = Session::get('id');
        $ville = Request::input('ville');
        $cp = Request::input('cp');
        $unV = $unVisiteur->getUser($id);
        if ($unV->ncptVis == 5) {
            $unVisiteur->updateGuide($id);
            Session::put('ncpt', $unVisiteur->ncptVis);
        }
        $unVisiteur->modificationProfil($id, $adresse, $tel, $mobile, $mdp_encrypt, $mail, $nom, $prenom, $login, $ville, $cp);
        return redirect('/getProfil');
    }

    /* Créer l'appel de récupération des données d'un client 
     * et renvoie les données sur la page profil du client.
     */

    public function getProfil() {
        $unVisiteur = new Visiteur();
        $id = Session::get('id');
        $unV = $unVisiteur->getUser($id);
        return view('/Utilisateur/profil', compact('unV'));
    }

    public function supprCompte($idVisiteur) {
        $unVisiteur = new Visiteur();
        $unVisiteur->supprUserVis($idVisiteur);
        $uneMosaique = new Mosaique();
        $uneMosaique->supprUserMosaique($idVisiteur);
        $unLikeImage = new Like_image();
        $unLikeImage->supprUserLikeImage($idVisiteur);
        $uneLigneVisite = new Ligne_visite();
        $uneLigneVisite->supprUserLigneVisite($idVisiteur);
        $uneLigneConference = new Ligne_conference();
        $uneLigneConference->supprUserLigneConference($idVisiteur);
        $unCommentaireImage = new Mosaique();
        $unCommentaireImage->supprUserCommentaireImage($idVisiteur);
        $unAvisVisite = new Avis_visite();
        $unAvisVisite->supprUserAvisVisite($idVisiteur);
        $unAvisConference = new Avis_conference();
        $unAvisConference->supprUserAvisConference($idVisiteur);

        return redirect('/listerVisiteur');
    }

}
