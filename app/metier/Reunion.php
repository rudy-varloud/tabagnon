<?php

namespace App\metier;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use DB;

class Visite extends Model {

    protected $table = 'reunion';
    public $timestamps = false;
    protected $fillable = [
        'idReunion',
        'typeReunion',
        'adresseReunion',
        'cpReunion',
        'dateReunion'
    ];

    
    
}

