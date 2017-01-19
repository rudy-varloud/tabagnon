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
        'descriptionVisite'
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

    public function getVisite() {
        $mesVisites = DB::table('visite')
                ->join('date_visite', 'date_visite.idVisite', '=', 'visite.idVisite')
                ->select('visite.idVisite', 'lieuxVisite', 'nbPlace', 'nbPlaceRes', 'idGuide', 'libelleVisite', 'prixVisite', 'descriptionVisite')
                ->get();
        return $mesVisites;
    }

    public function pageVisiteSpe($idVisite) {
        $mesVisites = DB::table('visite')
                ->select('visite.idVisite', 'lieuxVisite', 'nbPlace', 'nbPlaceRes', 'idGuide', 'idGuide', 'libelleVisite', 'prixVisite', 'descriptionVisite', 'dateVisite')
                ->join('date_visite', 'date_visite.idVisite', '=', 'visite.idVisite')
                ->where('visite.idVisite', '=', $idVisite)
                ->get();
        return $mesVisites;
    }

}
