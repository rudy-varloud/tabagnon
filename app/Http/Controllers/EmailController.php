<?php

namespace App\Http\Controllers;

use App\metier\Modele;
use App\metier\Visiteur;
use App\metier\LignComm;
use App\metier\Commande;
use Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class EmailController extends Controller {

    public function sendMailWelcome($user_email, $user_name) { //fonction pour le mail de bienvenue lors de l'inscription
        $title = "Welcome";
        $content = "je suis le contenu du mail";



        $data = ['email' => $user_email, 'name' => $user_name, 'subject' => $title, 'content' => $content]; // ici ce sont les données qui sont transmis dans le view utilisé lors de l'envoi du mail
        Mail::send('mail', $data, function($message) use($data) { //fonction send qui va envoyer la view " mail "
            $subject = $data['subject'];
            $message->from('projettabagnon@gmail.com');  //Adresse email de l'emetteur de l'email
            $message->to($data['email'], $data['email'])->subject($subject); //ici on definit l'adresse à laquelle on envoie le mail
        });


        return redirect('/');
    }


    public function envoiMdp() { //fonction qui concerne l'envoie de mail lors d'une demande de "mot de passe oublié"
        $login = Request::input('login');
        $mail = Request::input('email'); //ici on recupere le login et l'email passé par méthode post
        $unVisiteur = new Visiteur();
        $connected = $unVisiteur->getVisiteurExistance($login, $mail); // on verifie s'il y a bien un client avec cet email et de login dans la bdd


        if ($connected) {   //s'il existe bien un client, on envoi l'email et on est redirigé vers la view formLogin avec un message de confirmation
            $mdp = $unVisiteur->getMdpVisiteur($login, $mail);
            $title = "Nouveau mot de passe";
            $content = "je suis le contenu du mail";
            $erreur = "Le mot de passe vous a été envoyé à l'adresse $mail";


            $data = ['email' => $mail, 'mdp' => $mdp, 'subject' => $title, 'content' => $content];
            Mail::send('mailMdp', $data, function($message) use($data) {

                $subject = $data['subject'];
                $message->from('projettabagnon@gmail.com');
                $message->to($data['email'], $data['email'])->subject($subject);
            });

            return view('formLogin', compact('erreur'));
        } else {  //s'il n'existe pas, renvoi sur la viewformMdpOublie avec un message qui informe que le login ou l'email est incorrect.
            $erreur = "Login ou email incorrect";
            return view('formMdpOublie', compact('erreur'));
        }
    }

}
