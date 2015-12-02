<?php
require_once 'dbFunctions.php';

//Si le bouton de login est cliqué
if (isset($_POST["login"])) 
{
    //Si les champ pseudo et mdp sont set...
    if (isset($pseudoConnection) && isset($mdpConnection)) 
    {
        //...On teste si ces identifiants existent
        $result = IdentifiantDisponible($pseudoConnection, $mdpConnection);
        //Si c'est le cas on se connecte
        if ($result != NULL) {
    		//... et est redirigé sur le site
		session_start();
    		$_SESSION['login'] = $pseudoConnection;
    		header('Location: ../index.php');
    		exit();
    	}
    	// si on ne trouve aucune réponse, soit le pseudo, soit le mot de passe est faux
    	else
        {
            $erreur = 'Erreur dans le login ou le mot de passe.';
        }
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>m151admin_sl</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css" type="text/css">
    </head>
    <body>
        <div id="content">
            <fieldset>
                <legend>Login</legend>
                <form action="#" method="post">
                    <label for="Pseudo" class="labelSize">Pseudo :</label>
                    <input id="Pseudo" name="pseudoConnection" type="text" class="InputFormulaire" required><br/>
                    <label for="mdp" class="labelSize">Mot de passe :</label>
                    <input id="mdp" name="mdpConnection" type="password" class="InputFormulaire" required><br/>

                    <input type="submit" value="Envoyer" name="login">
                </form>
            </fieldset>
        </div>
    </body>
</html>