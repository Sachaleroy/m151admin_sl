
<!DOCTYPE html>
<?php

require_once './php/dbfunctions.php';
connexionBase();
?>
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
                <label for="nom" class="labelSize">Nom :</label>
                <input id="nom" type="text" class="InputFormulaire"><br/>

                <label for="prenom" class="labelSize">Prénom :</label>
                <input id="prenom" type="text" class="InputFormulaire"><br/>

                <label for="dateNaissance" class="labelSize">Date de naissance :</label>
                <input id="dateNaissance" type="date" class="InputFormulaire"><br/>

                <label for="description" class="labelSize">Mini description :</label>
                <textarea id="description" class="InputFormulaire"></textarea><br/>

                <label for="email" class="labelSize">Email :</label>
                <input id="email" type="email" class="InputFormulaire"><br/>

                <label for="pseudo" class="labelSize">Pseudo :</label>
                <input id="pseudo" type="text" class="InputFormulaire"><br/>

                <label for="mdp" class="labelSize">Mot de passe :</label>
                <input id="mdp" type="password" class="InputFormulaire"><br/>

                <input type="submit" value="Envoyer" name="submit" >
                <input type="reset" value="Réinitialiser">
            </form>
        </div>
    </body>
</html>