<?php

require_once 'mysql.inc.php';
function connexionBase()
{
    static $connection = null;
    if($connection == null) {
	try 
	{
		$connection = new PDO( 'mysql:host='.HOST.';dbname='.DBNAME, USERNAME, PASSWORD );
	} 
	catch ( Exception $e ) 
	{
		echo "Connection à MySQL impossible : ", $e->getMessage();
		die();
	}
    }
	return $connection;
}

