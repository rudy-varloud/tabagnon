<?php

namespace App\metier;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use DB;

class Conference extends Model {

    //
    protected $table = 'conference';
    public $timestamps = false;
    protected $fillable = [
        'idConf',
        'libConf',
        'prixConf',
        'dateCreation',
    ];
    
    public function postAjoutConf($nomConf,  $prixConf, $contenuConf, $adresseConf, $cpConf, $dateConf, $heureConf){
       $conference = DB::table('conference')
                ->Insert(['libConf' => $nomConf, 'prixConf' => $prixConf, 'contenuConf' => $contenuConf,
                    'adresseConf' => $adresseConf, 'cpConf' => $cpConf, 'dateConf' => $dateConf, 'heureConf' => $heureConf]);
        return $conference;
    }
    
    public function getConference(){
        $conference = DB::table('conference')
                ->select()
                ->get();
        return $conference;
    }
    
    }
    
    