<?php

namespace App\metier;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use DB;

class Avis_visite extends Model {

    protected $table = 'avis_visite';
    public $timestamps = false;
    protected $fillable = [
        'idVisite',
        'idVisiteur',
        'note',
        'avis'
    ];

    /* 
     * Dialogue avec la BDD pour vérifier l'existance d'un avis d'une visite
     */
    public function checkAvis($idVisite, $idVisiteur, $dateVisite) {
        $avis = DB::table('avis_visite')->Select()
                ->where('idVisite', '=', $idVisite)
                ->where('idVisiteur', '=', $idVisiteur)
                ->where('dateVisite', '=', $dateVisite)
                ->first();
        if ($avis != null) {
            return true;
        } else {
            return false;
        }
    }

    /* 
     * Dialogue avec la BDD pour modifier un avis d'une visite
     */
    public function updateAvis($idVisite, $idVisiteur, $dateVisite, $note, $avis) {
        DB::table('avis_visite')->Select()
                ->where('idVisite', '=', $idVisite)
                ->where('idVisiteur', '=', $idVisiteur)
                ->where('dateVisite', '=', $dateVisite)
                ->update(['note' => $note, 'avis' => $avis]);
    }

    /* 
     * Dialogue avec la BDD pour ajouter un avis sur une visite
     */
    public function addAvis($idVisite, $idVisiteur, $dateVisite, $note, $avis) {
        DB::table('avis_visite')->Select()
                ->where('idVisite', '=', $idVisite)
                ->where('idVisiteur', '=', $idVisiteur)
                ->where('dateVisite', '=', $dateVisite)
                ->insert(['idVisite' => $idVisite, 'idVisiteur' => $idVisiteur, 'dateVisite' => $dateVisite, 'note' => $note, 'avis' => $avis]);
    }

    /* 
     * Dialogue avec la BDD pour récupérer un avis d'une visite
     */
    public function getAvis($idVisiteur, $idVisite, $dateVisite) {
        $unAvis = DB::table('avis_visite')
                ->where('idVisite', '=', $idVisite)
                ->where('idVisiteur', '=', $idVisiteur)
                ->where('dateVisite', '=', $dateVisite)
                ->first();
        return $unAvis;
    }

    /* 
     * Dialogue avec la BDD pour récupérer la liste des avis pour une visite
     */
    public function getAvisVisite($idVisiteur) {
        $lesAvis = DB::table('avis_visite')->Select()
                ->where('idVisiteur', '=', $idVisiteur)
                ->get();
        return $lesAvis;
    }

    /* 
     * Dialogue avec la BDD pour récupérer un la liste des avis pour les visistes
     */
    public function getAvisVisites() {
        $lesAvis = DB::table('avis_visite')->Select()
                ->join('visiteur','visiteur.idVis','=','avis_visite.idVisiteur')
                ->get();
        return $lesAvis;
    }
    
    /* 
     * Dialogue avec la BDD pour supprimer les avis d'une visite
     */
    public function supprimerAvisEff($idVisite){
        DB::table('avis_visite')->where('idVisite','=',$idVisite)
                ->delete();
    }
    
    public function supprUserAvisVisite($idVisiteur){
        DB::table('avis_visite')
                ->where('idVisiteur', '=', $idVisiteur)
                ->delete();
    }

}
