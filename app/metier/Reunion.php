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

    public function postAjoutReunion($type, $adresseReunion, $cpReunion, $date, $heure){
        DB::table('reunion')
                ->insert(['typeReunion' => $type, 'adresseReunion' => $adresseReunion, 'cpReunion' => $cpReunion, 'dateReunion' => $date." ".$heure]);
    }
    
    public function getReunionUser(){
        $mesReunions = DB::table('reunion')
                ->Select()
                ->get();
        return $mesReunions;
    }
    
    public function getReunion(){
        $mesReunions = DB::table('reunion')
                ->Select()
                ->get();
        return $mesReunions;
    }
    
    public function supprReunion($idReunion){
        DB::table('reunion')
                ->Where('idReunion','=', $idReunion)
                ->Delete();
    }
    
}

