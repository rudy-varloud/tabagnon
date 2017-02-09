<?php

namespace App\metier;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use DB;

class Avis_conference extends Model {

    protected $table = 'avis_conference';
    public $timestamps = false;
    protected $fillable = [
        'idConf',
        'idVisiteur',
        'note',
        'avis'
    ];

    /* 
     * Dialogue avec la BDD pour vérifier l'existance d'un avis
     */
    public function checkAvis($idConf, $idVisiteur) {
        $avis = DB::table('avis_conference')->Select()
                ->where('idConf', '=', $idConf)
                ->where('idVisiteur', '=', $idVisiteur)
                ->first();
        if ($avis != null) {
            return true;
        } else {
            return false;
        }
    }

    /* 
     * Dialogue avec la BDD pour modifier un avis
     */
    public function updateAvis($idConf, $idVisiteur, $note, $avis) {
        DB::table('avis_conference')->Select()
                ->where('idConf', '=', $idConf)
                ->where('idVisiteur', '=', $idVisiteur)
                ->update(['note' => $note, 'avis' => $avis]);
    }

    /* 
     * Dialogue avec la BDD pour ajouter un avis
     */
    public function addAvis($idConf, $idVisiteur, $note, $avis) {
        DB::table('avis_conference')->Select()
                ->where('idConf', '=', $idConf)
                ->where('idVisiteur', '=', $idVisiteur)
                ->insert(['idConf' => $idConf, 'idVisiteur' => $idVisiteur,'note' => $note, 'avis' => $avis]);
    }

    /* 
     * Dialogue avec la BDD pour récupérer un avis d'une conférence
     */
    public function getAvis($idVisiteur, $idConf) {
        $unAvis = DB::table('avis_conference')
                ->where('idConf', '=', $idConf)
                ->where('idVisiteur', '=', $idVisiteur)
                ->first();
        return $unAvis;
    }
    
    /* 
     * Dialogue avec la BDD pour récupérer la liste des avis pour une conférence
     */
    public function getAvisConference($idVisiteur) {
        $lesAvis = DB::table('avis_conference')->Select()
                ->where('idVisiteur', '=', $idVisiteur)
                ->get();
        return $lesAvis;
    }
    
    /* 
     * Dialogue avec la BDD pour récupérer un la liste des avis pour les conférences
     */
    public function getAvisConferences() {
        $lesAvis = DB::table('avis_conference')->Select()
                ->join('visiteur','visiteur.idVis','=','avis_conference.idVisiteur')
                ->get();
        return $lesAvis;
    }
    
    /* 
     * Dialogue avec la BDD pour supprimer les avis d'une visite
     */
    public function supprimerAvisEff($idConf){
        DB::table('avis_conference')->where('idConf','=',$idConf)
                ->delete();
    }

}