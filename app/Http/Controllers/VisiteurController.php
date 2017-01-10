<?php



namespace App\Http\Controllers;
use App\metier\Visiteur;
use Request;
use Illuminate\Support\Facades\Session;
use Exception;
use  Illuminate\Support\Facades\Input;

class VisiteurController extends Controller {
    
    
    public function connect(){
        $login = Request::input('login');
        $pwd = Request::input('pwd');
        $unVisiteur = new Visiteur();
        $connected = $unVisiteur->login($login, $pwd);
        if($connected){
            return redirect('/');
        }
        else{
            $erreur = "Login ou mot de passe inconnu, veuillez ressayez ou créer un compte sur SHOP DOZO !";
            return view ('formLogin', compact ('erreur'));
        }
    }
    
    public function verifDispoCompte(){
        $login = Request::input('login');
        $unVisiteur = new Visiteur;
        $desVisiteurs = $unVisiteur->verifDispo($login);
        return view('/signIn', compact ('desVisiteurs'));
    }
    
    public  function getLogin(){
        $erreur = "";
        return view('formLogin', compact('erreur'));
    }
    
    public function signOut(){
        //Création d'un objet, et appel d'une méthode pour cette objet
        $unVisteur = new Visiteur();
        $unVisteur->logout();
        return redirect('/');
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
            return view('formSubscribe', compact('erreur', 'login','nom','prenom','mail','adr','tel','ville','cp'));
        }
    }

    //Renvoie le formulaire de mot de passe oublié. 

    public function Mdpoublie() {
        $erreur = "";
        return view('formMdpOublie', compact('erreur'));
    }
    
    public function listeUser(){
        $unVisiteur = new Visiteur();
        $mesVisiteurs = $unVisiteur->listeUser();
        return view ('formListeVis', compact ('mesVisiteurs'));
    }
    
    public function modifUser($idVis){
        $unVisiteur = new Visiteur();
        $mesVisiteurs = $unVisiteur->getUser($idVis);
        $unVis = new Visiteur();
        $mesVisiteurs_Compte = $unVis->calculeVisiteur();
        return view('formModifCompte', compact ('mesVisiteurs', 'mesVisiteursCompte'));
    }

    
   
}
