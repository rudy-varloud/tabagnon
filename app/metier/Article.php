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

    public function getArticle($idA) {
        $unA = DB::table('Article')->Select()
                ->where('idArticle', '=', $idA)
                ->first();
        return $unA;
    }

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

    public function getLastArticle() {
        $lesArticles = Article::orderBy('idArticle', 'desc')->take(3)->get();
        return $lesArticles;
    }

    public function getCompteurImage() {
        $cpt = DB::table('Article')->count();
        return $cpt + 1;
    }

    public function listerArticle() {
        $lesArticles = DB::table('Article')->Select()
                ->orderBy('dateCreation', 'DESC')
                ->paginate(5);
        return $lesArticles;
    }

    public function listeArticleAdmin() {
        $lesArticles = DB::table('Article')
                ->Select()
                ->paginate(10);
        return $lesArticles;
    }

    public function deleteArticle($idArticle) {
        DB::table('article')
                ->Where('idArticle', "=", $idArticle)
                ->Delete();
    }

    public function modifierArticle($idArticle) {
        $mesArticles = DB::table('article')
                ->Select()
                ->where('idArticle', '=', $idArticle)
                ->first();
        return $mesArticles;
    }

    public function postModifArticle($id, $titre, $description, $contenu, $date) {
        DB::table('article')
                ->where('idArticle', '=', $id)
                ->update(['titreArticle' => $titre, 'description' => $description, 'contenu' => $contenu, 'dateEdition' => $date]);
    }

}
