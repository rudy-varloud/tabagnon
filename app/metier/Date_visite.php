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
    
    public function reservationPlace($idVisite, $nbPlaceSouhaite,$dateVisite) {
        $mesVisites = DB::table('date_visite')
                ->where('idVisite', '=', $idVisite)
                ->where('dateVisite','=',$dateVisite)
                ->increment('nbPlaceRes', $nbPlaceSouhaite);
        return $mesVisites;
    }
    public function addDate($id,$date){
        DB::table('date_visite')->insert(['idVisite' => $id,'dateVisite' => $date,'nbPlaceRes' => 0]);
    }
}
