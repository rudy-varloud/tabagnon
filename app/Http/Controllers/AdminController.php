<?php

namespace App\Http\Controllers;

use App\metier\Carousel;
use Request;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller{
    public function majCarousel(){
        $Carousel = new Carousel();
        $lesImagesTrue = $Carousel->getImagesCarouselTrue();
        $lesImagesFalse = $Carousel->getImagesCarouselFalse();
        return view('pageCarousel',compact('lesImagesTrue','lesImagesFalse'));
    }
}
