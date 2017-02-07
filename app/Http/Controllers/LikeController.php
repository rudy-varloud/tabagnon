<?php

namespace App\Http\Controllers;

use App\metier\Like_image;
use Request;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Facades\Input;

class LikeController extends Controller {

    /* 
     * Créer l'appel pour vérifier si le "like" existe déja pour cet utilisateur
     * et cette image puis :
     * Supprimer le like si il existe déja
     * Ajouter le like s'il n'existe pas
     */
    public function likeImage($idVis,$idImage) {
        $LikeImage = new Like_image();
        $statut = $LikeImage->checkLike($idVis,$idImage);
        if ($statut){
            $LikeImage->removeLike($idVis,$idImage);
        }
        else{
            $LikeImage->addLike($idVis,$idImage);
        }
        return redirect('/getImage/'.$idImage);
    }
    
}
