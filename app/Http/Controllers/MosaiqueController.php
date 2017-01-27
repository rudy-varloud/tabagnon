<?php

namespace App\Http\Controllers;

use App\metier\Mosaique;
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
                $uneMosaique->postFormArticleImage($nomImage, $description, $date, $idVis);
        return redirect('/getMosaique');
    }
}
            

