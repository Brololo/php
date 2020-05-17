<?php
session_start();

require('PDO.php');

$pdo = bddConnect();

$nom = $_SESSION['username'];

$query = $pdo->prepare('SELECT FirstName, LastName FROM compte WHERE username = :nom');
$query->execute(array("nom"=>$nom));
$resultat = $query->fetch();

$folder = strtolower($resultat["LastName"]."_".$resultat["FirstName"]);

$destination = "$folder/CV.pdf";

$mime = file_get_contents($_FILES["fileToUpload"]["tmp_name"], NULL, NULL, 0, 5);

if($mime == "%PDF-"){
    if(!file_exists($destination)){
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "$destination");
        echo"Votre CV est arrivé à destination sans troubles";
    } else { 
        unlink($destination);
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "$destination");
        echo"Votre CV est arrivé à destination sans troubles";
    }
} else {
    echo "Vous n'avez pas choisi un fichier en format PDF";
}
?>