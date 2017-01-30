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

    public function listeMosaique() {
        $mesMosaiques = DB::table('mosaique_image')
                ->Select()
                ->paginate(10);
        return $mesMosaiques;
    }

    public function postFormMosaiqueImage($image, $description, $date, $idVis) {
        $mesMosaiques = DB::table('mosaique_image')
                ->insert(['idVisiteur' => $idVis, 'nomImage' => $image, 'descriptionImage' => $description, 'dateCrea' => $date]);
        return $mesMosaiques;
    }

    public function getImage($idImage) {
        $mesMosaiques = DB::table('mosaique_image')
                ->Select()
                ->join('visiteur', 'visiteur.idVis', '=', 'mosaique_image.idVisiteur')
                ->Where('idImage', '=', $idImage)
                ->first();
        return $mesMosaiques;
    }

    public function postAjoutCommentaire($idImage, $date, $idVis, $commentaire) {
        $mesMosaiques = Db::table('commentaire_image')
                ->insert(['idVisi' => $idVis, 'idImg' => $idImage, 'commentaire' => $commentaire, 'dateCommentaire' => $date]);
        return $mesMosaiques;
    }

    public function getCommentaireImage($idImage) {
        $mesMosaiques = DB::table('commentaire_image')
                ->Select()
                ->join('visiteur', 'visiteur.idVis', '=', 'commentaire_image.idVisi')
                ->Where('idImg', '=', $idImage)
                ->orderBy('dateCommentaire', 'DESC')
                ->paginate(15);
        return $mesMosaiques;
    }
    
    public function deleteImage($idImage){
        $mesMosaiques = DB::table('mosaique_image')
                ->Where('idImage', "=", $idImage)
                ->Delete();
        return $mesMosaiques;
    }
    
    public function deleteCom($idImage){
        $mesMosaiques = DB::table('commentaire_image')
                ->Where('idImg', "=", $idImage)
                ->Delete();
        return $mesMosaiques;
    }

}
