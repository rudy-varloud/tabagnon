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


}
