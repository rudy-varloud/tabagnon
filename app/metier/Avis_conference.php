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

    public function updateAvis($idConf, $idVisiteur, $note, $avis) {
        DB::table('avis_conference')->Select()
                ->where('idConf', '=', $idConf)
                ->where('idVisiteur', '=', $idVisiteur)
                ->update(['note' => $note, 'avis' => $avis]);
    }

    public function addAvis($idConf, $idVisiteur, $note, $avis) {
        DB::table('avis_conference')->Select()
                ->where('idConf', '=', $idConf)
                ->where('idVisiteur', '=', $idVisiteur)
                ->insert(['idConf' => $idConf, 'idVisiteur' => $idVisiteur,'note' => $note, 'avis' => $avis]);
    }

    public function getAvis($idVisiteur, $idConf) {
        $unAvis = DB::table('avis_conference')
                ->where('idConf', '=', $idConf)
                ->where('idVisiteur', '=', $idVisiteur)
                ->first();
        return $unAvis;
    }
    
    public function getAvisConference($idVisiteur) {
        $lesAvis = DB::table('avis_conference')->Select()
                ->where('idVisiteur', '=', $idVisiteur)
                ->get();
        return $lesAvis;
    }

}