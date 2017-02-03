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

    public function postAjoutConf($nomConf, $prixConf, $placeDispoConf, $contenuConf, $adresseConf, $cpConf, $dateConf) {
        DB::table('conference')
                ->Insert(['libConf' => $nomConf, 'prixConf' => $prixConf, 'placeDispoConf' => $placeDispoConf, 'contenuConf' => $contenuConf,
                    'adresseConf' => $adresseConf, 'cpConf' => $cpConf, 'dateConf' => $dateConf]);
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
        DB::table('conference')
                ->where('idConf', '=', $idConf)
                ->increment('placeReserConf', $placeSouhaite);
    }

    public function getLastConference() {
        $lesConf = Conference::orderBy('idConf', 'desc')->take(3)->get();
        return $lesConf;
    }

    public function postLigneReserve($idVis, $idConf, $placeSouhaite) {
        DB::table('ligne_conference')
                ->insert(['idConf' => $idConf, 'idVisiteur' => $idVis, 'qteBillet' => $placeSouhaite]);
    }

    public function getUserConf($idConf) {
        $conference = DB::table('ligne_conference')
                ->select()
                ->join('visiteur', 'ligne_conference.idVisiteur', '=', 'visiteur.idVis')
                ->Where('idConf', '=', $idConf)
                ->get();
        return $conference;
    }

    public function getConfUser($idVis) {
        $conferences = DB::table('conference')
                ->select()
                ->join('ligne_conference', 'conference.idConf', '=', 'ligne_conference.idConf')
                ->where('idVisiteur', '=', $idVis)
                ->get();
        return $conferences;
    }
    public function getConfUserEffec($idVis) {
        $conferences = DB::table('conference')
                ->select()
                ->join('ligne_conference', 'conference.idConf', '=', 'ligne_conference.idConf')
                ->where('idVisiteur', '=', $idVis)
                ->where('statut','=',true)
                ->get();
        return $conferences;
    }
    
    public function rajoutBillet($idConf,$qteBillet){
        DB::table('conference')->where('idConf','=',$idConf)
                ->decrement('placeReserConf',$qteBillet);
    }
    
    public function modifierPlaceLibre($idConf,$qteBillet,$placeRes){
        $update = $placeRes-$qteBillet;
         DB::table('conference')->where('idConf','=',$idConf)
                ->decrement('placeReserConf',$update);
    }
 
    public function modifConf($idConf){
        $mesConferences = DB::table('conference')
                ->Select()
                ->Where('idConf', '=', $idConf)
                ->First();
        return $mesConferences;
    }
    
    public function postModifAjoutConf($id,$nom,$place, $contenu, $adresseConf, $cpConf){
        DB::table('conference')
                ->where('idConf', '=', $id)
                ->update(['libConf' => $nom, 'placeDispoConf' => $place, 'contenuConf' => $contenu,
                    'adresseConf' => $adresseConf, 'cpConf' => $cpConf]);
    }
    
    public function supprConf($idConf){
        $mesConferences = DB::table('conference')
                ->Where('idConf', '=', $idConf)
                ->Delete();
        return $mesConferences;
    }
    
}
