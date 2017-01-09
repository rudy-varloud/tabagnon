<?php

namespace App\metier;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use DB;

class Visite extends Model {

    protected $table = 'visite';
    public $timestamps = false;
    protected $fillable = [
        'idVisite',
        'lieuxVisite',
        'nbPlace',
        'idGuide',
        'libelleVisite',
        'prixVisite'
    ];


}
