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

    /* 
     * Dialogue avec la BDD incrémenter le nombre de place reservée d'une visite
     */
    public function reservationPlace($idVisite, $nbPlaceSouhaite, $dateVisite) {
        DB::table('date_visite')
                ->where('idVisite', '=', $idVisite)
                ->where('dateVisite', '=', $dateVisite)
                ->increment('nbPlaceRes', $nbPlaceSouhaite);
    }

    /* 
     * Dialogue avec la BDD pour ajouter une date a une visite
     */
    public function addDate($id, $date) {
        DB::table('date_visite')->insert(['idVisite' => $id, 'dateVisite' => $date, 'nbPlaceRes' => 0]);
    }

    /* 
     * Dialogue avec la BDD pour récupérer le nombre de place reservée d'une visite
     */
    public function nbPlaceRes($idVisite, $dateVisite) {
        $nb = DB::table('date_visite')->Select('nbPlaceRes')
                ->where('idVisite', '=', $idVisite)
                ->where('dateVisite', '=', $dateVisite)
                ->first();
        return $nb->nbPlaceRes;
    }
}
