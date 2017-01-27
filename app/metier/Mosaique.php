<?php

namespace App\metier;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use DB;

class Mosaique extends Model {

    //
    protected $table = 'mosaique_image';
    public $timestamps = false;
    protected $fillable = [
        'idImage',
        'idVisiteur',
        'nomImage',
        'descriptionImage',
        'dateCrea',
    ];
    
    public function listeMosaique(){
        $mesMosaiques = DB::table('mosaique_image')
                ->Select()
                ->paginate(5);
        return $mesMosaiques;
    }
    
    public function postFormArticleImage($image, $description, $date, $idVis){
        $mesMosaiques = DB::table('mosaique_image')
                ->insert(['idVisiteur' => $idVis, 'nomImage' => $image, 'descriptionImage' => $description, 'dateCrea' => $date]);
        return $mesMosaiques;
    }
}