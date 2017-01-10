<!--View de transition après s'être inscrit.-->
@extends('layouts.master')
@section('content')
<!doctype html>
<html lang="fr">
    <body class="body">
        <div>

            <p>Merci de vous être inscrit sur notre site. Vous allez être redirigé automatiquement sur la page d'accueil dans quelques secondes ... 


                <meta http-equiv="refresh" content="5;{{url('/welcomeMail')}}/{{$mail}}/{{$nom}}" />

           
        </div>
        @stop
    </body>
</html>
