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

    public function getVisites() {
        $mesVisites = DB::table('visite')
                ->select('visite.idVisite', 'lieuxVisite', 'nbPlace', 'idGuide', 'libelleVisite', 'prixVisite', 'descriptionVisite')
                ->join('date_visite', 'date_visite.idVisite', '=', 'visite.idVisite')
                ->where('statut', '=', false)
                ->get();
        return $mesVisites;
    }

    public function nbPlace($idVisite) {
        $nb = DB::table('visite')->Select('nbPlace')
                ->where('idVisite', '=', $idVisite)
                ->first();
        return $nb->nbPlace;
    }

    public function pageVisiteSpe($idVisite) {
        $mesVisites = DB::table('visite')
                ->select('visite.idVisite', 'lieuxVisite', 'nbPlace', 'nbPlaceRes', 'idGuide', 'libelleVisite', 'prixVisite', 'descriptionVisite', 'dateVisite')
                ->join('date_visite', 'date_visite.idVisite', '=', 'visite.idVisite')
                ->where('visite.idVisite', '=', $idVisite)
                ->where('statut','=',false)
                ->get();
        return $mesVisites;
    }

    public function getVisite($idVisite) {
        $uneVisite = DB::table('visite')
                ->select()
                ->where('visite.idVisite', '=', $idVisite)
                ->first();
        return $uneVisite;
    }

    public function getLastVisite() {
        $lesVisites = Visite::orderBy('idVisite', 'desc')->take(3)->get();
        return $lesVisites;
    }

    public function getVisiteUser($idVis) {
        $mesVisites = DB::table('ligne_visite')
                ->select()
                ->join('visite', 'visite.idVisite', '=', 'ligne_visite.idVisite')
                ->join('date_visite', function($join) {
                    $join->on('ligne_visite.idVisite', '=', 'date_visite.idVisite');
                    $join->on('ligne_visite.dateVisite', '=', 'date_visite.dateVisite');
                })
                ->where('idVisiteur', '=', $idVis)
                ->get();
        return $mesVisites;
    }

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

}
