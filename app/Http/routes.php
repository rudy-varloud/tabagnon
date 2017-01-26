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


//Routes pour la connexion utilisateur
Route::get('/getLogin', 'VisiteurController@getLogin');
Route::post('/login', 'VisiteurController@connect');
Route::get('/getLogout', 'VisiteurController@signOut');
Route::post('/signIn', ['as' => 'signIn',
    'uses' => 'VisiteurController@signIn']);
Route::get('/getSubscribe', 'VisiteurController@getsubscribe');
Route::post('/subscribe', 'VisiteurController@SubscribeIn');
Route::post('/subscribeGuideTemp', 'VisiteurController@subGuideTemp');
Route::get('/getProfil', 'VisiteurController@getProfil');
Route::post('/postmodificationProfil', 'VisiteurController@postModifierProfil');
Route::get('/modifierProfil', 'VisiteurController@modifierProfil');
Route::get('/mesReservations/{id}', 'VisiteController@mesReservations');

//Visite
Route::post('/ajoutVisite', 'VisiteController@ajoutVisite');
Route::get('/listerVisiteur', 'VisiteurController@listeUser');
Route::post('/postFormVisite', 'VisiteController@postFormVisite');
Route::get('/getPageVisite', 'VisiteController@pageVisite');
Route::get('/getVisiteSpe/{idVisite}', 'VisiteController@pageVisiteSpe');
Route::post('/listeUserSpe', 'VisiteurController@listeUserSpe');
Route::get('/getReservationVis/{idVisite}', 'VisiteController@getVisiteReservation');
Route::post('/getReservations', 'VisiteController@getReservation');
Route::post('/reservationPlace', 'VisiteController@reservationPlace');
Route::post('/postReservationPlace', 'VisiteController@postReservationPlace');


//Article
Route::get('/accueil', 'ArticleController@getLastDonnees');
Route::get('/getArticles', 'ArticleController@listerArticle');
Route::get('/article/{idArticle}', 'ArticleController@getArticle');
Route::get('/ajoutArticle', 'ArticleController@getFormArticle');
Route::post('/postFormArticle', 'ArticleController@postFormArticle');
Route::post('/postFormModifArticle', 'ArticleController@postFormModifArticle');
Route::get('/listeArticleAdmin', 'ArticleController@listeArticleAdmin');
Route::get('/deleteArticle/{idArticle}', 'ArticleController@deleteArticle');
Route::get('/modifierArticle/{idArticle}', 'ArticleController@modifierArticle');


//Conférence
Route::get('/ajoutConference', function(){
    return view('formAjoutConference');
});
Route::post('/postFormAjoutConf', 'ConferenceController@postFormAjoutConf');
Route::get('/getPageConference', 'ConferenceController@getConference');
Route::get('/getConfSpe/{idConf}', 'ConferenceController@getConferenceSpe');
Route::post('/postFormReserveConf', 'ConferenceController@postFromReserveConf');
Route::get('/getUserConf/{idConf}', 'ConferenceController@getUserConf');


//Admin
//Carousel
Route::get('/carouselAccueil', 'CarouselController@majCarousel');
Route::get('/retirerCarousel/{image}', 'CarouselController@retirerCarousel');
Route::get('/supprimerCarousel/{image}', 'CarouselController@supprimerCarousel');
Route::get('/ajouterCarousel/{image}', 'CarouselController@ajouterCarousel');
Route::post('/ajoutImageCarousel', 'CarouselController@ajoutImageCarousel');


//Accueil
Route::get('/', function() {
    return view('pagePresentation');
});


//Panel d'administration
Route::get('/getPageAdmin', function() {
    return view('pageAdmin');
});
Route::get('/modifUser/{idVis}', ['as' => 'modifUser',
    'uses' => 'VisiteurController@modifUser']);
Route::post('/postModifUser', 'VisiteurController@postModifUser');
Route::post('listeUserSpe', 'VisiteurController@listeUserSpe');
Route::get('getPageVisite', 'VisiteController@pageVisite');


// ----- VISITEUR -----

// Route pour acceder au formulaire de modif d'un user
Route::get('/modifUser/{id_client}', ['as' => 'modifUser',
    'uses' => 'VisiteurController@modifUser']);
//Validation des modifications faite pour un visiteur donné
Route::post('/postmodifierUser/{id_client}', ['as' => 'postmodifierUser',
    'uses' => 'VisiteurController@modificationVisiteur']);



//A classer, servira plus tard...
Route::post('/mdp', 'EmailController@envoiMdp');
Route::get('/listeUser', 'VisiteurController@listeUser');
Route::get('/welcomeMail/{mail}/{nom}', 'EmailController@sendMailWelcome');
Route::get('/mdpoublie', 'ClientController@Mdpoublie');
Route::get('/validerMail/{idCli}/{total}/{idCmde}', 'EmailController@sendRecapCommande');
