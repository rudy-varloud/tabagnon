<?php

namespace App\metier;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use DB;

class Reunion extends Model {

    protected $table = 'reunion';
    public $timestamps = false;
    protected $fillable = [
        'idReunion',
        'typeReunion',
        'adresseReunion',
        'cpReunion',
        'dateReunion'
    ];

    public function postAjoutReunion($type, $adresseReunion, $cpReunion, $date, $heure) {
        DB::table('reunion')
                ->insert(['typeReunion' => $type, 'adresseReunion' => $adresseReunion, 'cpReunion' => $cpReunion, 'dateReunion' => $date . " " . $heure]);
    }

    public function getReunionUser() {
        $mesReunions = DB::table('reunion')
                ->Select()
                ->Where('statut', '=', 0)
                ->get();
        return $mesReunions;
    }

    public function getReunion() {
        $mesReunions = DB::table('reunion')
                ->Select()
                ->get();
        return $mesReunions;
    }

    public function supprReunion($idReunion) {
        DB::table('reunion')
                ->Where('idReunion', '=', $idReunion)
                ->Delete();
    }

    public function ajoutCr($idReunion) {
        $mesReunions = DB::table('reunion')
                ->Select()
                ->Where('idReunion', '=', $idReunion)
                ->first();
        return $mesReunions;
    }
    
    public function postAjoutCr($idReunion, $dlCompteRendu, $contenuReunion){
        DB::table('reunion')
                ->where('idReunion','=', $idReunion)
                ->update(['dlCompteRendu'=>$dlCompteRendu, 'contenuReunion' =>$contenuReunion]);
    }
    
    public function getReunionEffec(){
        $mesReunions = DB::table('reunion')
                ->Select()
                ->Where('statut', '=', 1)
                ->get();
        return $mesReunions;
    }
    
    public function getCompteRendu($idReunion){
        $mesReunions = DB::table('reunion')
                ->Select()
                ->Where('idReunion','=',$idReunion)
                ->first();
        return $mesReunions;
    }

}
