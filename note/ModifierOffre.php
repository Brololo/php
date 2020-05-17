<?php

session_start();

require('PDO.php');
$pdo = bddConnect();

$nom = $_SESSION["username"];
$id = $_POST["id"];
$IDOffre = $_POST["id"];

$query = $pdo->prepare('SELECT * FROM offres WHERE OffreID = :id');
$query->execute(array("id"=>$id));
$resultat = $query->fetch();

$titre = $resultat["titre"];
$emailpro = $resultat["emailpro"];
$tel = $resultat["tel"];
$location = $resultat["location"];
$diplome = $resultat["diplome"];
$Description = $resultat["Description"];

echo "

<form action='SendOffre.php' method='post'>
    <input type='hidden' name='id' value='TRUE'>
    <label>Titre : <input type='text' name='titre' placeholder='Votre entreprise' value='$titre'></label><br>
    <label>Email : <input type='text' name='emailpro' value='$emailpro'></label><br>
    <label>Téléphone : <input type='text' name='Téléphone' value='$tel'></label><br>
    <label>Location : <input type='text' name='location' value='$location'></label><br>
    <label>Diplome minimun : <input type='text' name='diplome' value='$diplome'></label><br>
    <label>Décrire l'offre :
    <textarea name='description'>$Description</textarea></label><br>
    <button type='submit' name='IDOffre' value='$IDOffre'>Envoyer</button>
</form>

<form action='deleteoffre.php' method='post'>
    <button type='submit' name='IDOffre' value='$IDOffre'>Supprimer l(offre</button>
</form>

"
?>