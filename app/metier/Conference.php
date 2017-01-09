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
    
}
    