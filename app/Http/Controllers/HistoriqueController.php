<?php

namespace App\Http\Controllers;

use App\metier\Avis_visite;
use App\metier\Visite;
use App\metier\Ligne_visite;
use App\metier\Date_visite;
use App\metier\Conference;
use Request;
use DateTime;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Facades\Input;

class HistoriqueController extends Controller {
    
    public function monHistorique($idVis){
        $uneConference = new Conference();
        $mesConferences = $uneConference->getConfUserEffec($idVis);
        $uneVisite = new Visite();
        $mesVisites = $uneVisite->getVisiteUserEffec($idVis);
        return view('historique', compact('mesConferences', 'mesVisites'));
    }
    
    public function avisVisite(){
        $note = Request::input('note');
        $avis = Request::input('avis');
        $idVisite = Request::input('idVisite');
        $dateVisite = Request::input('dateVisite');
        $idVisiteur = Session::get('id');
        $avisVisite = new Avis_visite();
        $existance = $avisVisite->checkAvis($idVisite,$idVisiteur,$dateVisite);
        if ($existance){
            $avisVisite->updateAvis($idVisite,$idVisiteur,$dateVisite,$note,$avis);
        }
        else{
            $avisVisite->addAvis($idVisite,$idVisiteur,$dateVisite,$note,$avis);
        }
        return redirect('/monHistorique'.$idVisiteur)  ;  
    }

}
