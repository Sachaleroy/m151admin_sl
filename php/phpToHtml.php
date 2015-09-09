<?php
function createTableUser($table)
{
    foreach($table as $row)
    {
        echo"<tr> <td>".$row[0]."</td> <td>".$row[1]."</td> <td>".$row[2]."</td> <td>".$row[3]."</td> <td>".$row[4]."</td> <td>".$row[5]."</td> <td>".$row[6]."</td> <td><a href='detailsUser".$row[0].".php'>|_۞_|</a></td> <td><a href='modifUser".$row[0].".php'>|_۞_|</a></td> </tr>";
    }
    //echo"<tr> <td>".$row[0]."</td> <td>".$row[1]."</td> <td>".$row[2]."</td> <td>".$row[3]."</td> <td>".$row[4]."</td> <td>".$row[5]."</td> <td>".$row[6]."</td> </tr>";
}

