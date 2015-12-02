<?php
require_once 'dbFunctions.php';
require_once "phpToHtml.php";
session_start();

$erreur = "";

if(isset($_POST["envoyerChoix"]))
{
    if(choixSports($_SESSION['login'], $choixSport1, $choixSport2, $choixSport3, $choixSport4) != true)
    {
        $erreur = "Choisissez 4 sports différents !";
    }
}

if(!isset($_SESSION['login'])){
    header('Location: ./utilisateurs.php');
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
        <?php
        if(!isset($_SESSION['login']))
        {
            echo "<a href='./login.php' style='text-decoration: none;'>Connexion</a>";
        }
        if(isset($_SESSION['login']))
        {
            echo "Utilisateur connecté : ".$_SESSION['login']." |   <a href='./deconnexion.php' style='text-decoration: none;'>Déconnexion</a>";
        }
        ?>
        <div id="content">
            <h1>Choix des sports</h1>
            <form action="#" method="post">
                <label for="choix1" class="labelSelectSize">Choix 1 :</label>
                <select name="choix1">
                    <?php
                    CreateListSports(Listsports());
                    ?>
                </select><br/>
                <label for="choix2" class="labelSelectSize">Choix 2 :</label>
                <select name="choix2">
                    <?php
                    CreateListSports(Listsports());
                    ?>
                </select><br/>
                <label for="choix3" class="labelSelectSize">Choix 3 :</label>
                <select name="choix3">
                    <?php
                    CreateListSports(Listsports());
                    ?>
                </select><br/>
                <label for="choix4" class="labelSelectSize">Choix 4 :</label>
                <select name="choix4">
                    <?php
                    CreateListSports(Listsports());
                    ?>
                </select><br/>
                <?php echo '<p style="color: red;">'.$erreur.'</p>' ?>
                <input type="submit" value="Envoyer choix" name="envoyerChoix" >
                <input type="reset" value="Réinitialiser">
                <a href="utilisateurs.php">Liste d'utilisateurs</a>
            </form>
        </div>
    </body>
</html>

