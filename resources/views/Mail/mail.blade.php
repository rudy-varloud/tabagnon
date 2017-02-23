<!--Page qui permet la création du corps d'un email envoyé lors de l'inscription d'une personne au site-->
<!doctype html>
<html lang="fr">
    <body class="body">
        <div class="brand">
            <a href="{{url('/accueil')}}"><img src="<?php echo $message->embed(URL::asset('assets/image/logoTabagnon.png')); ?>" alt="Logo Tabagnon" height="30" width="25"></a>
            Le Tabagnon | <small>Saint-Genis-les-Ollières</small>
        </div>
        <br><br>
        <strong>Bonjour {{ $name }},</strong>
        <br><br>
        <em>Merci de vous être inscrit(e) sur le site de l'association du Tabagnon !</em>
        <br><br>
        <p>Vos identifiants sont les suivants :
        <ul>
            <li>Identifiant : {{$login}}</li>
            <li>Mot de passe : {{$mdp}}</li>
        </ul>
        Pensez à bien les garder !
    </p>
    <em>Bonne journée.</em>
</body>
<footer>
    <hr />
    <address> Les membres de l'association Le Tabagnon. </address>
    <small>Merci de ne pas répondre à cet adresse email. Pour toutes informations supplémentaires, contactez nous à cette adresse : tabagnon.stgenis@laposte.net</small>
</footer>
</html>