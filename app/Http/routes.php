<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */



Route::get('/', function () {
    return view('accueil');
});
Route::get('/welcome', function(){
    return view('welcome');
});
Route::get('/home', function(){
    return view('home');
});
Route::get('/getPageAdmin', function(){
    return view('pageAdmin');
});

Route::get('/ajoutArticle', 'ArticleController@getFormArticle');
Route::post('/postFormArticle', 'ArticleController@postFormArticle');

// ----- VISITEUR -----

// Route pour acceder au formulaire de modif d'un user
Route::get('/modifUser/{id_client}', ['as' => 'modifUser',
    'uses' => 'VisiteurController@modifUser']);
//Validation des modifications faite pour un visiteur donné
Route::post('/postmodifierUser/{id_client}', ['as' => 'postmodifierUser',
    'uses' => 'VisiteurController@modificationVisiteur']);
//Afficher le formulaire d'authentification
Route::get('/getLogin', 'VisiteurController@getLogin');
//Authentification du visiteur
Route::post('/login', 'VisiteurController@connect');
//Deconnection du visiteur
Route::get('/getLogout', 'VisiteurController@signOut');
//Création d'un compte
Route::get('/inscription', function (){
    return view('formSubscribe');    
});
Route::get('/createAccount', 'VisiteurController@createAccount');
Route::post('/signIn',['as' => 'signIn',
    'uses' => 'VisiteurController@signIn']);


Route::post('/postAfficherManga/{id}', ['as' => 'postAfficherManga',
    'uses' => 'ProduitController@postAfficherMangaGenre']);

Route::get('/ajouterMangas', 'ProduitController@ajoutProduit');
Route::get('/listeUser', 'VisiteurController@listeUser');
Route::get('/deleteProduit/{id_vet}', ['as' => 'deleteProduit',
    'uses' => 'ProduitController@deleteProduit']);


