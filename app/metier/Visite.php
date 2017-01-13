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
    
    public function postFormVisite($nomVisite, $lieuxVisite, $descVisite, $dateVisite, $prixVisite, $nbPlaceVisite, $nomGuideVisite){
        $mesVisites = DB::table('visite')
                ->insert(['lieuxVisite' => $lieuxVisite, 'nbPlace' => $nbPlaceVisite, 'idGuide' => $nomGuideVisite,
                    'libelleVisite' => $nomVisite, 'prixVisite' => $prixVisite, 'descriptionVisite' => $descVisite, 'dateVisite' => $dateVisite]);
        return $mesVisites;
    }
    
    public function getVisite(){
        $mesVisites = DB::table('visite')
                ->select('idVisite', 'lieuxVisite', 'nbPlace','nbPlaceRes', 'idGuide', 'idGuide', 'libelleVisite', 'prixVisite', 'descriptionVisite', 'dateVisite')
                ->orderBy ('dateVisite', 'ASC')
                ->get();
        return $mesVisites;
    }
    
    public function pageVisiteSpe($idVisite){
        $mesVisites = DB::table('visite')
                ->select('idVisite', 'lieuxVisite', 'nbPlace','nbPlaceRes', 'idGuide', 'idGuide', 'libelleVisite', 'prixVisite', 'descriptionVisite', 'dateVisite')
                -> where ('idVisite', '=', $idVisite)
                ->get();
        return $mesVisites;
    }


}
