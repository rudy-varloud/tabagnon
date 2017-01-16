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
                ->where('statut', '=', true)
                ->get();
        return $images;
    }

    public function getImagesCarouselFalse() {
        $images = DB::table('carousel')->Select('image')
                ->where('statut', '=', false)
                ->get();
        return $images;
    }

    public function ajouterCarouselImage($imageCarousel) {
        DB::table('carousel')
                ->insert(
                        ['image' => $imageCarousel, 'statut' => false]);
    }

    public function carouselSupprimer($image) {
        DB::table('carousel')->where('image', '=', $image)
                ->delete();
        \File::delete('../../public/assets/image/' . $image);
    }

    public function carouselRetirer($image) {
        DB::table('carousel')->where('image', '=', $image)
                ->update(['statut' => false]);
    }

    public function carouselAjouter($image) {
        DB::table('carousel')->where('image', '=', $image)
                ->update(['statut' => true]);
    }

    public function getCompteurImage() {
        $cpt = DB::table('carousel')->count();
        return $cpt + 1;
    }

}
