<?php

namespace App\Http\Controllers;

use App\metier\Carousel;
use Request;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Facades\Input;

class CarouselController extends Controller {

    /* 
     * Créer l'appel de récupération des données du carousel
     */
    public function majCarousel() {
        $Carousel = new Carousel();
        $lesImagesTrue = $Carousel->getImagesCarouselTrue();
        $lesImagesFalse = $Carousel->getImagesCarouselFalse();
        return view('pageCarousel', compact('lesImagesTrue', 'lesImagesFalse'));
    }

    /* 
     * Créer l'appel pour retirer une image du carousel (que l'on voit)
     */
    public function retirerCarousel($image) {
        $Carousel = new Carousel();
        $Carousel->carouselRetirer($image);
        return redirect('/carouselAccueil');
    }

    /* 
     * Créer l'appel pour supprimer une image du carousel
     */
    public function supprimerCarousel($image) {
        $Carousel = new Carousel();
        $Carousel->carouselSupprimer($image);        
        return redirect('/carouselAccueil');
    }

    /* 
     * Créer l'appel pour ajouter une image au carousel (que l'on voit)
     */
    public function ajouterCarousel($image) {
        $Carousel = new Carousel();
        $Carousel->carouselAjouter($image);
        return redirect('/carouselAccueil');
    }

    /* 
     * Créer l'appel pour ajouter une image au carousel :
     * Edite le nom de l'image et la place dans un dossier spécifié.
     */
    public function ajoutImageCarousel() {
        $Carousel = new Carousel();
        if (Request::file('imageCarousel') != null) {
            if (Request::file('imageCarousel')->isValid()) {
                $image = Request::file('imageCarousel');
                $ext = substr(strrchr($image->getClientOriginalName(), "."), 1);
                $imageCarousel = 'imageC' . mt_rand() . mt_rand() . "." . $ext;
                $image->move(public_path("/assets/image/carousel/"), $imageCarousel);
                $Carousel->ajouterCarouselImage($imageCarousel);
            } else {
                $message = "L'image n'est pas valide (elle ne doit pas dépasser 15 Méga octets (Mo) )";
            }
        } else {
            $message = 'Veuillez choisir un fichier';
        }
        
        $lesImagesTrue = $Carousel->getImagesCarouselTrue();
        $lesImagesFalse = $Carousel->getImagesCarouselFalse();
        return view('pageCarousel', compact('lesImagesTrue', 'lesImagesFalse', 'message'));
    }

}
