<?php

session_start();

require('PDO.php');
$pdo = bddConnect();

$IDOffre = $_POST['IDOffre'];

$query = $pdo->prepare("DELETE FROM offres WHERE OffreID = :IDOffre");
$query->execute(array('IDOffre'=>$IDOffre));
$query2 = $pdo->prepare("DELETE FROM postulat WHERE OffreID = :IDOffre");
$query2->execute(array('IDOffre'=>$IDOffre));
header('Location: home.php');

?>