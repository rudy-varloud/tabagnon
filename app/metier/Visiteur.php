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
        'ncptVis'
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
}
