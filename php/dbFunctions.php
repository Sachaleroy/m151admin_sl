<?php
require_once 'mysql.inc.php';
include 'inputsData.php';

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

//Si le bouton d'inscription est cliqué
if(isset($_POST['submit']))
{
    if($nom != "" && $prenom != "" && $dateNaissance != "" && $description != "" && $email != "" && $pseudo != ""){
        insertionBase($nom, $prenom, $dateNaissance, $description, $email, $pseudo, $mdp, $classe);
    }
    else
    {
        header('Location: ../index.php?erreur=true');
    }
    
}
//Si le bouton de modification est cliqué
if(isset($_POST['submitModif']))
{
    $modif = $_GET["modif"];
    UpdateBase($nom, $prenom, $dateNaissance, $description, $email, $pseudo, $mdp, $modif, $estAdmin);
}

//Fonction pour tester si les identifiants existent
function IdentifiantDisponible($user, $pass)
{
	$data = connexionBase()->prepare('SELECT pseudo, password FROM user WHERE BINARY pseudo=:pseudo AND password=:mdp');
	$data->bindParam(':pseudo', $user, PDO::PARAM_STR);
	$data->bindParam(':mdp', $pass, PDO::PARAM_STR);
	$data->execute();
	$result = $data->fetch(PDO::FETCH_ASSOC);
	return $result;
}


//Si le bouton de suppression est cliqué
if(isset($_GET["suppr"]))
{
    $idSuppr = $_GET["suppr"];
    SupprUser($idSuppr);
}

//Fonction d'insertion dans la base des données des utilisateurs qui s'inscrivent
function insertionBase($nom, $prenom, $dateNaissance, $description, $email, $pseudo, $mdp, $classe)
{   
    $data = connexionBase()->prepare('INSERT INTO user VALUES("", :nom, :prenom, :email, :dateNaissance, :pseudo, :mdp, :description, 0, :classe)');
    $data->bindParam(':nom', $nom, PDO::PARAM_STR);
    $data->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $data->bindParam(':dateNaissance', $dateNaissance, PDO::PARAM_STR);
    $data->bindParam(':description', $description, PDO::PARAM_STR);
    $data->bindParam(':email', $email, PDO::PARAM_STR);
    $data->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $data->bindParam(':mdp', $mdp, PDO::PARAM_STR);
    $data->bindParam(':classe', $classe, PDO::PARAM_STR);
    $data->execute();
    
    header('Location: ../index.php');
}

//TODO attention ici vous utilisez $_SESSION et INPUT_POST dans une fonction qui sert à traiter avec la bd, on évite de mélanger les deux
//vous avez très bien fait le reste de la séparation du code sinon.

//Fonction de mise à jour de la base
function updateBase($nom, $prenom, $dateNaissance, $description, $email, $pseudo, $mdp, $modif, $estAdmin, $classe)
{
    //si l'utilisateur connecté est un admin
    if(estAdmin($_SESSION['login']) == NULL)
    {
        if (filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING) == NULL) 
        {
            $req = connexionBase()-> prepare('UPDATE user SET nom=:nom, prenom=:prenom, email=:email, dateNaissance=:dateNaissance, pseudo=:pseudo, description=:description, idClasse=:classe WHERE idUser='.$modif);
        }
        else
        {
            $req = connexionBase()-> prepare('UPDATE user SET nom=:nom, prenom=:prenom, email=:email, dateNaissance=:dateNaissance, pseudo=:pseudo, description=:description, password=:mdp, idClasse=:classe WHERE idUser='.$modif);
            $req->bindParam(':mdp', $mdp, PDO::PARAM_STR);
        }
    }
    //Si l'utilisateur connecté n'est pas un admin
    else
    {
        if (filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING) == NULL) 
        {
            $req = connexionBase()-> prepare('UPDATE user SET nom=:nom, prenom=:prenom, email=:email, dateNaissance=:dateNaissance, pseudo=:pseudo, description=:description, estAdmin=:estAdmin, idClasse=:classe WHERE idUser='.$modif);
        }
        else
        {
            $req = connexionBase()-> prepare('UPDATE user SET nom=:nom, prenom=:prenom, email=:email, dateNaissance=:dateNaissance, pseudo=:pseudo, description=:description, password=:mdp, estAdmin=:estAdmin, idClasse=:classe WHERE idUser='.$modif);
            $req->bindParam(':mdp', $mdp, PDO::PARAM_STR);
        }
        $req->bindParam(':estAdmin', $estAdmin, PDO::PARAM_STR);
    }
    $req->bindParam(':nom', $nom, PDO::PARAM_STR);
    $req->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $req->bindParam(':dateNaissance', $dateNaissance, PDO::PARAM_STR);
    $req->bindParam(':description', $description, PDO::PARAM_STR);
    $req->bindParam(':email', $email, PDO::PARAM_STR);
    $req->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $req->bindParam(':classe', $classe, PDO::PARAM_STR);
    
    $req->execute();
    
    header('Location: ./utilisateurs.php');
}

