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

}
    