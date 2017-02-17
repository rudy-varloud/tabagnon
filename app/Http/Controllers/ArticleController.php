<?php

namespace App\Http\Controllers;

use App\metier\Carousel;
use App\metier\Article;
use App\metier\Visite;
use App\metier\Conference;
use Request;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Facades\Input;

class ArticleController extends Controller {
    
    /* 
     * Accède au formulaire de création d'article
     */
    public function getFormArticle() {
        return view('/Article/formArticle');
    }

    /* Récupère les données du formulaire de création d'article.
     * Créer un nom pour l'image de l'article et la redirige dans le dossier indiqué.
     */
    public function postFormArticle() {
        $titreArticle = Request::input('titreArticle');
        $description = Request::input('description');
        $contenu = Request::input('contenu');
        if (Request::file('imageArticle') != null) {
            if (Request::file('imageArticle')->isValid()) {
                $image = Request::file('imageArticle');
                $unArticle = new Article();               
                $ext = substr(strrchr($image->getClientOriginalName(), "."), 1);
                $imageArticle = 'imageA' . mt_rand() . mt_rand() . "." . $ext;
                $image->move(public_path("/assets/image/article/"), $imageArticle);
                $id = $unArticle->postFormArticleImage($titreArticle, $description, $contenu, $imageArticle);
            } else {
                $error = "L'image n'est pas valide (elle ne doit pas dépasser 15 Mo)";
                return view('/Article/formArticle', compact('error', 'titreArticle', 'description', 'contenu'));
            }
        } else {
            $unArticle = new Article();
            $id = $unArticle->postFormArticle($titreArticle, $description, $contenu);
        }
        return redirect('/article/' . $id);
    }
    
    /* Créer l'appel de récupération des données des suivantes : 
     * Articles, Visites, Conférences, Images carousel pour la page d'accueil
     */
    public function getLastDonnees() {
        $unArticle = new Article();
        $lesArticles = $unArticle->getLastArticle();
        $Carousel = new Carousel;
        $lesImages = $Carousel->getImagesCarouselTrue();
        $uneVisite = new Visite();
        $uneConference = new Conference();
        $lesVisites = $uneVisite->getLastVisite();
        $lesConferences = $uneConference->getLastConference();
        $message ="";
        return view('accueil', compact('lesArticles', 'lesImages','lesVisites','lesConferences','message'));
    }

    /* 
     * Créer l'appel de récupération des données d'un article 
     */
    public function getArticle($idA) {
        $unA = new Article();
        $unArticle = $unA->getArticle($idA);
        return view('/Article/pageArticle', compact('unArticle'));
    }
    
    /* Créer l'appel de récupération des données de l'ensemble des articles
     * pour l'utilisateur.
     */
    public function listerArticle(){
        $unA = new Article();
        $lesArticles = $unA->listerArticle();
        return view('/Article/listeArticle', compact('lesArticles'));
    }
    
    /* Créer l'appel de récupération des données de l'ensemble des articles 
     * pour l'administration.
     */
    public function listeArticleAdmin(){
        $unArticle = new Article();
        $lesArticles = $unArticle->listeArticleAdmin();
        return view('/Article/listeArticleAdmin', compact('lesArticles'));
    }
    
    /* 
     * Créer l'appel de suppression d'un article
     */
    public function deleteArticle($idArticle){
        $unArticle = new Article();
        $unArticle->deleteArticle($idArticle);
        return redirect('/listeArticleAdmin');
    }
    
    /* Créer l'appel de récupération des données d'un article
     * et les renvoies au formulaire de modification d'un article. 
     */
    public function modifierArticle($idArticle){
        $unArticle = new Article();
        $mesArticles = $unArticle->modifierArticle($idArticle);
        return view('/Article/formModifierArticle', compact('mesArticles'));
    }
    
    /* 
     * Créer l'appel de l'envoie des données d'un article à la BDD. 
     */
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
