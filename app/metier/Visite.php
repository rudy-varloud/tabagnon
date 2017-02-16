<?php

namespace App\metier;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use DB;

class Visite extends Model {

    protected $table = 'visite';
    public $timestamps = false;
    protected $fillable = [
        'idVisite',
        'lieuxVisite',
        'nbPlace',
        'idGuide',
        'libelleVisite',
        'prixVisite',
        'descriptionVisite',
        'visibiliteVisite'
    ];

    /* 
     * Dialogue avec la BDD pour ajouter une visite
     */
    public function postFormVisite($nomVisite, $lieuxVisite, $descVisite, $prixVisite, $nbPlaceVisite, $idGuideVisite) {
        DB::table('visite')
                ->insert(['lieuxVisite' => $lieuxVisite, 'nbPlace' => $nbPlaceVisite, 'idGuide' => $idGuideVisite,
                    'libelleVisite' => $nomVisite, 'prixVisite' => $prixVisite, 'descriptionVisite' => $descVisite]);
        $id = DB::table('visite')->Select('idVisite')
                ->where('libelleVisite', '=', $nomVisite)
                ->where('lieuxVisite', '=', $lieuxVisite)
                ->where('descriptionVisite', '=', $descVisite)
                ->where('prixVisite', '=', $prixVisite)
                ->where('nbPlace', '=', $nbPlaceVisite)
                ->where('idGuide', '=', $idGuideVisite)
                ->first();
        return $id->idVisite;
    }

    /* 
     * Dialogue avec la BDD pour récuperer la liste des visites
     */
    public function getVisites() {
        $mesVisites = DB::table('visite')
                ->distinct('idVisite')
                ->select('visite.idVisite', 'lieuxVisite', 'nbPlace', 'idGuide', 'libelleVisite', 'prixVisite', 'descriptionVisite')
                ->join('date_visite', 'date_visite.idVisite', '=', 'visite.idVisite')
                ->where('statut', '=', false)
                ->get();
        return $mesVisites;
    }
    
    /* 
     * Dialogue avec la BDD pour récuperer la liste des visites non distinct
     */
    public function getVisitesND() {
        $mesVisites = DB::table('visite')
                ->select()
                ->join('date_visite', 'date_visite.idVisite', '=', 'visite.idVisite')
                ->where('statut', '=', false)
                ->get();
        return $mesVisites;
    }

    /* 
     * Dialogue avec la BDD pour récuperer la liste des visites effectuées
     */
    public function getVisitesEffec() {
        $mesVisites = DB::table('visite')
                ->distinct('idVisite')
                ->select('visite.idVisite', 'lieuxVisite', 'nbPlace', 'nomVis', 'prenomVis', 'libelleVisite', 'prixVisite', 'descriptionVisite')          
                ->join('visiteur', 'visiteur.idVis', '=', 'visite.idGuide')
                ->join('date_visite', 'date_visite.idVisite', '=', 'visite.idVisite')
                ->where('statut', '=', true)
                ->get();
        return $mesVisites;
    }

    /* 
     * Dialogue avec la BDD pour récuperer une visite effectuée (renvoie le nombre de place reservée)
     */
    public function getPlaceRes() {
        $placeVisite = DB::table('date_visite')
                ->select()
                ->where('statut', '=', true)
                ->get();
        return $placeVisite;
    }

    /* 
     * Dialogue avec la BDD pour récuperer le nombre de place d'une visite
     */
    public function nbPlace($idVisite) {
        $nb = DB::table('visite')->Select('nbPlace')
                ->where('idVisite', '=', $idVisite)
                ->first();
        return $nb->nbPlace;
    }

    /* 
     * Dialogue avec la BDD pour récuperer une visite particulière non dépassée
     */
    public function pageVisiteSpe($idVisite) {
        $mesVisites = DB::table('visite')
                ->select('visite.idVisite', 'lieuxVisite', 'nbPlace', 'nbPlaceRes', 'idGuide', 'libelleVisite', 'prixVisite', 'descriptionVisite', 'dateVisite')
                ->join('date_visite', 'date_visite.idVisite', '=', 'visite.idVisite')
                ->where('visite.idVisite', '=', $idVisite)
                ->where('statut', '=', false)
                ->get();
        return $mesVisites;
    }

    /* 
     * Dialogue avec la BDD pour récuperer une visite
     */
    public function getVisite($idVisite) {
        $uneVisite = DB::table('visite')
                ->select()
                ->where('visite.idVisite', '=', $idVisite)
                ->first();
        return $uneVisite;
    }

    /* 
     * Dialogue avec la BDD pour récuperer les 3 dernières visites (id)
     */
    public function getLastVisite() {
        $lesVisites = Visite::orderBy('visite.idVisite', 'desc')
                ->join('date_visite', 'date_visite.idVisite', '=', 'visite.idVisite')
                ->where('statut','=',false)
                ->take(3)
                ->get();
        return $lesVisites;
    }

    /* 
     * Dialogue avec la BDD pour récuperer la liste des visites reservées par un utilisateur
     */
    public function getVisiteUser($idVis) {
        $mesVisites = DB::table('ligne_visite')
                ->select()
                ->join('visite', 'visite.idVisite', '=', 'ligne_visite.idVisite')
                ->join('date_visite', function($join) {
                    $join->on('ligne_visite.idVisite', '=', 'date_visite.idVisite');
                    $join->on('ligne_visite.dateVisite', '=', 'date_visite.dateVisite');
                })
                ->where('idVisiteur', '=', $idVis)
                ->where('statut', '=', false)
                ->get();
        return $mesVisites;
    }

    /* 
     * Dialogue avec la BDD pour récuperer la liste des visites effectuées par un utilisateur
     */
    public function getVisiteUserEffec($idVis) {
        $mesVisites = DB::table('ligne_visite')
                ->select()
                ->join('visite', 'visite.idVisite', '=', 'ligne_visite.idVisite')
                ->join('date_visite', function($join) {
                    $join->on('ligne_visite.idVisite', '=', 'date_visite.idVisite');
                    $join->on('ligne_visite.dateVisite', '=', 'date_visite.dateVisite');
                })
                ->where('idVisiteur', '=', $idVis)
                ->where('statut', '=', true)
                ->get();
        return $mesVisites;
    }
    
    /* 
     * Dialogue avec la BDD pour supprimer une visite
     */
    public function supprimerVisEff($idVisite){
        DB::table('visite')->where('idVisite','=',$idVisite)
                ->delete();
    }
    
    /* 
     * Dialogue avec la BDD pour modifier une visite
     */
    public function updateVisite($idVisite,$nomVisite,$lieuxVisite,$descVisite){
        DB::table('visite')->where('idVisite','=',$idVisite)
                ->update(['libelleVisite' => $nomVisite, 'lieuxVisite' => $lieuxVisite, 'descriptionVisite' => $descVisite]);
    }

}
