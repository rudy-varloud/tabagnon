<?php

namespace App\Http\Controllers;

use App\metier\Mosaique;
use App\metier\Like_image;
use Request;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Facades\Input;

class MosaiqueController extends Controller {

    public function listePhoto() {
        $uneMosaique = new Mosaique();
        $mesMosaiques = $uneMosaique->listeMosaique();
        return view('/Mosaique/pageMosaique', compact('mesMosaiques'));
    }

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

    public function postAjoutCommentaire() {
        $idImage = Request::input('idImg');
        $date = Request::input('date');
        $idVis = Request::input('idVis');
        $commentaire = Request::input('commentaire');
        $uneMosaique = new Mosaique();
        $uneMosaique->postAjoutCommentaire($idImage, $date, $idVis, $commentaire);
        return redirect('/getImage/' . $idImage);
    }

    public function deleteImage($idImage) {
        $uneMosaique = new Mosaique();
        $uneMosaique->deleteImage($idImage);
        $uneMosaique->deleteCom($idImage);
        return redirect('/getMosaique');
    }

    public function deleteCom($idCommentaire) {
        $uneMosaique = new Mosaique();
        $uneMosaique->deleteComSpe($idCommentaire);
        return redirect('/getMosaique');
    }

    public function ValidMosa() {
        $uneMosaique = new Mosaique();
        $mesMosaiques = $uneMosaique->ValidMosa();
        return view('/Mosaique/pageImageMosaAttente', compact('mesMosaiques'));
    }

    public function validerImage($idImage) {
        $uneMosaique = new Mosaique();
        $uneMosaique->validerImage($idImage);
        return redirect('/getPageValidMosa');
    }

    public function refuserImage($idImage) {
        $uneMosaique = new Mosaique();
        $image = $uneMosaique->getImage($idImage);
        $uneMosaique->deleteImage($image->nomImage);      
        return redirect('/getPageValidMosa');
    }

}
