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
        return view('/Mosaique/pageMosaique', compact('mesMosaiques'));
    }

    /* 
     * Créer l'appel pour récupèrer les données du formulaire d'ajout d'image
     * dans la mosaïque :
     * Edite le nom de l'image et la place dans le dossier spécifié
     */
    public function postPhotoMosaique() {
        $image = Request::file('imageMosaique');
        $description = Request::input('descriptionImage');
        $date = Request::input('date');
        $idVis = Session::get('id');
        $uneMosaique = new Mosaique();
        if (Request::file('imageMosaique') != null) {
            if (Request::file('imageMosaique')->isValid()) {
                $image = Request::file('imageMosaique');
                $ext = substr(strrchr($image->getClientOriginalName(), "."), 1);
                $imageMosaique = 'image-' . $uneMosaique->getCompteurImage() . "." . $ext;
                $image->move(public_path("/assets/image/mosaique/"), $imageMosaique);
                $uneMosaique->postFormMosaiqueImage($imageMosaique, $description, $date, $idVis);
            } else {
                $message = "L'image n'est pas valide (elle ne doit pas dépasser 2 Méga octets (Mo) )";
            }
        } else {
            $message = 'Veuillez choisir un fichier';
        }      
        return redirect('/getMosaique');
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
        return view('/Mosaique/pageImageMosaiqueSpe', compact('mesMosaiques', 'mesMosaiques2', 'idImage', 'compteur', 'statut'));
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
        $uneMosaique->postAjoutCommentaire($idImage, $date, $idVis, $commentaire);
        return redirect('/getImage/' . $idImage);
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
        return redirect('/getMosaique');
    }

    /* 
     * Créer l'appel pour supprimer un commentaire de la mosaïque
     */
    public function deleteCom($idCommentaire) {
        $uneMosaique = new Mosaique();
        $uneMosaique->deleteComSpe($idCommentaire);
        return redirect('/getMosaique');
    }

    /* 
     * Créer l'appel pour récupérer les images de la mosaïque en attente
     */
    public function ValidMosa() {
        $uneMosaique = new Mosaique();
        $mesMosaiques = $uneMosaique->getAttenteMosa();
        return view('/Mosaique/pageImageMosaAttente', compact('mesMosaiques'));
    }
    

    /* 
     * Créer l'appel pour valider une image de la mosaïque en attente
     */
    public function validerImage($id) {
        $uneMosaique = new Mosaique();
        $uneMosaique->validerImage($id);
        return redirect('/getPageValidMosa');
    }

    /* 
     * Créer l'appel pour refuser (supprimer) une image de la mosaïque en attente
     */
    public function refuserImage($idImage) {
        $uneMosaique = new Mosaique();
        $image = $uneMosaique->getImage($idImage);
        $uneMosaique->deleteImage($idImage,$image->nomImage);      
        return redirect('/getPageValidMosa');
    }

}