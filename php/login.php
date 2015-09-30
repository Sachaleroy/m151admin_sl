<?php

?>
<!DOCTYPE html>
<html>
    <head>
        <title>m151admin_sl</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/style.css" type="text/css">
    </head>
    <body>
        <div id="content">
            <form action="./php/dbFunctions.php" method="post">
                <label for="Pseudo" class="labelSize">Pseudo :</label>
                <input id="Pseudo" name="pseudoConnection" type="text" class="InputFormulaire" required><br/>
                <label for="mdp" class="labelSize">Mot de passe :</label>
                <input id="mdp" name="mdpConnection" type="password" class="InputFormulaire" required><br/>
                
                <input type="submit" value="Envoyer" name="login">
            </form>
        </div>
    </body>
</html>