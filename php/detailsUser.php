<?php
    include './dbFunctions.php';
    include './phpToHtml.php';
?>
<html>
    <head>
        <title>m151admin_sl</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
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
                        <p>Description</p>
                    </td>
                </tr>
            <?php
                createTableDetailsUser(detailsUser($_GET["page"]));   
            ?>
            </table>
            <a href='./utilisateurs.php'>Retour</a>
        </div>
    </body>
</html>