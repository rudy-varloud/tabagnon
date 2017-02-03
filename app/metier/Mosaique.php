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
                ->Where('visibilite', '=', 2)
                ->paginate(10);
        return $mesMosaiques;
    }

    public function postFormMosaiqueImage($image, $description, $date, $idVis) {
        DB::table('mosaique_image')
                ->insert(['idVisiteur' => $idVis, 'nomImage' => $image, 'descriptionImage' => $description, 'dateCrea' => $date, 'visibilite' => '1']);
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
        Db::table('commentaire_image')
                ->insert(['idVisi' => $idVis, 'idImg' => $idImage, 'commentaire' => $commentaire, 'dateCommentaire' => $date]);
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

    public function deleteImage($nomImage) {
        DB::table('mosaique_image')
                ->Where('nomImage', "=", $nomImage)
                ->Delete();
        \File::delete(public_path()."/assets/image/mosaique/".$nomImage);
    }

    public function deleteCom($idImage) {
        DB::table('commentaire_image')
                ->Where('idImg', "=", $idImage)
                ->Delete();
    }

    public function deleteComSpe($idCommentaire) {
        Db::table('commentaire_image')
                ->Where('idCommentaire', '=', $idCommentaire)
                ->Delete();
    }

    public function ValidMosa() {
        $mesMosaiques = DB::table('mosaique_image')
                ->Select()
                ->Where('visibilite', '=', 1)
                ->paginate(10);
        return $mesMosaiques;
    }

    public function validerImage($id) {
        DB::table('mosaique_image')
                ->Where('idImage', '=', $id)
                ->update(['visibilite' => '2']);
    }

    public function getCompteurImage() {
        $cpt = DB::table('mosaique_image')->count();
        return $cpt + 1;
    }

}
