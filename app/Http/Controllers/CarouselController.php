<?php

namespace App\Http\Controllers;

use App\metier\Carousel;
use Request;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Facades\Input;

class CarouselController extends Controller {

    public function majCarousel() {
        $Carousel = new Carousel();
        $lesImagesTrue = $Carousel->getImagesCarouselTrue();
        $lesImagesFalse = $Carousel->getImagesCarouselFalse();
        return view('pageCarousel', compact('lesImagesTrue', 'lesImagesFalse'));
    }

    public function retirerCarousel($image) {
        $Carousel = new Carousel();
        $Carousel->carouselRetirer($image);
        return redirect('/carouselAccueil');
    }

    public function supprimerCarousel($image) {
        $Carousel = new Carousel();
        $Carousel->carouselSupprimer($image);        
        return redirect('/carouselAccueil');
    }

    public function ajouterCarousel($image) {
        $Carousel = new Carousel();
        $Carousel->carouselAjouter($image);
        return redirect('/carouselAccueil');
    }

    public function ajoutImageCarousel() {
        $Carousel = new Carousel();
        if (Request::file('imageCarousel') != null) {
            if (Request::file('imageCarousel')->isValid()) {
                $image = Request::file('imageCarousel');
                $imageCarousel = $image->getClientOriginalName();
                $image->move(public_path("/assets/image/"), $imageCarousel);
                $Carousel->carouselAdd($imageCarousel);
            } else {
                $message = "L'image n'est pas valide (elle ne doit pas dépasser 200ko)";
            }
        } else {
            $message = 'Veuillez choisir un fichier';
        }
        
        $lesImagesTrue = $Carousel->getImagesCarouselTrue();
        $lesImagesFalse = $Carousel->getImagesCarouselFalse();
        return view('pageCarousel', compact('lesImagesTrue', 'lesImagesFalse', 'message'));
    }

}
