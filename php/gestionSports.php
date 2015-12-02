<?php
require_once 'dbFunctions.php';
require_once "phpToHtml.php";
session_start();

//Si la variable de session n'est pas set ou si l'utilisateur n'est pas un admin
if (!isset($_SESSION['login']) || estAdmin($_SESSION['login']) == false) {
    header('Location: ./utilisateurs.php');
}

if(isset($_GET['rendreActif']) && $_GET['rendreActif'] != ""){
    rendreActif($_GET['rendreActif']);
}

if(isset($_GET['rendreInactif']) && $_GET['rendreInactif'] != ""){
    rendreInactif($_GET['rendreInactif']);
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
        if (!isset($_SESSION['login'])) {
            echo "<a href='./login.php' style='text-decoration: none;'>Connexion</a>";
        }
        if (isset($_SESSION['login'])) {
            echo "Utilisateur connecté : " . $_SESSION['login'] . " |   <a href='./deconnexion.php' style='text-decoration: none;'>Déconnexion</a>";
        }
        ?>
        <div id="content">
            <h1>Liste des sports</h1>
            <table border="1">
                <tr>
                    <td>Nom du sport</td>
                    <td>Modifier</td>
                    <td>Actif/Inactif</td>
                </tr>
                <?php
                    CreateTableSports(listSports());
                ?>
            </table>
        </div>
    </body>
</html>