<?php
include_once 'dbFunctions.php';
function createTableUser($table)
{
    $pseudo = "";
    if(isset($_SESSION['login']))
    {
        $pseudo = $_SESSION['login'];
    }
    $estAdmin = estAdmin($pseudo);
    //Pour chaque entrée dans la base...
    foreach($table as $row)
    {
        if(isset($_SESSION['login']))
        {            
            if($estAdmin != "")
            {
                //...on crée une ligne de tableau
                echo"<tr> <td>".$row[0]."</td> <td>".$row[1]."</td> <td>".$row[2]."</td> <td>".$row[3]."</td> <td>".$row[4]."</td> <td>".$row[5]."</td> <td><a href='detailsUser.php?page=".$row[0]."'>D</a></td> <td><a href='../index.php?modif=".$row[0]."'>M</a></td> <td><a href='./dbFunctions.php?suppr=".$row[0]."'>X</a></td> </tr>";
            }
            if($_SESSION['login'] == $row[5] && $estAdmin == "")
            {
                //...on crée une ligne de tableau
                echo"<tr> <td>".$row[0]."</td> <td>".$row[1]."</td> <td>".$row[2]."</td> <td>".$row[3]."</td> <td>".$row[4]."</td> <td>".$row[5]."</td> <td><a href='detailsUser.php?page=".$row[0]."'>D</a></td> <td><a href='../index.php?modif=".$row[0]."'>M</a></td> <td><a href='./dbFunctions.php?suppr=".$row[0]."'>X</a></td> </tr>";
            }
            if($_SESSION['login'] != $row[5] && $estAdmin == "")
            {
                echo"<tr> <td>".$row[0]."</td> <td>".$row[1]."</td> <td>".$row[2]."</td> <td>".$row[3]."</td> <td>".$row[4]."</td> <td>".$row[5]."</td> <td><a href='detailsUser.php?page=".$row[0]."'>D</a></td> <td></td> <td></td> </tr>";
            }
        }
        if(!isset($_SESSION['login']))
        {
            echo"<tr> <td>".$row[0]."</td> <td>".$row[1]."</td> <td>".$row[2]."</td> <td>".$row[3]."</td> <td>".$row[4]."</td> <td>".$row[5]."</td> <td><a href='detailsUser.php?page=".$row[0]."'>D</a></td> <td></td> <td></td> </tr>";
        }
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

function CreateListClasses($classes)
{
    foreach($classes as $c)
    {
        echo"<option value='".$c[0]."'>".$c[1]."</option>";
    }
}

function CreateListSports($sports)
{
    foreach($sports as $s)
    {
        echo"<option value='".$s[0]."'>".$s[1]."</option>";
    }
}
function CreateTableSports($sports)
{
    foreach($sports as $s)
    {
        //$estActif = sportEstactif($s[0]);
        
        echo'<tr>';
        echo'<td>'.$s[1].'</td>';
        echo'<td><a href="./gestionSports.php?modif='.$s[0].'" style="text-decoration: none;">Modifier</a></td>';
        if(sportEstActif($s[0]) == false)
        {
            echo'<td><a href="./gestionSports.php?rendreActif='.$s[0].'" style="text-decoration: none;">Rendre actif</a></td>';
        }
        else
        {
            echo'<td><a href="./gestionSports.php?rendreInactif='.$s[0].'" style="text-decoration: none;">Rendre inactif</a></td>';
        }
        echo'</tr>';
    }
}
