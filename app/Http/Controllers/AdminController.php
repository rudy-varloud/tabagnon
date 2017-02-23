<?php

namespace App\Http\Controllers;

use App\metier\Carousel;
use App\metier\Article;
use App\metier\Visite;
use App\metier\Date_visite;
use App\metier\Conference;
use App\metier\Reunion;
use Request;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller {
    public function getPageAdmin(){
        $Visite = new Visite();
        $lesVisites = $Visite->getVisites();
        $message = "";
        return view('/pageAdmin', compact('lesVisites','message'));
    }
    
    public function majBdd(){
        $Visite = new Visite();
        $dateVisite = new Date_visite();
        $lesVisitesCheck = $dateVisite->getDatesVisites();
        $date = date('Y-m-d H:i:s');
        foreach($lesVisitesCheck as $uneVisite){
            if($uneVisite->datevisite < $date){
                $dateVisite->updateStatutVisite($uneVisite->idVisite, $uneVisite->datevisite);
            }
        }
        $Conference = new Conference();
        $lesConferences = $Conference->getConference();
        foreach($lesConferences as $uneConference){
            if($uneConference->dateConf < $date){
                $Conference->updateStatutConference($uneConference->idConf, $uneConference->dateConf);
            }
        }
        $Reunion = new Reunion();
        $lesReunions = $Reunion->getReunionUser();
        foreach($lesReunions as $uneReunion){
            if($uneReunion->dateReunion < $date){
                $Reunion->updateStatutReunion($uneReunion->idReunion, $uneReunion->dateReunion);
            }
        }
        $lesVisites = $Visite->getVisites();
        $message = "Les visites, conférences et réunions ont bien été mises à jour.";
        return view('/pageAdmin', compact('lesVisites','message'));
    }
}
