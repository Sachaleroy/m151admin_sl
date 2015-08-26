<?php

require_once './php/dbfunctions.php';
connexionBase();
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
            <form action="dbFunctions.php" method="post">
                <label class="labelSize">Nom :</label>
                <input type="text" class="InputFormulaire"><br/>

                <label class="labelSize">Prénom :</label>
                <input type="text" class="InputFormulaire"><br/>

                <label class="labelSize">Date de naissance :</label>
                <input type="date" class="InputFormulaire"><br/>

                <label for="description" class="labelSize">Mini description :</label>
                <textarea id="description" class="InputFormulaire"></textarea><br/>

                <label class="labelSize">Email :</label>
                <input type="email" class="InputFormulaire"><br/>

                <label class="labelSize">Pseudo :</label>
                <input type="text" class="InputFormulaire"><br/>

                <label class="labelSize">Mot de passe :</label>
                <input type="password" class="InputFormulaire"><br/>

                <input type="submit" value="Envoyer" name="submit" >
                <input type="reset" value="Réinitialiser">
            </form>
        </div>
    </body>
</html>