//Fonction de suppression d'un utilisateur
function SupprUser($idSuppr)
{
    $req = connexionBase()->prepare('DELETE FROM user WHERE idUser='.$idSuppr);
    $req->execute();
    header('Location: ./utilisateurs.php');
}

//Fonction qui fait une liste des utilisateurs
function listUser()
{
    $req = connexionBase()-> prepare('SELECT idUser, nom, prenom, email, dateNaissance, pseudo, description, estAdmin FROM user');
    $req->execute();
    return $req;
}

//Fonction qui fait une liste détaillé des infos d'un utilisateur
function detailsUser($idUser)
{
    $req = connexionBase()-> prepare('SELECT idUser, nom, prenom, email, dateNaissance, pseudo, description FROM user WHERE idUser ='.$idUser);
    $req->execute();
    return $req;
}

//Fonction de récupération des données de l'utilisateur à modifier
function donneesFormulaireModif($idUser)
{
    $req = connexionBase()-> prepare('SELECT idUser, nom, prenom, email, dateNaissance, pseudo, description, estAdmin FROM user WHERE idUser ='.$idUser);
    $req->execute();
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    return $result; 
}

//Fonciton qui teste si un utilisateur est admin ou non
function estAdmin($pseudo)
{
    $req = connexionBase()-> prepare('SELECT idUser FROM user WHERE pseudo ="'.$pseudo.'" AND estAdmin = 1');
    $req->execute();
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    if($result == NULL){
        return false;
    }
    else{
        return true;
    } 
}

//Function qui récupère la liste des classes
function listClasses()
{
    $req = connexionBase()-> prepare('SELECT * FROM classes');
    $req->execute();
    return $req; 
}

//Function qui récupère la liste des sports
function listSports()
{
    $req = connexionBase()-> prepare('SELECT * FROM sports');
    $req->execute();
    return $req; 
}
function listSportsActifs()
{
    $req = connexionBase()-> prepare('SELECT * FROM sports WHERE estActif = 1');
    $req->execute();
    return $req; 
}
function sportEstActif($idSport)
{
    $req = connexionBase()-> prepare('SELECT * FROM sports WHERE estActif = 1 AND idSport = "'.$idSport.'"');
    $req->execute();
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    if($result == NULL){
        return false;
    }
    else{
        return true;
    }
}

function rendreActif($idSport)
{
    $req = connexionBase()-> prepare('UPDATE sports SET estActif="1" WHERE idsport='.$idSport);
    $req->execute();
}

function rendreInactif($idSport)
{
    $req = connexionBase()-> prepare('UPDATE sports SET estActif="0" WHERE idsport='.$idSport);
    $req->execute();
}

function choixSports($pseudo, $choixSport1, $choixSport2, $choixSport3, $choixSport4)
{
    try{
        connexionBase()->beginTransaction();
        $req = connexionBase()->prepare("INSERT INTO choix VALUES('".getID($pseudo)[0]."', :sport1, 1)");
        $req->bindParam(':sport1', $choixSport1, PDO::PARAM_STR);
        $req->execute();

        $req = connexionBase()->prepare("INSERT INTO choix VALUES('".getID($pseudo)[0]."', :sport2, 2)");
        $req->bindParam(':sport2', $choixSport2, PDO::PARAM_STR);
        $req->execute();

        $req = connexionBase()->prepare("INSERT INTO choix VALUES('".getID($pseudo)[0]."', :sport3, 3)");
        $req->bindParam(':sport3', $choixSport3, PDO::PARAM_STR);
        $req->execute();

        $req = connexionBase()->prepare("INSERT INTO choix VALUES('".getID($pseudo)[0]."', :sport4, 4)");
        $req->bindParam(':sport4', $choixSport4, PDO::PARAM_STR);                      
        $req->execute();
        connexionBase()->commit();

    }catch(Exception $e)
    {
        connexionBase()->rollback();
        return false;
    }
    header('Location: ./sports.php');
    return true;
}


function getID($pseudo)
{
    $req = connexionBase()-> prepare('SELECT idUser FROM user WHERE pseudo="'.$pseudo.'"');
    $req->execute();
    return $req ->fetch(); 
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
