<?php

if(empty($_POST["nom"]) or empty($_POST["prenom"])){
    header('Location: index.php');
} else {

    require('PDO.php');

    $pdo = bddConnect();

    $FirstName = $_POST["nom"];
    $LastName = $_POST["prenom"];
    $mdp = $_POST["mdp"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $query = $pdo->prepare("INSERT INTO compte (CompteType, FirstName, LastName, pwd, USERNAME, EMAIL)
    VALUES ('CANDIDAT','$FirstName','$LastName', '$mdp', '$username', '$email'); ");
    $query->execute();
    header('Location: index.php');
}
?>