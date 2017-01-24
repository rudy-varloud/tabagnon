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
                ->join('date_visite', 'date_visite.idVisite', '=', 'ligne_visite.idVisite')
                ->where('ligne_visite.idVisite', '=', $idVisite)
                ->where('date_visite.datevisite', '=', $dateVisite)
                ->get();
        return $reservations;     
    }
     public function reservationPlace($idVisite, $idVisiteur, $nbPlaceSouhaite) {
        DB::table('ligne_visite')->insert(['idVisite' => $idVisite, 'idVisiteur' => $idVisiteur, 'qteBillet' => $nbPlaceSouhaite]);
    }

}
    