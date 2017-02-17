<!--Page qui permet la création du corps d'un email envoyé lors de la perte du mot de passe d'un client-->
<!doctype html>
<html lang="fr">
    <body class="body">
        <div class="brand">
            <a href="{{url('/accueil')}}"><img src="<?php echo $message->embed(URL::asset('assets/image/logoTabagnon.png')); ?>" alt="Logo Tabagnon" height="30" width="25"></a>
            Le Tabagnon | <small>Saint-Genis-les-Ollières</small>
        </div>
        <br><br>
        <strong>Bonjour,</strong>
        <br><br>
        <em>Suite à votre demande, voici votre mot de passe : <strong>{{ $mdp }}</strong> </em>
        <br><br>
        <em>Bonne journée.</em>
    </body>
    <footer>
        <hr />
        <address> Les membres de l'association Le Tabagnon  </address>
    </footer>
</html>

