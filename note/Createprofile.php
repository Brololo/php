<?php
session_start();

require('PDO.php');
$pdo = bddConnect();

$nom = $_SESSION["username"];
$query = $pdo->prepare('SELECT FirstName, LastName FROM compte WHERE username = :nom');
$query->execute(array("nom"=>$nom));
$resultat = $query->fetch();

$path = strtolower($resultat["LastName"]."_".$resultat["FirstName"])."/profile.php";
if(file_exists($path)==FALSE){
    $ok = fopen($path, 'w');
}
header('Location: '.$path);
?>