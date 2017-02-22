<?php

namespace App\Http\Controllers;

use App\metier\Reunion;
use Request;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Facades\Input;

class ReunionController extends Controller {

    public function ajoutReunion() {
        return view('/Reunion/formAjoutReunion');
    }

    public function postAjoutReunion() {
        $type = Request::input('select_type');
        $adresseReunion = Request::input('adresseReunion');
        $cpReunion = Request::input('cpReunion');
        $date = Request::input('date');
        $heure = Request::input('heure');
        $uneReunion = new Reunion();
        $uneReunion->postAjoutReunion($type, $adresseReunion, $cpReunion, $date, $heure);
        return view('/pageAdmin');
    }

    public function getReunion() {
        $uneReunion = new Reunion();
        $mesReunions = $uneReunion->getReunion();
        return view('/Reunion/listeReunion', compact('mesReunions'));
    }

    public function supprReunion($idReunion) {
        $uneReunion = new Reunion();
        $uneReunion->supprReunion($idReunion);
        return redirect('/listeReunion');
    }

    public function ajoutCr($idReunion) {
        $uneReunion = new Reunion();
        $mesReunions = $uneReunion->ajoutCr($idReunion);
        return view('/Reunion/ajoutCompteRendu', compact('mesReunions'));
    }

    public function postAjoutCr() {
        $idReunion = Request::input('idReunion');
        $dlCompteRendu = Input::file('dlCompteRendu');
        $contenuReunion = Request::input('contenu');
        $uneReunion = new Reunion();
            $nomCompteRendu = $dlCompteRendu->getClientOriginalName();
            $dlCompteRendu->move(public_path("/assets/documents/CompteRendu"), $nomCompteRendu);
            $uneReunion->postAjoutCr($idReunion, $nomCompteRendu, $contenuReunion);
        return redirect('listeReunion');
    }
    
    public function getCompteRendu($idReunion){
        $uneReunion = new Reunion();
        $mesReunions = $uneReunion->getCompteRendu($idReunion);
        return view('/Reunion/afficherCompteRendu', compact('mesReunions'));
    }

}
