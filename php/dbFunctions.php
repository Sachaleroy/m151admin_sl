<?php
require_once 'mysql.inc.php';

//Filtrage des données du formulaire
$nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
$prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
$dateNaissance = filter_input(INPUT_POST, 'dateNaissance', FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING);
$mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);
$mdp = Sha1($mdp);


//Fonction de connexion à la base
function connexionBase()
{
    static $connection = null;
    if($connection == null) {
	try 
	{
		$connection = new PDO('mysql:host='.HOST.';dbname='.DBNAME.'', USERNAME, PASSWORD);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} 
	catch ( Exception $e ) 
	{
		echo "Connection à MySQL impossible : ", $e->getMessage();
		die();
	}
    }
	return $connection;
}

//Si le formulaire est envoyé
if(isset($_POST['submit']))
{
    insertionBase($nom, $prenom, $dateNaissance, $description, $email, $pseudo, $mdp);
}

//Fonction d'insertion de données dans la base
function insertionBase($nom, $prenom, $dateNaissance, $description, $email, $pseudo, $mdp)
{   
    $data = connexionBase()->prepare('INSERT INTO user VALUES("", :nom, :prenom, :email, :dateNaissance, :pseudo, :mdp, :description)');
    $data->bindParam(':nom', $nom, PDO::PARAM_STR);
    $data->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $data->bindParam(':dateNaissance', $dateNaissance, PDO::PARAM_STR);
    $data->bindParam(':description', $description, PDO::PARAM_STR);
    $data->bindParam(':email', $email, PDO::PARAM_STR);
    $data->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $data->bindParam(':mdp', $mdp, PDO::PARAM_STR);
    $data->execute();
    
    header('Location: ../index.php');
}

//Fonction qui crée un tableau contenant tout les utilisateurs de la base plus leur infos
function listUser()
{
    $req = connexionBase()-> prepare('SELECT idUser, nom, prenom, email, dateNaissance, pseudo, description FROM user');
    $req->execute();
    return $req;
}

function detailsUser($idUser)
{
    $req = connexionBase()-> prepare('SELECT idUser, nom, prenom, email, dateNaissance, pseudo, description FROM user WHERE idUser ='.$idUser);
    $req->execute();
    return $req;
}

function donneesFormulaireModif($idUser)
{
    $req = connexionBase()-> prepare('SELECT idUser, nom, prenom, email, dateNaissance, pseudo, description FROM user WHERE idUser ='.$idUser);
    $req->execute();
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($result);
    return $result; 
}