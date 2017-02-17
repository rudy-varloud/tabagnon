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

    /*
     * Dialogue avec la BDD pour ajouter une conférence
     */

    public function postAjoutConf($nomConf, $prixConf, $placeDispoConf, $contenuConf, $adresseConf, $cpConf, $datetime) {
        $date = date_create($datetime);
        DB::table('conference')
                ->Insert(['libConf' => $nomConf, 'prixConf' => $prixConf, 'placeDispoConf' => $placeDispoConf, 'contenuConf' => $contenuConf,
                    'adresseConf' => $adresseConf, 'cpConf' => $cpConf, 'dateConf' => $date]);
    }

    /*
     * Dialogue avec la BDD pour récupérer l'ensemble des conférences
     */

    public function getConference() {
        $conference = DB::table('conference')
                ->select()
                ->where('statut', '=', false)
                ->get();
        return $conference;
    }

    /*
     * Dialogue avec la BDD pour récupérer une conférence dépassée
     */

    public function getConferencesEffec() {
        $conferences = DB::table('conference')
                ->select()
                ->where('statut', '=', true)
                ->get();
        return $conferences;
    }

    /*
     * Dialogue avec la BDD pour récupérer une conférence.
     */

    public function getConferenceSpe($idConf) {
        $conference = DB::table('conference')
                ->select()
                ->where('idConf', '=', $idConf)
                ->first();
        return $conference;
    }

    /*
     * Dialogue avec la BDD pour récupérer incrémenter
     * le nombre de place reservée d'une conférence
     */

    public function postFromReserveConf($idConf, $placeSouhaite) {
        DB::table('conference')
                ->where('idConf', '=', $idConf)
                ->increment('placeReserConf', $placeSouhaite);
    }

    /*
     * Dialogue avec la BDD pour récupérer les trois dernières conférences (id)
     */

    public function getLastConference() {
        $lesConf = Conference::orderBy('idConf', 'desc')->take(3)->where('statut','=',false)->get();
        return $lesConf;
    }

    /*
     * Dialogue avec la BDD pour récupérer les participants d'une conférence
     */

    public function getUserConf($idConf) {
        $conference = DB::table('ligne_conference')
                ->select()
                ->join('visiteur', 'ligne_conference.idVisiteur', '=', 'visiteur.idVis')
                ->Where('idConf', '=', $idConf)
                ->get();
        return $conference;
    }

    /*
     * Dialogue avec la BDD pour récupérer les conférences reservées par un utilisateur
     */

    public function getConfUser($idVis) {
        $conferences = DB::table('conference')
                ->select()
                ->join('ligne_conference', 'conference.idConf', '=', 'ligne_conference.idConf')
                ->where('idVisiteur', '=', $idVis)
                ->where('statut','=', false)
                ->get();
        return $conferences;
    }

    /*
     * Dialogue avec la BDD pour récupérer les conférences effectuées par un utilisateur
     */

    public function getConfUserEffec($idVis) {
        $conferences = DB::table('conference')
                ->select()
                ->join('ligne_conference', 'conference.idConf', '=', 'ligne_conference.idConf')
                ->where('idVisiteur', '=', $idVis)
                ->where('statut', '=', true)
                ->get();
        return $conferences;
    }

    /*
     * Dialogue avec la BDD pour décrementer le nombre de place libre d'une conférence
     */

    public function modifierPlaceLibre($idConf, $qteBillet, $placeRes) {
        $update = $placeRes - $qteBillet;
        DB::table('conference')->where('idConf', '=', $idConf)
                ->decrement('placeReserConf', $update);
    }

    /*
     * Dialogue avec la BDD pour récupérer une conférence
     */

    public function modifConf($idConf) {
        $mesConferences = DB::table('conference')
                ->Select()
                ->Where('idConf', '=', $idConf)
                ->First();
        return $mesConferences;
    }

    /*
     * Dialogue avec la BDD pour modifier une conférence
     */

    public function postModifAjoutConf($id, $nom, $place, $contenu, $adresseConf, $cpConf) {
        DB::table('conference')
                ->where('idConf', '=', $id)
                ->update(['libConf' => $nom, 'placeDispoConf' => $place, 'contenuConf' => $contenu,
                    'adresseConf' => $adresseConf, 'cpConf' => $cpConf]);
    }

    /*
     * Dialogue avec la BDD pour supprimer une conférence
     */

    public function supprConf($idConf) {
        $mesConferences = DB::table('conference')
                ->Where('idConf', '=', $idConf)
                ->Delete();
        return $mesConferences;
    }

    /*
     * Dialogue avec la BDD pour supprimer une conférence effectué
     */

    public function supprimerConfEff($idConf) {
        DB::table('conference')
                ->Where('idConf', '=', $idConf)
                ->Delete();
    }
    
    public function decrementPlaceRes($idConf,$qteBillet){
        DB::table('conference')
                ->where('idConf','=',$idConf)
                ->decrement('placeReserConf',$qteBillet);
    }
}
