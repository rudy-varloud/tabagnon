<?php

namespace App\Http\Controllers;

use App\metier\Carousel;
use App\metier\Article;
use Request;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Facades\Input;

class ArticleController extends Controller {

    public function getFormArticle() {
        return view('formArticle');
    }

    public function postFormArticle() {
        $titreArticle = Request::input('titreArticle');
        $description = Request::input('description');
        $contenu = Request::input('contenu');
        if (Request::file('imageArticle') != null) {
            if (Request::file('imageArticle')->isValid()) {
                $image = Request::file('imageArticle');
                $unArticle = new Article();               
                $ext = substr(strrchr($image->getClientOriginalName(), "."), 1);
                $imageArticle = $unArticle->getCompteurImage() . "." . $ext;
                $image->move(public_path("/assets/image/article/"), $imageArticle);
                $id = $unArticle->postFormArticleImage($titreArticle, $description, $contenu, $imageArticle);
            } else {
                $error = "L'image n'est pas valide (elle ne doit pas dépasser 200ko)";
                return view('formArticle', compact('error', 'titreArticle', 'description', 'contenu'));
            }
        } else {
            $unArticle = new Article();
            $id = $unArticle->postFormArticle($titreArticle, $description, $contenu);
        }
        return redirect('/article/' . $id);
    }

    public function getLastArticle() {
        $unArticle = new Article();
        $lesArticles = $unArticle->getLastArticle();
        $Carousel = new Carousel;
        $lesImages = $Carousel->getImagesCarouselTrue();
        return view('accueil', compact('lesArticles', 'lesImages'));
    }

    public function getArticle($idA) {
        $unA = new Article();
        $unArticle = $unA->getArticle($idA);
        return view('pageArticle', compact('unArticle'));
    }
    
    public function listerArticle(){
        $unA = new Article();
        $lesArticles = $unA->listerArticle();
        return view('listeArticle', compact('lesArticles'));
    }
    
    public function listeArticleAdmin(){
        $unArticle = new Article();
        $lesArticles = $unArticle->listeArticleAdmin();
        return view('listeArticleAdmin', compact('lesArticles'));
    }
    
    public function deleteArticle($idArticle){
        $unArticle = new Article();
        $lesArticles = $unArticle->deleteArticle($idArticle);
        return view('pageAdmin');
    }
    
    public function modifierArticle($idArticle){
        $unArticle = new Article();
        $mesArticles = $unArticle->modifierArticle($idArticle);
        return view('formModifierArticle', compact('mesArticles'));
    }
    
    public function postFormModifArticle(){
        $id = Request::input('idArticle');
        $titre = Request::input('titreArticle');
        $description = Request::input('description');
        $contenu = Request::input('contenu');
        $date = Request::input('date');
        $unArticle = new Article();
        $unArticle->postModifArticle($id, $titre, $description, $contenu, $date);
        return view ('pageAdmin');
    }

}
