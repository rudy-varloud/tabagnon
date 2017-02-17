<?php

namespace App\metier;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use DB;

class Ligne_conference extends Model {

    //
    protected $table = 'ligne_conference';
    public $timestamps = false;
    protected $fillable = [
        'idConf',
        'idVisiteur',
        'qteBillet',
        'idImage',
    ];

    /*
     * Dialogue avec la BDD pour ajouter une ligne conférence (reservation utilisateur)
     */

    public function postLigneReserve($idVis, $idConf, $placeSouhaite) {
        DB::table('ligne_conference')
                ->insert(['idConf' => $idConf, 'idVisiteur' => $idVis, 'qteBillet' => $placeSouhaite]);
    }

    /*
     * Dialogue avec la BDD pour supprimer les lignes d'une visite
     */

    public function supprimerLigneEff($idConf) {
        DB::table('ligne_conference')->where('idConf', '=', $idConf)
                ->delete();
    }
    
    public function supprUserLigneConference($idVisiteur){
        Db::table('ligne_conference')
                ->where('idVisiteur', '=', $idVisiteur)
                ->delete();
    }
    
    public function supprReserv($idConf){
        DB::table('ligne_conference')
                ->Where('idConf', '=', $idConf)
                ->Delete();
    }

}
