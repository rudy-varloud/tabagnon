<?php

namespace App\Http\Controllers;

use App\metier\Visiteur;
use Request;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Facades\Input;

class VisiteurController extends Controller {

    public function connect() {
        $login = Request::input('login');
        $pwd = Request::input('pwd');
        $unVisiteur = new Visiteur();
        $connected = $unVisiteur->login($login, $pwd);
        if ($connected) {
            $id = Session::get('id');
            $unV = $unVisiteur->getUser($id);
            if ($unV->ncptVis)
                return redirect('/modifierProfil');
            return redirect('/accueil');
        }
        else {
            $erreur = "Login ou mot de passe inconnu, veuillez réessayer !";
            return view('formLogin', compact('erreur'));
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
        return view('formLogin', compact('erreur'));
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
        return view('formSubscribe', compact('erreur'));
    }

    /* Récupère en post les données du formulaire d'inscription 
     * puis créer l'appel d'inscription en passant ces données
     * et créer l'appel de connexion si l'inscription a fonctionné ou renvoie sur la page d'inscription avec un message d'erreur le cas échéant.  
     */

    public function SubscribeIn() {
        $login = Request::input('login');
        $pwd = Request::input('pwd');
        $nom = Request::input('nom');
        $prenom = Request::input('prenom');
        $mail = Request::input('mail');
        $adr = Request::input('adr');
        $tel = Request::input('tel');
        $ville = Request::input('ville');
        $cp = Request::input('cp');
        $unVisiteur = new Visiteur();
        $inscription = $unVisiteur->subscribe($login, $pwd, $nom, $prenom, $mail, $adr, $tel, $ville, $cp);
        if ($inscription) {
            $unVisiteur->login($login, $pwd);
            return view('Merci', compact('mail', 'nom'));
        } else {
            $exemple = $prenom . "." . $nom;
            if ($unVisiteur->verificationLogin($exemple))
                $erreur = "Identifiant déja pris, veuillez en choisir un autre. Suggestion: " . $exemple;
            else
                $erreur = "Identifiant déja pris, veuillez en choisir un autre.";
            return view('formSubscribe', compact('erreur', 'login', 'nom', 'prenom', 'mail', 'adr', 'tel', 'ville', 'cp'));
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
        return view('formListeVis', compact('mesVisiteurs', 'mesVisiteurs2'));
    }

    public function modifUser($idVis) {
        $unVisiteur = new Visiteur();
        $mesVisiteurs = $unVisiteur->getUser($idVis);
        return view('formModifCompte', compact('mesVisiteurs'));
    }

    public function postModifUser() {
        $idVis = Request::input('idVis');
        $id_type = Request::input('id_type');
        $unVisiteur = new Visiteur();
        $unVisiteur->postModifUser($idVis, $id_type);
        return view('pageAdmin');
    }

    public function listeUserSpe() {
        $user = Request::input('filtre');
        $unVisiteur = new Visiteur();
        $mesVisiteurs = $unVisiteur->listeUserSpe($user);
        $unVisiteur2 = new Visiteur();
        $mesVisiteurs2 = $unVisiteur2->countUserSpe($user);
        return view('formListeVisSpe', compact('mesVisiteurs', 'mesVisiteurs2', 'user'));
    }

    public function subGuideTemp() {
        $prenomUser = Request::input('prenomGuideMan');
        $nomUser = Request::input('nomGuideMan');
        $unVisiteur = new Visiteur();
        $mesVisiteur = $unVisiteur->subGuideMan($prenomUser, $nomUser);
        return view('pageAdmin');
    }

    /* Créer l'appel de récupération des données d'un client 
     * et renvoie ces données au formulaire de modification d'un client.   
     */

    public function modifierProfil() {
        $message="";
        $id = Session::get('id');
        $unVisiteur = new Visiteur();
        $unV = $unVisiteur->getUser($id);
        if ($unV->ncptVis == 5)
            $message = "Merci de modifier vos informations pour valider votre compte.";
        return view('formProfil', compact('message', 'unV'));
    }

    /* Récupère en post les données du formulaire de modification d'un client
     * et créer l'appel de la modification des données d'un client 
     * puis renvoie la page profil du client.     
     */

    public function postModifierProfil() {
        $unVisiteur = new Visiteur();
        $adresse = Request::input('adressecli');
        $tel = Request::input('telcli');
        $mdp = Request::input('mdp');
        $mail = Request::input('mail');
        $nom = Request::input('nom');
        $prenom = Request::input('prenom');
        $id = Session::get('id');
        $unV = $unVisiteur->getUser($id);
        if ($unV->ncptVis == 5) {
            $unVisiteur->updateGuide($id);
        }
        $unVisiteur->modificationProfil($id, $adresse, $tel, $mdp, $mail, $nom, $prenom);
        return redirect('/getProfil');
    }

    /* Créer l'appel de récupération des données d'un client 
     * et renvoie les données sur la page profil du client.
     */

    public function getProfil() {
        $unVisiteur = new Visiteur();
        $id = Session::get('id');
        $unV = $unVisiteur->getUser($id);
        return view('profil', compact('unV'));
    }
   
}
