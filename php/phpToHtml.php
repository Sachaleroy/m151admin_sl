<?php
function createTableUser($table)
{
    //Pour chaque entrée dans la base...
    foreach($table as $row)
    {
        //...on crée une ligne de tableau
        echo"<tr> <td>".$row[0]."</td> <td>".$row[1]."</td> <td>".$row[2]."</td> <td>".$row[3]."</td> <td>".$row[4]."</td> <td>".$row[5]."</td> <td><a href='detailsUser.php?page=".$row[0]."'>D</a></td> <td><a href='../index.php?modif=".$row[0]."'>M</a></td> </tr>";
    }
    //echo"<tr> <td>".$row[0]."</td> <td>".$row[1]."</td> <td>".$row[2]."</td> <td>".$row[3]."</td> <td>".$row[4]."</td> <td>".$row[5]."</td> <td>".$row[6]."</td> </tr>";
}

//Fonction qui affiche les infos d'un utilisateur précis
function createTableDetailsUser($table)
{
    foreach($table as $row)
    {
        echo"<tr> <td>".$row[0]."</td> <td>".$row[1]."</td> <td>".$row[2]."</td> <td>".$row[3]."</td> <td>".$row[4]."</td> <td>".$row[5]."</td> <td>".$row[6]."</td> </tr>";
    }
}

