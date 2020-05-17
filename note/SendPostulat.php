<?php

session_start();

require('PDO.php');
$pdo = bddConnect();

$IDCompte = $_POST["IDCOmpte"];
$IDOffre = $_POST["IDOffre"];
$IDCandidat = $_SESSION["IDCompte"];
$query = $pdo->prepare("INSERT INTO postulat (CompteID, OffreID, IDCANDIDAT, Accepter) 
VALUES  ( '$IDCompte', '$IDOffre', '$IDCandidat', '?')");
$query->execute();
header('Location: home.php');
?>