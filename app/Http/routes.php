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

// ----- PRODUIT -----

// Modification Produit
Route::get('/modifierProduit/{id_vet}', ['as' => 'modifierProduit',
    'uses' => 'ProduitController@modifierProduit']);
// Validation modification Produit
Route::post('/postModifUser/{id_cli}', ['as' => 'postModifUser',
    'uses' => 'VisiteurController@postModifUser']);
// Route valide modification d'un produit
Route::post('/postmodifierProduit/{id_vet}', ['as' => 'postmodifierProduit',
    'uses' => 'ProduitController@postmodifierProduit']);
//Lister tout les produit dispo dans la boutique
Route::get('/listerProduit', 'ProduitController@getListeProduit');
//Lister les produits relatifs à homme/femme/enfant
Route::get('/listerProduitHomme', 'ProduitController@getListeProduitHomme');
Route::get('/listerProduitFemme', 'ProduitController@getListeProduitFemme');
Route::get('/listerProduitEnfant', 'ProduitController@getListeProduitEnfant');
// Permet de lister les produits par marque
Route::get('/listerProduitMarque', 'ProduitController@ListerMarque');
//Ajouter un produit
Route::get('/ajouterProduit', 'ProduitController@ajoutProduit');
//Validation de l'ajout d'un produit
Route::post('/ajoutProduit', ['as' => 'postajouterProduit',
    'uses' => 'ProduitController@postajouterProduit']);
Route::get('/ajoutMarque', 'ProduitController@ajoutMarque');
Route::post('/postAjoutMarque', 'ProduitController@postAjoutMarque');

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
Route::get('/creerCompte', function (){
    return view('formCreateAccount');    
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


