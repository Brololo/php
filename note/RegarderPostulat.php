<?php

session_start();

require('PDO.php');
$pdo = bddConnect();

$OffreID = $_POST["OffreID"];

$query = $pdo->prepare('SELECT * FROM postulat where OffreID = :OffreID');
$query->execute(array( "OffreID"=>$OffreID ));
$res = $query->fetchall();

foreach($res as $postulat){
    $candidat = $postulat["IDCANDIDAT"];
    $query = $pdo->prepare('SELECT * FROM compte where IDCompte = :IDCompte');
    $query->execute(array( "IDCompte"=>$candidat ));
    $Info = $query->fetch();
    $firstname = $Info["FirstName"];
    $lastname = $Info["LastName"];
    $file = $lastname . "_" . $firstname . "/CV.pdf";
    $PostulatID = $postulat['PostulatID'];
    echo "
    $lastname $firstname 
    </br> a déposé une candidature
    <form action='RegarderCV.php' method='post' >
    <button type='submit' name='file' value='$file'>Regarder le CV</button>
    </form>
    <form action='reponse.php' method='post' >
    <input type='hidden' name='PostulatID' value='$PostulatID'>
    <button type='submit' name='reponse' value='OUI'>Accepter la candidature</button>
    </form>
    <form action='reponse.php' method='post' >
    <input type='hidden' name='PostulatID' value='$PostulatID'>
    <button type='submit' name='reponse' value='NON'>Refuser la candidature</button>
    </form>
" ;
}
var_dump($GLOBALS);
?>