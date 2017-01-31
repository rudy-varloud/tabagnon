<?php

namespace App\Http\Controllers;

use App\metier\Like_image;
use Request;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Facades\Input;

class LikeController extends Controller {

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
