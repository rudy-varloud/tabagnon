<!--Page qui permet la création du corps d'un email envoyé lors de la perte du mot de passe d'un client-->
<!doctype html>
<html lang="fr">
    <body class="body">
        <strong>Bonjour,</strong>
        <br><br>
        <em>Suite à votre demande, voici votre mot de passe : <strong>{{ $mdp->MDP }}</strong> </em>
        <br><br>
        <em>Bonne journée.</em>
    </body>
    <footer>
        <hr />
        <address> L'équipe COPEC </address>
    </footer>
</html>

