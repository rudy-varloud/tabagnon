<?php

namespace App\metier;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use DB;

class Like_image extends Model {

    //
    protected $table = 'like_image';
    public $timestamps = false;
    protected $fillable = [
        'idImage',
        'idVisiteur',
    ];

    public function checkLike($idVis, $idImage) {
        $statut = DB::table('like_image')->Select()
                ->where('idVisiteur', '=', $idVis)
                ->where('idImage', '=', $idImage)
                ->get();
        if ($statut != null) {
            return true;
        } else {
            return false;
        }
    }

    public function removeLike($idVis, $idImage) {
        DB::table('like_image')->where('idVisiteur', '=', $idVis)
                ->where('idImage', '=', $idImage)
                ->delete();
    }

    public function addLike($idVis, $idImage) {
        DB::table('like_image')->where('idVisiteur', '=', $idVis)
                ->where('idImage', '=', $idImage)
                ->insert(['idImage' => $idImage, 'idVisiteur' => $idVis]);
    }

    public function countLike($idImage) {
        $compteur = DB::table('like_image')->where('idImage', '=', $idImage)
                ->count();
        return $compteur;
    }

}
