<?php

namespace App\Http\Controllers;

use App\metier\Mosaique;
use App\metier\Like_image;
use Request;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Facades\Input;

class MosaiqueController extends Controller {

    /* 
     * Créer l'appel pour récupèrer les données de la mosaïque
     */
    public function listePhoto() {
        $uneMosaique = new Mosaique();
        $mesMosaiques = $uneMosaique->listeMosaique();
        $message = '';
        return view('/Mosaique/pageMosaique', compact('mesMosaiques','message'));
    }

    /* 
     * Créer l'appel pour récupèrer les données du formulaire d'ajout d'image
     * dans la mosaïque :
     * Edite le nom de l'image et la place dans le dossier spécifié
     */
    public function postPhotoMosaique() {
        $visibilite = 1;
        $image = Request::file('imageMosaique');
        $description = Request::input('descriptionImage');
        $date = Request::input('date');
        $idVis = Session::get('id');
        $uneMosaique = new Mosaique();
        if (Request::file('imageMosaique') != null) {
            if (Request::file('imageMosaique')->isValid()) {
                $image = Request::file('imageMosaique');
                $ext = substr(strrchr($image->getClientOriginalName(), "."), 1);
                $imageMosaique = 'imageM' . mt_rand() . mt_rand() . "." . $ext;
                $image->move(public_path("/assets/image/mosaique/"), $imageMosaique);
                if(Session::get('ncpt') == 4){
                    $visibilite = 2;
                    $message = "L'image a bien été ajoutée.";
                }
                else{
                    $message = "L'image a bien été ajoutée et va être vérifiée par un administrateur avant d'être visible sur le site web.";
                }
                $uneMosaique->postFormMosaiqueImage($imageMosaique, $description, $date, $idVis,$visibilite);
            } else {
                $message = "L'image n'est pas valide (elle ne doit pas dépasser 15 Méga octets (Mo) )";
            }
        } else {
            $message = 'Veuillez choisir un fichier';
        }      
        $mesMosaiques = $uneMosaique->listeMosaique();
        return view('/Mosaique/pageMosaique', compact('mesMosaiques','message'));
    }

    /* 
     * Créer l'appel pour récupèrer les images ainsi que les commentaires
     * de la mosaïque
     */
    public function getImage($idImage) {
        $uneMosaique = new Mosaique();
        $mesMosaiques = $uneMosaique->getImage($idImage);
        $uneMosaique2 = new Mosaique();
        $mesMosaiques2 = $uneMosaique2->getCommentaireImage($idImage);
        $LikeImage = new Like_image();
        $compteur = $LikeImage->countLike($idImage);
        $idVis = Session::get('id');
        $statut = $LikeImage->checkLike($idVis, $idImage);
        $message= "";
        return view('/Mosaique/pageImageMosaiqueSpe', compact('mesMosaiques', 'mesMosaiques2', 'idImage', 'compteur', 'statut', 'message'));
    }

    /* 
     * Récupère les données du formulaire d'ajout de commentaire
     * et créer l'appel pour ajouter le commentaire
     */
    public function postAjoutCommentaire() {
        $idImage = Request::input('idImg');
        $date = Request::input('date');
        $idVis = Request::input('idVis');
        $commentaire = Request::input('commentaire');
        $uneMosaique = new Mosaique();
        $uneMosaique2 = new Mosaique();
        $uneMosaique->postAjoutCommentaire($idImage, $date, $idVis, $commentaire);
        $mesMosaiques = $uneMosaique->getImage($idImage);
        $mesMosaiques2 = $uneMosaique2->getCommentaireImage($idImage);
        $LikeImage = new Like_image();
        $compteur = $LikeImage->countLike($idImage);
        $statut = $LikeImage->checkLike($idVis, $idImage);
        $message = "Le commentaire a bien été ajouté.";
        return view('/Mosaique/pageImageMosaiqueSpe', compact('mesMosaiques', 'mesMosaiques2', 'idImage', 'compteur', 'statut','message'));
    }

    /* 
     * Créer l'appel pour supprimer une image de la mosaïque
     */
    public function deleteImage($idImage) {
        $uneMosaique = new Mosaique();
        $image = $uneMosaique->getImage($idImage);
        $uneMosaique->deleteImage($idImage,$image->nomImage);
        $uneMosaique->deleteCom($idImage);
        $uneMosaique->deleteLike($idImage);
        $mesMosaiques = $uneMosaique->listeMosaique();
        $message = "L'image a bien été supprimée.";
        return view('/Mosaique/pageMosaique', compact('mesMosaiques','message'));
    }

    /* 
     * Créer l'appel pour supprimer un commentaire de la mosaïque
     */
    public function deleteCom($idCommentaire,$idImage) {
        $uneMosaique = new Mosaique();
        $uneMosaique2 = new Mosaique();
        $uneMosaique->deleteComSpe($idCommentaire);
        $mesMosaiques = $uneMosaique->getImage($idImage);
        $mesMosaiques2 = $uneMosaique2->getCommentaireImage($idImage);
        $LikeImage = new Like_image();
        $compteur = $LikeImage->countLike($idImage);
        $idVis = Session::get('id');
        $statut = $LikeImage->checkLike($idVis, $idImage);
        $message = "Le commentaire a bien été supprimé.";
        return view('/Mosaique/pageImageMosaiqueSpe', compact('mesMosaiques', 'mesMosaiques2', 'idImage', 'compteur', 'statut','message'));
    }

    /* 
     * Créer l'appel pour récupérer les images de la mosaïque en attente
     */
    public function ValidMosa() {
        $uneMosaique = new Mosaique();
        $mesMosaiques = $uneMosaique->getAttenteMosa();
        $message = "";
        return view('/Mosaique/pageImageMosaAttente', compact('mesMosaiques','message'));
    }
    

    /* 
     * Créer l'appel pour valider une image de la mosaïque en attente
     */
    public function validerImage($id) {
        $uneMosaique = new Mosaique();
        $uneMosaique->validerImage($id);
        $mesMosaiques = $uneMosaique->getAttenteMosa();
        $message = "L'image a bien été validée.";
        return view('/Mosaique/pageImageMosaAttente', compact('mesMosaiques','message'));
    }

    /* 
     * Créer l'appel pour refuser (supprimer) une image de la mosaïque en attente
     */
    public function refuserImage($idImage) {
        $uneMosaique = new Mosaique();
        $image = $uneMosaique->getImage($idImage);
        $uneMosaique->deleteImage($idImage,$image->nomImage);      
        $mesMosaiques = $uneMosaique->getAttenteMosa();
        $message = "L'image a bien été supprimée.";
        return view('/Mosaique/pageImageMosaAttente', compact('mesMosaiques','message'));
    }

}