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

    /* 
     * Dialogue avec la BDD pour récupérer les images de la mosaiue (10 par page)
     */
    public function listeMosaique() {
        $mesMosaiques = DB::table('mosaique_image')
                ->Select()
                ->Where('visibilite', '=', 2)
                ->paginate(10);
        return $mesMosaiques;
    }

    /* 
     * Dialogue avec la BDD pour ajouter une image à la mosaïque
     */
    public function postFormMosaiqueImage($image, $description, $date, $idVis,$visibilite) {
        DB::table('mosaique_image')
                ->insert(['idVisiteur' => $idVis, 'nomImage' => $image, 'descriptionImage' => $description, 'dateCrea' => $date, 'visibilite' => $visibilite]);
    }

    /* 
     * Dialogue avec la BDD pour récupérer une image de la mosaique
     */
    public function getImage($idImage) {
        $image = DB::table('mosaique_image')
                ->Select()
                ->join('visiteur', 'visiteur.idVis', '=', 'mosaique_image.idVisiteur')
                ->Where('idImage', '=', $idImage)
                ->first();
        return $image;
    }

    /* 
     * Dialogue avec la BDD pour ajouter un commentaire à une image de la mosaique
     */
    public function postAjoutCommentaire($idImage, $date, $idVis, $commentaire) {
        Db::table('commentaire_image')
                ->insert(['idVisi' => $idVis, 'idImg' => $idImage, 'commentaire' => $commentaire, 'dateCommentaire' => $date]);
    }

    /* 
     * Dialogue avec la BDD pour récupérer les commentaires d'une image de la mosaique
     */
    public function getCommentaireImage($idImage) {
        $mesCommentaires = DB::table('commentaire_image')
                ->Select()
                ->join('visiteur', 'visiteur.idVis', '=', 'commentaire_image.idVisi')
                ->Where('idImg', '=', $idImage)
                ->orderBy('dateCommentaire', 'DESC')
                ->paginate(15);
        return $mesCommentaires;
    }

    /* 
     * Dialogue avec la BDD pour supprimer une image de la mosaique (ainsi que le fichier)
     */
    public function deleteImage($idImage,$nomImage) {
        DB::table('mosaique_image')
                ->Where('idImage', "=", $idImage)
                ->Delete();
        \File::delete(public_path()."/assets/image/mosaique/".$nomImage);
    }

    /* 
     * Dialogue avec la BDD pour supprimer les commentaires d'une image de la mosaique
     */
    public function deleteCom($idImage) {
        DB::table('commentaire_image')
                ->Where('idImg', "=", $idImage)
                ->Delete();
    }

    /* 
     * Dialogue avec la BDD pour supprimer un commentaire d'une image de la mosaique
     */
    public function deleteComSpe($idCommentaire) {
        Db::table('commentaire_image')
                ->Where('idCommentaire', '=', $idCommentaire)
                ->Delete();
    }

    /* 
     * Dialogue avec la BDD pour récuperer les images en attentes de la mosaique (10 par page)
     */
    public function getAttenteMosa() {
        $mesMosaiques = DB::table('mosaique_image')
                ->Select()
                ->Where('visibilite', '=', 1)
                ->paginate(10);
        return $mesMosaiques;
    }

    /* 
     * Dialogue avec la BDD pour valider une image de la mosaique
     */
    public function validerImage($id) {
        DB::table('mosaique_image')
                ->Where('idImage', '=', $id)
                ->update(['visibilite' => '2']);
    }

    /* 
     * Dialogue avec la BDD pour compter le nombre d'image de la mosaique
     */
    public function getCompteurImage() {
        $cpt = DB::table('mosaique_image')->count();
        return $cpt + 1;
    }

    public function deleteLike($idImage) {
        DB::table('like_image')
                ->where('idImage', '=', $idImage)
                ->delete();
    }
}
