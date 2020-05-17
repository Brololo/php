<?php

session_start();

require('PDO.php');
$pdo = bddConnect();

if($_SESSION['CompteType']=='ADMIN'){

    $nom = $_POST["username"];

} else {

    $nom = $_SESSION["username"];
    
}

$query = $pdo->prepare('SELECT emailpro, Description, tel, diplome FROM compte WHERE username = :nom');
$query->execute(array("nom"=>$nom));
$resultat = $query->fetch();

var_dump($GLOBALS);


$email = $resultat["emailpro"];
$Description = $resultat["Description"];
$tel = $resultat["tel"];
$diplome = $resultat["diplome"];


echo "

<form action='SendProfile.php' method='post'>
    <label>Téléphone : <input type='text' name='Téléphone' value='$tel' ></label><br>
    <label>Adresse email : <input type='text' name='email' value='$email' ></label><br>
    <label>Dernier diplome : <input type='text' name='diplome' value='$diplome' ></label><br>
    <label>Description :<textarea id='w3mission' name='description'>$Description
    </textarea></label><br>
    <button type='submit'>Envoyer</button>
</form>

"

?>