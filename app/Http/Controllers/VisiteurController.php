<?php



namespace App\Http\Controllers;
use App\metier\Visiteur;
use Request;
use Illuminate\Support\Facades\Session;
use Exception;
use  Illuminate\Support\Facades\Input;

class VisiteurController extends Controller {
    
    
    public function connect(){
        $login = Request::input('login');
        $pwd = Request::input('pwd');
        $unVisiteur = new Visiteur();
        $connected = $unVisiteur->login($login, $pwd);
        if($connected){
            return view('welcome');
        }
        else{
            $erreur = "Login ou mot de passe inconnu, veuillez ressayez ou créer un compte sur SHOP DOZO !";
            return view ('formLogin', compact ('erreur'));
        }
    }
    
    public function verifDispoCompte(){
        $login = Request::input('login');
        $unVisiteur = new Visiteur;
        $desVisiteurs = $unVisiteur->verifDispo($login);
        return view('/signIn', compact ('desVisiteurs'));
    }
    
    public  function getLogin(){
        $erreur = "";
        return view('formLogin', compact('erreur'));
    }
    
    public function signOut(){
        //Création d'un objet, et appel d'une méthode pour cette objet
        $unVisteur = new Visiteur();
        $unVisteur->logout();
        return view('accueil');
    }
//    
//    
//    // Lister tout les produits que l'ont dispose sans caractéristique précise
//    public function getListeProduit(){
//        // Création d'un objet Produit avec appel d'une méthode dans la classe
//        $unProduit= new Produit();
//        $mesProduits = $unProduit->getListeProduit();
//        return view('tableauProduit', compact('mesProduits'));
//    }
//    
//    //Supprimer un produit lié à son id
//    public function deleteProduit($id_vet){
//        $unManga = new Produit();
//        $unManga->deleteProduit($id_vet);
//        return redirect('/listerProduit');
//    }
//    
//    // Liste les produits relatifs aux hommes
//    public function getListeProduitHomme(){
//        $unProduit= new Produit();
//        $mesProduits = $unProduit->getListeProduitHomme();
//        return view('tableauProduit', compact('mesProduits'));
//    }
//    
//    //Lister les produits relatif aux femmes
//    public function getListeProduitFemme(){
//        $unProduit = new Produit();
//        $mesProduits = $unProduit->getListeProduitFemme();
//        return view('tableauProduit', compact('mesProduits'));
//    }
//    
//    //Lister les produits relatif aux enfants
//    public function getListeProduitEnfant(){
//        $unProduit = new Produit();
//        $mesProduits = $unProduit->getListeProduitEnfant();
//        return view('tableauProduit', compact('mesProduits'));
//    }
//    
//    //Permet d'appeler le formulaire d'ajout produit avec les liste de type/marque disponible
//    public function ajoutProduit(){
//        $uneMarque = new Marque();
//        $mesMarques = $uneMarque->getListeGenres();
//        $unType = new Type();
//        $mesTypes = $unType->getListeScenaristes();
//        return view('formProduit', compact('mesMarques','mesTypes'));
//    }
//    
//    //Permet d'envoyer en base le formulaire d'ajout d'un produit
//    public function postajouterProduit(){
//        //Récupération d'une valeur dans un input
//        $nom_vet = Request::input('nom_vet');
//        $couleur = Request::input('couleur');
//        $taille = Request::input('taille');
//        $id_type = Request::input('id_type');
//        $id_marque = Request::input('id_marque');
//        $prix = Request::input('prix');
//        $qteStock = Request::input('qteStock');
//        $image = Input::file('couverture');
//        $unManga = new Produit();
//        if($image){
//            $nomImage=$image->getClientOriginalName();
//            $image->move(public_path("/assets/image/"),$nomImage);
//            $unManga->ajoutMangaImage($nom_vet, $couleur, $taille, $id_type, $id_marque, $prix, $qteStock, $nomImage);
//        }
//        else{
//            $unManga->ajoutManga($nom_vet, $couleur, $taille, $id_type, $id_marque, $prix, $qteStock);
//        }
//       
//        return view('home');
//    }
//    
//    //Permet d'appeler le formulaire pour modifier un produit relatif à un id de vetement
//        public function modifierProduit($id_vet){
//        $unProd = new Produit();
//        $unProduit = $unProd->getProduit($id_vet);
//        $uneMarque = new Marque();
//        $mesMarques = $uneMarque->getListeGenres();
//        $unType = new Type();
//        $mesTypes = $unType->getListeScenaristes();
//        return view('formProduitModif', compact('unProduit', 'mesMarques', 'mesTypes'));
//    }
//    
//    //Envoie en base les information du formulaire de modif d'un produit
//    public function postmodifierProduit($id = null){
//        $code = $id;
//        $nom_vet = Request::input('nom_vet');
//        $code_type = Request::input('id_type');
//        $code_marque = Request::input('id_marque');
//        $qteStock = Request::input('qteStock');
//        $prix = Request::input('prix');
//        $couleur = Request::input('couleur');
//        $taille = Request::input('taille');
//        $unProduit = new Produit();
//        $unProduit->modificationProduit($code, $nom_vet, $code_type,
//                $code_marque, $qteStock,
//                $prix, $couleur, $taille);
//        $mesProduits = $unProduit->getListeProduit();
//        return view('welcome');
//    }
//    
//    //Lister les marque disponible sur la boutique
//    public function ListerMarque(){
//        $uneMarque = new Marque();
//        $mesMarques = $uneMarque->getListeGenres();
//        return view('formProduitGenre', compact('mesMarques'));
//    }
//    
//    //Permet d'afficher les 
//    public function postAfficherMangaGenre(){
//        $code_marque = Request::input('cbGenres');
//        $lib_marque = Request::input('cbGenres');
//        $unProduit = new Produit();
//        $mesProduits = $unProduit->getListeMangaGenre($code_marque);
//        return view('pageMangaGenre', compact('mesProduits','lib_marque'));
//    }
//    
//    //Permet d'ajouter une marque dans la base
//    public function ajoutMarque(){
//        return view('/formAjoutMarque');
//    }
//    
//    //Validation des infos entrer dans le formulaire ajout marque
//    public function postAjoutMarque(){
//        $lib_marque = Request::input('nom_marque');
//        $uneMarque = new Marque();
//        $uneMarque->ajoutMarque($lib_marque); 
//        return view('welcome');
//    }
//    
//    public function postAfficherProduitGenre(){
//        $code_marque = Request::input('cbGenres');
//        $unProduit = new Produit();
//        $mesProduits = $unProduit->getListeMangaGenre($code_marque);
//        return view('pageMangaGenre', compact('mesProduits'));
//    }
//    

    
   
}
