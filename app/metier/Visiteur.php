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
        'telFixeVis',
        'mobileVis',
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
            $mdp = decrypt($visiteur->mdpVis);
            if ($mdp == $pwd) {
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
        Session::put('ncpt', 0);
    }

    //Dialogue avec la bdd pour inscrire un utilisateur (renvoie un booléen) 
    public function subscribe($login, $pwd, $nom, $prenom, $mail, $adr, $tel, $mobile, $cp, $ville) {
        $Visiteur = New Visiteur();
        if ($Visiteur->verificationLogin($login)) {
            DB::table('visiteur')->insert(['nomVis' => $nom, 'prenomVis' => $prenom, 'adresseVis' => $adr, 'telFixeVis' => $tel, 'mobileVis' => $mobile, 'login' => $login, 'mdpVis' => $pwd, 'ncptVis' => 1, 'mailVis' => $mail, 'codePostVis' => $cp, 'villeVis' => $ville]);
            return true;
        } else {
            return false;
        }
    }

    //Dialogue avec la bdd pour récupérer un visiteur en fonction de l'id visiteur
    public function getVisiteur($id) {
        $visiteur = DB::table('visiteur')
                ->Select('nomVis', 'prenomVis', 'login', 'ncptVis', 'telFixeVis', 'mobileVis', 'adresseVis', 'mailVis', 'mdpVis')
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
                ->Select('idVis', 'login', 'mdpVis', 'telFixeVis', 'mobileVis', 'nomVis', 'prenomVis', 'mailVis', 'adresseVis', 'ncptVis')
                ->orderBy('login', 'ASC')
                ->paginate(20);
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
                ->Select('idVis', 'login', 'telFixeVis', 'mobileVis', 'nomVis', 'prenomVis', 'mailVis', 'adresseVis', 'ncptVis')
                ->where('nomVis', 'like', '%' . $user . '%')
                ->orderBy('login', 'ASC')
                ->get();
        $mesVisiteursPrenom = DB::table('visiteur')
                ->Select('idVis', 'login', 'telFixeVis', 'mobileVis', 'nomVis', 'prenomVis', 'mailVis', 'adresseVis', 'ncptVis')
                ->where('prenomVis', 'like', '%' . $user . '%')
                ->orderBy('login', 'ASC')
                ->get();
        $Visiteurs = array_merge($mesVisiteursNom, $mesVisiteursPrenom);
        $Visiteurs = array_map("unserialize", array_unique(array_map("serialize", $Visiteurs)));
        return $Visiteurs;
    }

    public function getVisiteurGuide() {
        $mesVisiteurs = DB::table('visiteur')
                ->Select('idVis', 'login', 'telFixeVis', 'mobileVis', 'nomVis', 'prenomVis', 'mailVis', 'adresseVis', 'ncptVis')
                ->where('ncptVis', '=', '3')
                ->orWhere('ncptVis', '=', '5')
                ->get();
        return $mesVisiteurs;
    }

    public function countUserSpe($user) {
        $mesVisiteurs_compteSpe = DB::table('visiteur')
                ->where('nomVis', 'like', '%' . $user . '%')
                ->count();
        return $mesVisiteurs_compteSpe;
    }

    public function subGuideMan($prenomUser, $nomUser, $mdp_encyrpt) {
        DB::table('visiteur')
                ->insert(['login' => $prenomUser, 'mdpVis' => $mdp_encyrpt, 'nomVis' => $nomUser, 'prenomVis' => $prenomUser, 'ncptVis' => 5]);
        $idGuide = DB::table('visiteur')
                ->Select('idVis')
                ->where('login', '=', $prenomUser)
                ->where('mdpVis', '=', $mdp_encyrpt)
                ->first();
        return $idGuide->idVis;
    }

    //Dialogue aves la bdd pour modifier le profil d'un utilisateur
    public function modificationProfil($id, $adresse, $tel, $mobile, $mdp_encrypt, $mail, $nom, $prenom, $login, $ville, $cp) {
        if ($login != null) {
            DB::table('visiteur')->where('idVis', $id)
                    ->update(['adresseVis' => $adresse, 'telFixeVis' => $tel, 'mobileVis' => $mobile, 'mdpVis' => $mdp_encrypt, 'mailVis' => $mail, 'nomVis' => $nom, 'prenomVis' => $prenom, 'login' => $login]);
        } else {
            DB::table('visiteur')->where('idVis', $id)
                    ->update(['adresseVis' => $adresse, 'telFixeVis' => $tel, 'mobileVis' => $mobile, 'mdpVis' => $mdp_encrypt, 'mailVis' => $mail, 'nomVis' => $nom, 'prenomVis' => $prenom, 'villeVis' => $ville, 'codePostVis' => $cp]);
        }
    }

    public function updateGuide($id) {
        DB::table('visiteur')->where('idVis', $id)
                ->update(['ncptVis' => 3]);
    }

}
