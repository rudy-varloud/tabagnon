<?php

namespace App\metier;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use DB;

class Article extends Model {

    //
    protected $table = 'article';
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
        $unA = DB::table('Article')->Select()
                ->where('idArticle', '=', $idA)
                ->first();
        return $unA;
    }

    /* 
     * Dialogue avec la BDD pour ajout un article avec une image
     */
    public function postFormArticleImage($titreArticle, $description, $contenue, $imageArticle) {
        $dateJour = date('Y/m/d', time());
        DB::table('Article')
                ->insert(
                        ['titreArticle' => $titreArticle, 'description' => $description,
                            'contenu' => $contenue, 'imageArticle' => $imageArticle, 'dateCreation' => $dateJour, 'dateEdition' => $dateJour]);
        $id = DB::table('Article')->Select('idArticle')
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
        DB::table('Article')
                ->insert(
                        ['titreArticle' => $titreArticle, 'description' => $description,
                            'contenu' => $contenue, 'dateCreation' => $dateJour, 'dateEdition' => $dateJour, 'imageArticle' => 'default.png']);
        $id = DB::table('Article')->Select('idArticle')
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
        $lesArticles = Article::orderBy('idArticle', 'desc')->take(3)->get();
        return $lesArticles;
    }

    /* 
     * Dialogue avec la BDD pour récupérer le nombre d'article dans la BDD
     */
    public function getCompteurImage() {
        $cpt = DB::table('Article')->count();
        return $cpt + 1;
    }

    /* 
     * Dialogue avec la BDD pour récupérer la liste des articles (5 par page)
     */
    public function listerArticle() {
        $lesArticles = DB::table('Article')->Select()
                ->orderBy('dateCreation', 'DESC')
                ->paginate(5);
        return $lesArticles;
    }

    /* 
     * Dialogue avec la BDD pour récupérer la liste des articles pour l'administration 
     * 10 par page.
     */
    public function listeArticleAdmin() {
        $lesArticles = DB::table('Article')
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

}
