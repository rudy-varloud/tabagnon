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
                ->orderBy ('login', 'ASC')
                ->get();
        return $mesVisiteurs;
    }
}
