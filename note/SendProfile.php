<?php

session_start();

require('PDO.php');
$pdo = bddConnect();

if($_SESSION["CompteType"]=='ADMIN'){

    $user = $_POST['nom'];

} else {

    $user = $_SESSION["username"];

}

$diplome = $_POST["diplome"];
$telephone = $_POST["Téléphone"];
$email = $_POST["email"];
$description = $_POST["description"];
$query = $pdo->prepare("UPDATE compte SET emailpro = :email, diplome = :diplome, tel = :telephone, Description = :description WHERE username = :user");
$query->execute(array('email' => $email, 'diplome' => $diplome, 'telephone' => $telephone, 'description' => $description, 'user' =>  $user ));
header('Location: home.php');

?>