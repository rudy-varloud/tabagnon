<?php

namespace App\metier;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use DB;

class Ligne_visite extends Model {

    //
    protected $table = 'ligne_visite';
    public $timestamps = false;
    protected $fillable = [
        'idVisite',
        'idVisiteur',
        'qteBillet',
    ];

    public function getReservations($dateVisite, $idVisite) {
        $reservations = DB::table('ligne_visite')->Select()
                ->join('visiteur', 'visiteur.idVis', '=', 'ligne_visite.idVisiteur')
                ->join('date_visite', 'date_visite.idVisite', '=', 'ligne_visite.idVisite')
                ->where('ligne_visite.idVisite', '=', $idVisite)
                ->where('date_visite.datevisite', '=', $dateVisite)
                ->get();
        return $reservations;
    }

    public function reservationPlace($idVisite, $idVisiteur, $nbPlaceSouhaite, $dateVisite) {
        DB::table('ligne_visite')->insert(['idVisite' => $idVisite, 'idVisiteur' => $idVisiteur, 'dateVisite' => $dateVisite, 'qteBillet' => $nbPlaceSouhaite]);
    }

    public function annulerVis($idVisite, $idVisiteur, $dateVisite) {
        DB::table('ligne_visite')
                ->where('idVisite', '=', $idVisite)
                ->where('idVisiteur', '=', $idVisiteur)
                ->where('dateVisite', '=', $dateVisite)
                ->delete();
    }

    public function checkReservation($idVisite, $dateVisite, $idVisiteur) {
        $check = DB::table('ligne_visite')->select()
                ->where('idVisiteur', '=', $idVisiteur)
                ->where('idVisite', '=', $idVisite)
                ->where('dateVisite', '=', $dateVisite)
                ->first();
        if ($check != null) {
            return "Vous disposez déjà d'une réservation pour cette date !";
        } else {
            return null;
        }
    }

}
