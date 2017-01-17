<?php

namespace App\metier;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use DB;

class Visiteur extends Model {

    //
    protected $table = 'visiteur';
    public $timestamps = false;
    protected $fillable = [
        'idVis',
        'login',
        'mdpVis',
        'nomVis',
        'prenomVis',
        'adresseVis',
        'mailVis',
        'telVis',
        'villeVis',
        'codePostVis',
        'ageVis',
        'ncptVis',
    ];

    public function login($login, $pwd) {
        $connected = false;
        $visiteur = DB::table('visiteur')
                ->select()
                ->where('login', '=', $login)
                ->first();
        if ($visiteur) {
            if ($visiteur->mdpVis == $pwd) {
                Session::put('id', $visiteur->idVis);
                Session::put('ncpt', $visiteur->ncptVis);
                Session::put('prenom', $visiteur->prenomVis);
                $connected = true;
            }
        }
        return $connected;
    }

    public function logout() {
        Session::put('id', 0);
        Session::put('nom', 0);
    }

    //Dialogue avec la bdd pour inscrire un utilisateur (renvoie un booléen) 
    public function subscribe($login, $pwd, $nom, $prenom, $mail, $adr, $tel, $cp, $ville) {
        $Visiteur = New Visiteur();
        if ($Visiteur->verificationLogin($login)) {
            DB::table('visiteur')->insert(['nomVis' => $nom, 'prenomVis' => $prenom, 'adresseVis' => $adr, 'telVis' => $tel, 'login' => $login, 'mdpVis' => $pwd, 'ncptVis' => 1, 'mailVis' => $mail, 'codePostVis' => $cp, 'villeVis' => $ville]);
            return true;
        } else {
            return false;
        }
    }

    //Dialogue avec la bdd pour récupérer un visiteur en fonction de l'id visiteur
    public function getVisiteur($id) {
        $visiteur = DB::table('visiteur')
                ->Select('nomVis', 'prenomVis', 'login', 'ncptVis', 'telVis', 'adresseVis', 'mailVis', 'mdpVis')
                ->Where('idVis', '=', $id)
                ->first();
        return $visiteur;
    }

    //Dialogue avec la bdd pour vérifier si le login existe déja (rnevoie un booléen)
    public function verificationLogin($login) {
        $verif = DB::table('visiteur')
                ->Select('idVis')
                ->Where('login', '=', $login)
                ->first();
        if ($verif != null)
            return false;
        else
            return true;
    }

    //Dialogue avec la bdd pour récuperer les infos de tout les utilisateurs
    public function listeUser() {
        $mesVisiteurs = DB::table('visiteur')
                ->Select('idVis', 'login', 'telVis', 'nomVis', 'prenomVis', 'mailVis', 'adresseVis', 'ncptVis')
                ->orderBy('login', 'ASC')
                ->get();
        return $mesVisiteurs;
    }

    public function getUser($idVis) {
        $mesVisiteurs = DB::table('visiteur')
                ->Select()
                ->where('idVis', '=', $idVis)
                ->first();
        return $mesVisiteurs;
    }

    public function countUser() {
        $mesVisiteurs_compte = DB::table('visiteur')->count();
        return $mesVisiteurs_compte;
    }

    public function postModifUser($idVis, $id_type) {
        $mesVisiteurs = DB::table('visiteur')
                ->where('idVis', '=', $idVis)
                ->update(['ncptVis' => $id_type]);
        return $mesVisiteurs;
    }

    public function listeUserSpe($user) {
        $mesVisiteursNom = DB::table('visiteur')
                ->Select('idVis', 'login', 'telVis', 'nomVis', 'prenomVis', 'mailVis', 'adresseVis', 'ncptVis')
                ->where('nomVis', 'like', '%' . $user . '%')
                ->orderBy('login', 'ASC')
                ->get();
        $mesVisiteursPrenom = DB::table('visiteur')
                ->Select('idVis', 'login', 'telVis', 'nomVis', 'prenomVis', 'mailVis', 'adresseVis', 'ncptVis')
                ->where('prenomVis', 'like', '%' . $user . '%')
                ->orderBy('login', 'ASC')
                ->get();
        $Visiteurs = array_merge($mesVisiteursNom, $mesVisiteursPrenom);
        $Visiteurs = array_map("unserialize", array_unique(array_map("serialize", $Visiteurs)));
        return $Visiteurs;
    }

    public function getVisiteurGuide() {
        $mesVisiteurs = DB::table('visiteur')
                ->Select('idVis', 'login', 'telVis', 'nomVis', 'prenomVis', 'mailVis', 'adresseVis', 'ncptVis')
                ->where('ncptVis', '=', '3')
                ->orWhere('ncptVis', '=', '5')
                ->get();
        return $mesVisiteurs;
    }

    public function countUserSpe($user) {
        $mesVisiteurs_compteSpe = DB::table('visiteur')
                ->where('nomVis', '=', $user)
                ->count();
        return $mesVisiteurs_compteSpe;
    }

    public function subGuideMan($prenomUser, $nomUser) {
        $mesVisiteurs = DB::table('visiteur')
                ->insert(['login' => $prenomUser, 'mdpVis' => $nomUser, 'nomVis' => $nomUser, 'prenomVis' => $prenomUser, 'ncptVis' => 5]);
        return $mesVisiteurs;
    }

    //Dialogue aves la bdd pour modifier le profil d'un utilisateur
    public function modificationProfil($id, $adresse, $tel, $mdp, $mail, $nom, $prenom, $login) {
        if ($login != null) {
            DB::table('visiteur')->where('idVis', $id)
                    ->update(['adresseVis' => $adresse, 'telVis' => $tel, 'mdpVis' => $mdp, 'mailVis' => $mail, 'nomVis' => $nom, 'prenomVis' => $prenom, 'login' => $login]);
        }
        else{
            DB::table('visiteur')->where('idVis', $id)
                    ->update(['adresseVis' => $adresse, 'telVis' => $tel, 'mdpVis' => $mdp, 'mailVis' => $mail, 'nomVis' => $nom, 'prenomVis' => $prenom]);
        }
    }

    public function updateGuide($id) {
        DB::table('visiteur')->where('idVis', $id)
                ->update(['ncptVis' => 3]);
    }

}
