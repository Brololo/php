<?php

session_start();

require('PDO.php');
$pdo = bddConnect();

if(empty($_POST["titre"]) or empty($_POST["Téléphone"]) or empty($_POST["emailpro"]) or empty($_POST["location"]) or empty($_POST["diplome"]) or empty($_POST["description"]) ){
    header('Location: home.php');
}
$user = $_SESSION["username"];
$IDCompte = $_SESSION["IDCompte"];
$titre = $_POST["titre"];
$diplome = $_POST["diplome"];
$telephone = $_POST["Téléphone"];
$email = $_POST["emailpro"];
$location = $_POST["location"];
$description = $_POST["description"];


if(isset($_POST['id'])==False){
    $query = $pdo->prepare("INSERT INTO offres (IDCompte, titre, username, emailpro , diplome , tel , Description , location) 
    VALUES (  '$IDCompte', '$titre', '$user', '$email', '$diplome', '$telephone', '$description', '$location'); ");
    $query->execute();
    header('Location: home.php');

} else {
    $id = $_POST["IDOffre"];
    $query = $pdo->prepare("UPDATE offres SET titre = :titre, emailpro = :emailpro, diplome = :diplome, tel = :telephone, Description = :description, location = :location WHERE OffreID = :IDOffre");
    $query->execute(array('titre'=>$titre, 'emailpro' => $email, 'diplome' => $diplome, 'telephone' => $telephone, 'description' => $description, 'location' => $location, 'IDOffre' => $id  ));
    header('Location: home.php');
}
?>