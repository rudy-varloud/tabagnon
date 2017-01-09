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
        'idVisiteur'
    ];

}   