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

    /* 
     * Dialogue avec la BDD pour vérifier l'existance d'un like
     */
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

    /* 
     * Dialogue avec la BDD pour supprimer un like
     */
    public function removeLike($idVis, $idImage) {
        DB::table('like_image')->where('idVisiteur', '=', $idVis)
                ->where('idImage', '=', $idImage)
                ->delete();
    }

    /* 
     * Dialogue avec la BDD pour ajouter un like
     */
    public function addLike($idVis, $idImage) {
        DB::table('like_image')->where('idVisiteur', '=', $idVis)
                ->where('idImage', '=', $idImage)
                ->insert(['idImage' => $idImage, 'idVisiteur' => $idVis]);
    }

    /* 
     * Dialogue avec la BDD pour compter le nombre de like
     */
    public function countLike($idImage) {
        $compteur = DB::table('like_image')->where('idImage', '=', $idImage)
                ->count();
        return $compteur;
    }
    
    public function supprUserLikeImage($idVisiteur){
        DB::table('like_image')
                ->where('idVisiteur', '=', $idVisiteur)
                ->delete();
    }

}
