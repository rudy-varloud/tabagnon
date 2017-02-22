<?php

namespace App\metier;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use DB;

class Article extends Model {

    //
    protected $table = 'ARTICLE';
    public $timestamps = false;
    protected $fillable = [
        'idArticle',
        'titreArticle',
        'description',
        'contenu',
        'imageArticle',
        'idVisiteur',
        'dateCreation',
        'dateEdition'
    ];

    /* 
     * Dialogue avec la BDD pour récupérer un article
     */
    public function getArticle($idA) {
        $unA = DB::table('article')->Select()
                ->where('idArticle', '=', $idA)
                ->first();
        return $unA;
    }
    
    public function getImageArticle($idA){
        $unArticle2 = DB::table('image_article')
                ->Select()
                ->Where('idArti', '=', $idA)
                ->first();
        return $unArticle2;
    }

    /* 
     * Dialogue avec la BDD pour ajout un article avec une image
     */
    public function postFormArticleImage($titreArticle, $description, $contenue, $imageArticle) {
        $dateJour = date('Y/m/d', time());
        DB::table('article')
                ->insert(
                        ['titreArticle' => $titreArticle, 'description' => $description,
                            'contenu' => $contenue, 'imageArticle' => $imageArticle, 'dateCreation' => $dateJour, 'dateEdition' => $dateJour]);
        $id = DB::table('article')->Select('idArticle')
                ->where('titreArticle', '=', $titreArticle)
                ->where('description', '=', $description)
                ->where('imageArticle', '=', $imageArticle)
                ->where('dateCreation', '=', $dateJour)
                ->where('dateEdition', '=', $dateJour)
                ->first();
        return $id->idArticle;
    }

    /* 
     * Dialogue avec la BDD pour ajouter un article sans image
     */
    public function postFormArticle($titreArticle, $description, $contenue) {
        $dateJour = date('Y/m/d', time());
        DB::table('article')
                ->insert(
                        ['titreArticle' => $titreArticle, 'description' => $description,
                            'contenu' => $contenue, 'dateCreation' => $dateJour, 'dateEdition' => $dateJour, 'imageArticle' => 'default.png']);
        $id = DB::table('article')->Select('idArticle')
                ->where('titreArticle', '=', $titreArticle)
                ->where('description', '=', $description)
                ->where('imageArticle', '=', 'default.png')
                ->where('dateCreation', '=', $dateJour)
                ->where('dateEdition', '=', $dateJour)
                ->first();
        return $id->idArticle;
    }

    /* 
     * Dialogue avec la BDD pour récupérer les 3 derniers articles (id)
     */
    public function getLastArticle() {
        $lesArticles = DB::table('article')
                ->orderBy('idArticle', 'desc')
                ->take(4)
                ->get();
        return $lesArticles;
    }

    /* 
     * Dialogue avec la BDD pour récupérer le nombre d'article dans la BDD
     */
    public function getCompteurImage() {
        $cpt = DB::table('article')->count();
        return $cpt + 1;
    }

    /* 
     * Dialogue avec la BDD pour récupérer la liste des articles (5 par page)
     */
    public function listerArticle() {
        $lesArticles = DB::table('article')->Select()
                ->orderBy('dateCreation', 'DESC')
                ->paginate(5);
        return $lesArticles;
    }

    /* 
     * Dialogue avec la BDD pour récupérer la liste des articles pour l'administration 
     * 10 par page.
     */
    public function listeArticleAdmin() {
        $lesArticles = DB::table('article')
                ->Select()
                ->paginate(10);
        return $lesArticles;
    }

    /* 
     * Dialogue avec la BDD pour supprimer un article
     */
    public function deleteArticle($idArticle) {
        DB::table('article')
                ->Where('idArticle', "=", $idArticle)
                ->Delete();
    }

    /* 
     * Dialogue avec la BDD pour récupérer un article
     */
    public function modifierArticle($idArticle) {
        $mesArticles = DB::table('article')
                ->Select()
                ->where('idArticle', '=', $idArticle)
                ->first();
        return $mesArticles;
    }

    /* 
     * Dialogue avec la BDD pour modifier un article
     */
    public function postModifArticle($id, $titre, $description, $contenu, $date) {
        DB::table('article')
                ->where('idArticle', '=', $id)
                ->update(['titreArticle' => $titre, 'description' => $description, 'contenu' => $contenu, 'dateEdition' => $date]);
    }
    
    public function ajouterUneImageArticle(){
        $mesArticles = DB::table('article')
                ->Select()
                ->get();
        return $mesArticles;
    }
    
    public function postAjoutPhotoArticle($idArti, $nomImage){
        DB::table('image_article')
                ->insert(['idArti' => $idArti, 'nomImage' => $nomImage]);
    }

}
