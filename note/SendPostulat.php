<?php

session_start();

require('PDO.php');
$pdo = bddConnect();

$IDCompte = $_POST["IDCOmpte"];
$IDOffre = $_POST["IDOffre"];
$IDCandidat = $_SESSION["IDCompte"];

$query = $pdo->prepare('SELECT * FROM postulat WHERE IDCANDIDAT = :IDCompte');
$query->execute(array('IDCompte'=>$IDCandidat));
$res = $query->fetchall();

$ok = 'oui';

foreach($res as $candidature){
    $OffreID = $candidature['OffreID'];
    if ($OffreID==$IDOffre){
        echo "Vous avez déjà postulé pour cette offre !" ;
        $ok = 'non';
    }
}

if($ok == 'oui'){

    $query = $pdo->prepare("INSERT INTO postulat (CompteID, OffreID, IDCANDIDAT, Accepter) 
    VALUES  ( '$IDCompte', '$IDOffre', '$IDCandidat', '?')");
    $query->execute();
    header('Location: home.php');
}
?>