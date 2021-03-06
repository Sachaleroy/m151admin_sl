<?php
require_once "./php/dbFunctions.php";
include "./php/phpToHtml.php";

session_start();

$nom            = isset($REQUEST['nom'])            ? $REQUEST['nom']            : "";
$prenom         = isset($REQUEST['prenom'])         ? $REQUEST['prenom']         : "";
$dateNaissance  = isset($REQUEST['dateNaissance'])  ? $REQUEST['dateNaissance']  : "";
$description    = isset($REQUEST['description'])    ? $REQUEST['description']    : "";
$email          = isset($REQUEST['email'])          ? $REQUEST['email']          : "";
$pseudo         = isset($REQUEST['pseudo'])         ? $REQUEST['pseudo']         : "";
$modif = "";
$required = "required";
$idModif = "";
$erreur = "false";
$changerAdmin = false;
if(isset($_GET["erreur"]))
{
    $erreur = "true";
}
if(isset($_GET["modif"]))
{
    $donneesUtilisateur = donneesFormulaireModif($_GET["modif"]);
    $nom = $donneesUtilisateur[0]["nom"];
    $prenom = $donneesUtilisateur[0]["prenom"];
    $dateNaissance = $donneesUtilisateur[0]["dateNaissance"];
    $description = $donneesUtilisateur[0]["description"];
    $email = $donneesUtilisateur[0]["email"];
    $pseudo = $donneesUtilisateur[0]["pseudo"];
    $estAdmin = $donneesUtilisateur[0]["estAdmin"];
    $modif = "Modif";
    $required = '';
    $idModif = "?modif=".$_GET["modif"];
    if(estAdmin($_SESSION['login']) != "")
    {
        $changerAdmin = true;
    }
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
        <?php
        if(!isset($_SESSION['login']))
        {
            echo "<a href='./PHP/login.php' style='text-decoration: none;'>Connexion</a>";
        }
        if(isset($_SESSION['login']))
        {
            echo "Utilisateur connecté : ".$_SESSION['login']." |   <a href='./PHP/deconnexion.php' style='text-decoration: none;'>Déconnexion</a>";
        }
        ?>
        <div id="content">
            <?php
            if($erreur == "true")
            {
                echo "<p style='color:red'>Au moins un des champs n'est pas rempli correctement</p>";
            }?>
            <form action="./php/dbFunctions.php<?php echo $idModif ?>" method="post">
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
                
                <label for="classe" class="labelSize">Classe :</label>
                <select name="classe">
                    <?php
                    CreateListClasses(ListClasses());
                    ?>
                </select><br/>
                <?php
                if($changerAdmin)
                {
                    echo '<label for="changerAdmin" class="labelSize">Type de compte (0/1) :</label>';
                    echo '<input type="number" min="0" max="1" name="changerAdmin" value="'.$estAdmin.'" class="InputFormulaire" onkeydown="return false"><br/>';
                }
                ?>
                <input type="submit" value="Envoyer <?php echo $modif ?>" name="submit<?php echo $modif ?>" >
                <input type="reset" value="Réinitialiser">
                <a href="php/utilisateurs.php">Liste d'utilisateurs</a><?php if(isset($_SESSION['login'])){?> | | | |  <a href="php/sports.php">Sports</a> <?php } ?>
            </form>
        </div>
    </body>
</html>