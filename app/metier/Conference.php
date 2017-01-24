<?php

namespace App\metier;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use DB;

class Conference extends Model {

    //
    protected $table = 'conference';
    public $timestamps = false;
    protected $fillable = [
        'idConf',
        'libConf',
        'prixConf',
        'dateCreation',
    ];

    public function postAjoutConf($nomConf, $prixConf, $placeDispoConf, $contenuConf, $adresseConf, $cpConf, $dateConf, $heureConf) {
        $conference = DB::table('conference')
                ->Insert(['libConf' => $nomConf, 'prixConf' => $prixConf, 'placeDispoConf' => $placeDispoConf, 'contenuConf' => $contenuConf,
            'adresseConf' => $adresseConf, 'cpConf' => $cpConf, 'dateConf' => $dateConf, 'heureConf' => $heureConf]);
        return $conference;
    }

    public function getConference() {
        $conference = DB::table('conference')
                ->select()
                ->get();
        return $conference;
    }

    public function getConferenceSpe($idConf) {
        $conference = DB::table('conference')
                ->select()
                ->where('idConf', '=', $idConf)
                ->first();
        return $conference;
    }

    public function postFromReserveConf($idConf, $placeSouhaite) {
        $conference = DB::table('conference')
                ->where('idConf', '=', $idConf)
                ->increment('placeReserConf', $placeSouhaite);
        return $conference;
    }

    public function getLastConference() {
        $lesConf = Conference::orderBy('idConf', 'desc')->take(3)->get();
        return $lesConf;
    }
    public function postLigneReserve($idVis, $idConf, $placeSouhaite) {
        $conference = DB::table('ligne_conference')
                ->insert(['idConf' => $idConf, 'idVisiteur' => $idVis, 'qteBillet' => $placeSouhaite]);
        return $conference;
    }

    public function getUserConf($idConf) {
        $conference = DB::table('ligne_conference')
                ->select()
                ->join('visiteur', 'ligne_conference.idVisiteur', '=', 'visiteur.idVis')
                ->Where('idConf', '=', $idConf)
                ->get();
        return $conference;
    }
    
    public function getConfUser($idVis){
        $conference = DB::table('conference')
                ->select()
                ->join('ligne_conference', 'conference.idConf', '=', 'ligne_conference.idConf')
                ->where('idVisiteur', '=', $idVis)
                ->get();
        return $conference;
    }

}
