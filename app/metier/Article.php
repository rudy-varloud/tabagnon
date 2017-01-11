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

    public function postFormArticleImage($titreArticle, $description, $contenue, $imageArticle) {
        $dateJour = date('Y/m/d', time());
        DB::table('Article')
                ->insert(
                        ['titreArticle' => $titreArticle, 'description' => $description,
                            'contenu' => $contenue, 'imageArticle' => $imageArticle, 'dateCreation'=> $dateJour, 'dateEdition' => $dateJour]);
    }
    
    public function postFormArticle($titreArticle, $description, $contenue) {
        $dateJour = date('Y/m/d', time());
        DB::table('Article')
                ->insert(
                        ['titreArticle' => $titreArticle, 'description' => $description,
                            'contenu' => $contenue, 'dateCreation'=> $dateJour, 'dateEdition' => $dateJour]);
    }
    
    public function getLastArticle(){
        $lesArticles = Article::orderBy('idArticle', 'desc')->take(4)->get();
        return $lesArticles;
    }
}
