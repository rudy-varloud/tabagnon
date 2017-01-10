<?php

namespace App\Http\Controllers;
use App\metier\Article;
use Request;
use Illuminate\Support\Facades\Session;
use Exception;
use  Illuminate\Support\Facades\Input;

class ArticleController extends Controller {
    
    public function getFormArticle(){
        return view('formArticle');
    }
    
   public function postFormArticle(){
      $titreArticle = Request::input('titreArticle');
      $description = Request::input('description');
      $contenue = Request::input('contenu');
      $image = Request::file('imageArticle');
       $unArticle = new Article();
       if($image){
           $imageArticle=$image->getClientOriginalName();
           $image->move(public_path("/assets/image/"),$imageArticle);
           $unArticle->postFormArticleImage($titreArticle, $description, 
               $contenue, $imageArticle);
       }
       else{
           $unArticle->postFormArticle($titreArticle, $description, 
               $contenue);
       }
       
       return view('accueil');
   }
    
   
}