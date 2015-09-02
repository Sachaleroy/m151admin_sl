
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
                <label for="nom" class="labelSize">Nom :</label>
                <input id="nom" name="nom" type="text" class="InputFormulaire" required><br/>

                <label for="prenom" class="labelSize">Prénom :</label>
                <input id="prenom" name="prenom" type="text" class="InputFormulaire" required><br/>

                <label for="dateNaissance" class="labelSize">Date de naissance :</label>
                <input id="dateNaissance" name="dateNaissance" type="date" class="InputFormulaire" required><br/>

                <label for="description" class="labelSize">Mini description :</label>
                <textarea id="description" name="description" class="InputFormulaire" required></textarea><br/>

                <label for="email" class="labelSize">Email :</label>
                <input id="email" name="email" type="email" class="InputFormulaire" required><br/>

                <label for="pseudo" class="labelSize">Pseudo :</label>
                <input id="pseudo" name="pseudo" type="text" class="InputFormulaire" required><br/>

                <label for="mdp" class="labelSize">Mot de passe :</label>
                <input id="mdp" name="mdp" type="password" class="InputFormulaire" required><br/>

                <input type="submit" value="Envoyer" name="submit" >
                <input type="reset" value="Réinitialiser">
            </form>
        </div>
    </body>
</html>