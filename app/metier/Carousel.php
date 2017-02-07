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
        'date'
    ];

    /* 
     * Dialogue avec la BDD pour récupérer les images visibles du carousel
     */
    public function getImagesCarouselTrue() {
        $images = DB::table('carousel')->Select('image')
                ->where('statut', '=', true)
                ->orderBy('date','ASC')
                ->get();
        return $images;
    }

    /* 
     * Dialogue avec la BDD pour récupérer les images non visibles du carousel
     */
    public function getImagesCarouselFalse() {
        $images = DB::table('carousel')->Select('image')
                ->where('statut', '=', false)
                ->get();
        return $images;
    }

    /* 
     * Dialogue avec la BDD pour ajouter une image au carousel
     */
    public function ajouterCarouselImage($imageCarousel) {
        $dateJour = date('Y/m/d  H:i:s', time());
        DB::table('carousel')
                ->insert(
                        ['image' => $imageCarousel, 'statut' => false, 'date' => $dateJour]);
    }

    /* 
     * Dialogue avec la BDD pour supprimer une image du carousel
     */
    public function carouselSupprimer($image) {
        DB::table('carousel')->where('image', '=', $image)
                ->delete();
        \File::delete(public_path()."/assets/image/carousel/".$image);
    }

    /* 
     * Dialogue avec la BDD pour retirer une image au carousel (visible->non visible)
     */
    public function carouselRetirer($image) {        
        DB::table('carousel')->where('image', '=', $image)
                ->update(['statut' => false]);
    }

    /* 
     * Dialogue avec la BDD pour ajouter une image au carousel (non visible->visible)
     */
    public function carouselAjouter($image) {
        $dateJour = date('Y/m/d  H:i:s', time());
        DB::table('carousel')->where('image', '=', $image)
                ->update(['statut' => true, 'date' => $dateJour]);
    }

    /* 
     * Dialogue avec la BDD pour récuperer le nombre d'image dans le carousel
     */
    public function getCompteurImage() {
        $cpt = DB::table('carousel')->count();
        return $cpt + 1;
    }

}
