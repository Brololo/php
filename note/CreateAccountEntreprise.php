<?php

if(empty($_POST["nom"]) or empty($_POST["mdp"]) or empty($_POST["email"])){
    header('Location: index.php');
} else {

    require('PDO.php');

    $pdo = bddConnect();

    $nom = $_POST["nom"];
    $mdp = $_POST["mdp"];
    $email = $_POST["email"];
    $query = $pdo->prepare("INSERT INTO compte (CompteType, username, pwd, EMAIL)
    VALUES ('ENTREPRISE','$nom','$mdp','$email');");
    $query->execute();
    header('Location: index.php');
}
?>