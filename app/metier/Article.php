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
                ->where('titreArticle' , '=' ,$titreArticle)
                ->where('description' , '=' ,$description)
                ->where('imageArticle' , '=' ,$imageArticle)
                ->where('dateCreation' , '=' ,$dateJour)
                ->where('dateEdition' , '=' ,$dateJour)
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
                ->where('titreArticle' , '=' ,$titreArticle)
                ->where('description' , '=' ,$description)
                ->where('imageArticle' , '=' ,'default.png')
                ->where('dateCreation' , '=' ,$dateJour)
                ->where('dateEdition' , '=' ,$dateJour)
                ->first();
        return $id->idArticle;
    }

    public function getLastArticle() {
        $lesArticles = Article::orderBy('idArticle', 'desc')->take(3)->get();
        return $lesArticles;
    }
    
    public function getCompteurImage(){
        $cpt = DB::table('Article')->count();
        return $cpt+1;
    }

}
