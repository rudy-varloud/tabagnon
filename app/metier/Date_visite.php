<?php

namespace App\metier;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use DB;

class Date_visite extends Model {

    //
    protected $table = 'date_visite';
    public $timestamps = false;
    protected $fillable = [
        'idVisite',
        'dateVisite',
        'nbPlaceRes'
    ];

    public function reservationPlace($idVisite, $nbPlaceSouhaite, $dateVisite) {
        DB::table('date_visite')
                ->where('idVisite', '=', $idVisite)
                ->where('dateVisite', '=', $dateVisite)
                ->increment('nbPlaceRes', $nbPlaceSouhaite);
    }

    public function addDate($id, $date) {
        DB::table('date_visite')->insert(['idVisite' => $id, 'dateVisite' => $date, 'nbPlaceRes' => 0]);
    }

    public function nbPlaceRes($idVisite, $dateVisite) {
        $nb = DB::table('date_visite')->Select('nbPlaceRes')
                ->where('idVisite', '=', $idVisite)
                ->where('dateVisite', '=', $dateVisite)
                ->first();
        return $nb->nbPlaceRes;
    }

    public function rajoutBillet($idVisite, $dateVisite, $qteBillet) {
        DB::table('date_visite')->where('idVisite', '=', $idVisite)
                ->where('dateVisite', '=', $dateVisite)
                ->decrement('nbPlaceRes', $qteBillet);
    }

}
