<?php

namespace App\metier;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use DB;

class Ligne_visite extends Model {

    //
    protected $table = 'client';
    public $timestamps = false;
    protected $fillable = [
        'idVisite',
        'idVisiteur',
        'qteBillet',
    ];
    
     public function getReservations($dateVisite,$idVisite){
        $reservations = DB::table('ligne_visite')->Select()
                ->join('visiteur', 'visiteur.idVis', '=', 'ligne_visite.idVisiteur')
                ->join('visite', 'visite.idVisite', '=', 'ligne_visite.idVisite')
                ->join('date_visite', 'date_visite.idVisite', '=', 'ligne_visite.idVisite')
                ->where('visite.idVisite', '=', $idVisite)
                ->where('datevisite', '=', $dateVisite)
                ->get();
        return $reservations;
    }

}
    