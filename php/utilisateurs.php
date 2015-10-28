<?php 
    include './dbFunctions.php';
    include './phpToHtml.php';
    session_start();
?>
<html>
    <head>
        <title>m151admin_sl</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php
        if(isset($_SESSION['login']))
        {
            echo "Utilisateur connecté : ".$_SESSION['login']." |   <a href='./deconnexion.php' style='text-decoration: none;'>Déconnexion</a>";
        }
        ?>
        <div id="content">
            <table border="20">
                <tr>
                    <td>
                        <p>ID</p>
                    </td>
                    <td>
                        <p>Nom</p>
                    </td>
                    <td>
                        <p>Prénom</p>
                    </td>
                    <td>
                        <p>eMail</p>
                    </td>
                    <td>
                        <p>Date de naissance</p>
                    </td>
                    <td>
                        <p>Pseudo</p>
                    </td>
                    <td>
                        <p>Détails</p>
                    </td>
                    <td>
                        <p>Modifier</p>
                    </td>
                    <td>
                        <p>Supprimer</p>
                    </td>
                </tr>
            <?php
                createTableUser(listUser());   
            ?>
            </table>
            <a href='../index.php'>Retour</a>
        </div>
    </body>
</html>

