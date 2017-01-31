<?php

namespace App\Http\Controllers;

use App\metier\Mosaique;
use App\metier\Like_image;
use Request;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Facades\Input;

class MosaiqueController extends Controller {
    
    public function listePhoto(){
        $uneMosaique = new Mosaique();
        $mesMosaiques = $uneMosaique->listeMosaique();
        return view('pageMosaique', compact('mesMosaiques'));
    }
    
    public function postPhotoMosaique(){
                $image = Request::file('imageMosaique');
                $description = Request::input('descriptionImage');
                $date = Request::input('date');
                $idVis = Session::get('id');
                $nomImage=$image->getClientOriginalName();
                $uneMosaique = new Mosaique();
                $image->move(public_path("/assets/image/mosaique/"), $nomImage);
                $uneMosaique->postFormMosaiqueImage($nomImage, $description, $date, $idVis);
        return redirect('/getMosaique');
    }
    
    public function getImage($idImage){
        $uneMosaique = new Mosaique();
        $mesMosaiques = $uneMosaique->getImage($idImage);
        $uneMosaique2 = new Mosaique();
        $mesMosaiques2 = $uneMosaique2->getCommentaireImage($idImage);
        $LikeImage = new Like_image();
        $compteur = $LikeImage->countLike($idImage);
        $idVis = Session::get('id');
        $statut = $LikeImage->checkLike($idVis,$idImage);
        return view('pageImageMosaiqueSpe', compact('mesMosaiques', 'mesMosaiques2','idImage','compteur','statut'));
    }
    
    public function postAjoutCommentaire(){
        $idImage = Request::input('idImg');
        $date = Request::input('date');
        $idVis = Request::input('idVis');
        $commentaire = Request::input('commentaire');
        $uneMosaique = new Mosaique();
        $uneMosaique->postAjoutCommentaire($idImage, $date, $idVis, $commentaire);
        return redirect('/getImage/'.$idImage);
    }
    
    public function deleteImage($idImage){
        $uneMosaique = new Mosaique();
        $mesMosaiques = $uneMosaique->deleteImage($idImage);
        $uneMosaique2 = new Mosaique();
        $mesMosaiques2 = $uneMosaique2->deleteCom($idImage);
        return redirect('/getMosaique');
    }
    
    public function deleteCom($idCommentaire){
        $uneMosaique = new Mosaique();
        $mesMosaiques = $uneMosaique->deleteComSpe($idCommentaire);
        return redirect('/getMosaique');
    }
}
            

