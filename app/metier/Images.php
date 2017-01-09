<?php

namespace App\metier;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use DB;

class Images extends Model {

    //
    protected $table = 'images';
    public $timestamps = false;
    protected $fillable = [
        'idImage',
    ];
}
    
