<?php
require_once "./php/dbFunctions.php";
$nom;
$prenom;
$dateNaissance;
$description;
$email;
$pseudo;
$modif = "";
$required = "required";
if(isset($_GET["modif"])){
    $donneesUtilisateur = donneesFormulaireModif($_GET["modif"]);
    $nom = $donneesUtilisateur[0]["nom"];
    $prenom = $donneesUtilisateur[0]["prenom"];
    $dateNaissance = $donneesUtilisateur[0]["dateNaissance"];
    $description = $donneesUtilisateur[0]["description"];
    $email = $donneesUtilisateur[0]["email"];
    $pseudo = $donneesUtilisateur[0]["pseudo"];
    $modif = "Modif";
    $required = '';
}
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
                <label for="nom" class="labelSize">Nom :</label>
                <input id="nom" name="nom" type="text" class="InputFormulaire" value="<?php echo $nom ?>" required><br/>

                <label for="prenom" class="labelSize">Prénom :</label>
                <input id="prenom" name="prenom" type="text" class="InputFormulaire" value="<?php echo $prenom ?>" required><br/>

                <label for="dateNaissance" class="labelSize">Date de naissance :</label>
                <input id="dateNaissance" name="dateNaissance" type="date" class="InputFormulaire" value="<?php echo $dateNaissance ?>" required><br/>

                <label for="description" class="labelSize">Mini description :</label>
                <textarea id="description" name="description" class="InputFormulaire" required><?php echo $description ?></textarea><br/>

                <label for="email" class="labelSize">Email :</label>
                <input id="email" name="email" type="email" class="InputFormulaire" value="<?php echo $email ?>" required><br/>

                <label for="pseudo" class="labelSize">Pseudo :</label>
                <input id="pseudo" name="pseudo" type="text" class="InputFormulaire" value="<?php echo $pseudo ?>" required><br/>

                <label for="mdp" class="labelSize">Mot de passe :</label>
                <input id="mdp" name="mdp" type="password" class="InputFormulaire" <?php echo $required ?>><br/>

                <input type="submit" value="Envoyer <?php echo $modif ?>" name="submit<?php echo $modif ?>" >
                <input type="reset" value="Réinitialiser">
                <a href="php/utilisateurs.php">liste d'utilisateurs</a>
            </form>
        </div>
    </body>
</html>