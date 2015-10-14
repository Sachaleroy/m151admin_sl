<?php
require_once 'dbFunctions.php';
//$swagg = TestLogin($pseudoConnection, $mdpConnection);
if(isset($_POST['login']))
{
    echo TestLogin($pseudoConnection, $mdpConnection);
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