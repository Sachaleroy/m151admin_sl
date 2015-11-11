<?php
//On récupère les valeur entrées dans les input
$nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
$prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
$dateNaissance = filter_input(INPUT_POST, 'dateNaissance', FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING);

$mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);
$mdp = Sha1($mdp);
$estAdmin = filter_input(INPUT_POST, 'changerAdmin', FILTER_SANITIZE_STRING);

$pseudoConnection = filter_input(INPUT_POST, 'pseudoConnection', FILTER_SANITIZE_STRING);
$mdpConnection = filter_input(INPUT_POST, 'mdpConnection', FILTER_SANITIZE_STRING);
$mdpConnection = sha1($mdpConnection);