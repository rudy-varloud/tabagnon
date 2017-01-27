<?php

namespace App\metier;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use DB;

class Ligne_conference extends Model {

    //
    protected $table = 'ligne_conference';
    public $timestamps = false;
    protected $fillable = [
        'idConf',
        'idVisiteur',
        'qteBillet',
        'idImage',
    ];

    public function annulerConf($idConf, $idVis) {
        DB::table('ligne_conference')
                ->where('idVisiteur', '=', $idVis)
                ->where('idConf', '=', $idConf)
                ->delete();
    }

    public function modifierPlaceConf($idConf, $idVis, $qteBillet) {
        DB::table('ligne_conference')
        ->where('idVisiteur', '=', $idVis)
        ->where('idConf', '=', $idConf)
        ->update(['qteBillet' =>$qteBillet]);
    }

}
