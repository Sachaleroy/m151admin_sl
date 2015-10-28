<?php
require_once 'mysql.inc.php';

$nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
$prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
$dateNaissance = filter_input(INPUT_POST, 'dateNaissance', FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING);
$mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);
$mdp = Sha1($mdp);

$pseudoConnection = filter_input(INPUT_POST, 'pseudoConnection', FILTER_SANITIZE_STRING);
$mdpConnection = filter_input(INPUT_POST, 'mdpConnection', FILTER_SANITIZE_STRING);
$mdpConnection = sha1($mdpConnection);

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

if(isset($_POST['submit']))
{
    insertionBase($nom, $prenom, $dateNaissance, $description, $email, $pseudo, $mdp);
}
if(isset($_POST['submitModif']))
{
    $modif = $_GET["modif"];
    UpdateBase($nom, $prenom, $dateNaissance, $description, $email, $pseudo, $mdp, $modif);
}



if (isset($_POST["login"])) 
{
    if (isset($pseudoConnection) && isset($mdpConnection)) 
    {
        $result = IdentifiantDisponible($pseudoConnection, $mdpConnection);
        
        if ($result != NULL) {
    		//... et est redirigé sur le site
		session_start();
    		$_SESSION['login'] = $pseudoConnection;
    		header('Location: ../index.php');
    		exit();
    	}
    	// si on ne trouve aucune réponse, soit le pseudo, soit le mot de passe est faux
    	else
        {
            $erreur = 'Erreur dans le login ou le mot de passe.';
        }
    }
}

function IdentifiantDisponible($user, $pass)
{
	$data = connexionBase()->prepare('SELECT pseudo, password FROM user WHERE pseudo=:pseudo AND password=:mdp');
	$data->bindParam(':pseudo', $user, PDO::PARAM_STR);
	$data->bindParam(':mdp', $pass, PDO::PARAM_STR);
	$data->execute();
	$result = $data->fetch(PDO::FETCH_ASSOC);
	return $result;
}



if(isset($_GET["suppr"]))
{
    $idSuppr = $_GET["suppr"];
    SupprUser($idSuppr);
}

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

function updateBase($nom, $prenom, $dateNaissance, $description, $email, $pseudo, $mdp, $modif)
{
    if ($mdp == "") 
    {
        $req = connexionBase()-> prepare('UPDATE user SET nom=:nom, prenom=:prenom, email=:email, dateNaissance=:dateNaissance, pseudo=:pseudo, description=:description WHERE idUser='.$modif);
    }
    else
    {
        $req = connexionBase()-> prepare('UPDATE user SET nom=:nom, prenom=:prenom, email=:email, dateNaissance=:dateNaissance, pseudo=:pseudo, description=:description, password=:mdp WHERE idUser='.$modif);
    }
    $req->bindParam(':nom', $nom, PDO::PARAM_STR);
    $req->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $req->bindParam(':dateNaissance', $dateNaissance, PDO::PARAM_STR);
    $req->bindParam(':description', $description, PDO::PARAM_STR);
    $req->bindParam(':email', $email, PDO::PARAM_STR);
    $req->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $req->bindParam(':mdp', $mdp, PDO::PARAM_STR);
    $req->execute();
    
    header('Location: ./utilisateurs.php');
}

function SupprUser($idSuppr)
{
    $req = connexionBase()->prepare('DELETE FROM user WHERE idUser='.$idSuppr);
    $req->execute();
    header('Location: ./utilisateurs.php');
}

function listUser()
{
    $req = connexionBase()-> prepare('SELECT idUser, nom, prenom, email, dateNaissance, pseudo, description, estAdmin FROM user');
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
    return $result; 
}

function estAdmin($pseudo)
{
    $req = connexionBase()-> prepare('SELECT idUser FROM user WHERE pseudo ="'.$pseudo.'" AND estAdmin = "1"');
    $req->execute();
    $result = $req->fetch(PDO::FETCH_ASSOC);
    return $result; 
}

/*if(isset($_POST['login']))
{
    TestLogin($pseudoConnection, $mdpConnection);
}*/

/*function TestLogin($username, $password)
{
    $req = connexionBase()-> prepare('SELECT pseudo, password FROM user WHERE pseudo = "'.$username. '"');
    $req->execute();
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    $logged = false;
    if (sha1($mdpConnection) == $result[0]['password']) {
        $logged = true;
    }
    
    $output = $logged ? $username . ' est connecté !' : 'connexion echouée';
    //header('Location: ./login.php');
    return $output;
}*/
