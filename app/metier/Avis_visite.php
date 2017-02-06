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

    public function updateAvis($idVisite, $idVisiteur, $dateVisite, $note, $avis) {
        DB::table('avis_visite')->Select()
                ->where('idVisite', '=', $idVisite)
                ->where('idVisiteur', '=', $idVisiteur)
                ->where('dateVisite', '=', $dateVisite)
                ->update(['note' => $note, 'avis' => $avis]);
    }

    public function addAvis($idVisite, $idVisiteur, $dateVisite, $note, $avis) {
        DB::table('avis_visite')->Select()
                ->where('idVisite', '=', $idVisite)
                ->where('idVisiteur', '=', $idVisiteur)
                ->where('dateVisite', '=', $dateVisite)
                ->insert(['idVisite' => $idVisite, 'idVisiteur' => $idVisiteur, 'dateVisite' => $dateVisite, 'note' => $note, 'avis' => $avis]);
    }

    public function getAvis($idVisiteur, $idVisite, $dateVisite) {
        $unAvis = DB::table('avis_visite')
                ->where('idVisite', '=', $idVisite)
                ->where('idVisiteur', '=', $idVisiteur)
                ->where('dateVisite', '=', $dateVisite)
                ->first();
        return $unAvis;
    }

    public function getAvisVisite($idVisiteur) {
        $lesAvis = DB::table('avis_visite')->Select()
                ->where('idVisiteur', '=', $idVisiteur)
                ->get();
        return $lesAvis;
    }

    public function getAvisVisites() {
        $lesAvis = DB::table('avis_visite')->Select()
                ->join('visiteur','visiteur.idVis','=','avis_visite.idVisiteur')
                ->get();
        return $lesAvis;
    }

}
