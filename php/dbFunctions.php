<?php
require_once 'mysql.inc.php';

function connexionBase()
{
    static $connection = null;
    if($connection == null) {
	try 
	{
		$connection = new PDO('mysql:host='.HOST.';dbname='.DBNAME.'', USERNAME, PASSWORD);
	} 
	catch ( Exception $e ) 
	{
		echo "Connection à MySQL impossible : ", $e->getMessage();
		die();
	}
    }
	return $connection;
}

if(isset($_POST['submit']))
{
    insertionBase();
}

function insertionBase()
{   
    $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
    $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
    $dateNaissance = filter_input(INPUT_POST, 'dateNaissance', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING);
    $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);
    
    $data = connexionBase()->prepare('INSERT INTO user VALUES("", :nom, :prenom, :email, :dateNaissance, :pseudo, :mdp, :description)');
    $data->bindParam(':nom', $nom, PDO::PARAM_STR);
    $data->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $data->bindParam(':dateNaissance', $dateNaissance, PDO::PARAM_STR);
    $data->bindParam(':description', $description, PDO::PARAM_STR);
    $data->bindParam(':email', $email, PDO::PARAM_STR);
    $data->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $data->bindParam(':mdp', $mdp, PDO::PARAM_STR);
    $data->execute();
    
}
