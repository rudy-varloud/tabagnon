<?php

namespace App\metier;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use DB;

class Carousel extends Model {

    protected $table = 'carousel';
    public $timestamps = false;
    protected $fillable = [
        'image',
        'statut',
    ];

    public function getImagesCarouselTrue() {
        $images = DB::table('carousel')->Select('image')
                ->where('statut','=',true)
                ->get();
        return $images;
    }
    
    public function getImagesCarouselFalse() {
        $images = DB::table('carousel')->Select('image')
                ->where('statut','=',false)
                ->get();
        return $images;
    }

    public function carouselAdd($image) {
        
    }

    public function carouselDel($image) {
        
    }

    public function carouselStatutTrue($image) {
        
    }

    public function carouselStatutFalse($image) {
        
    }

}
