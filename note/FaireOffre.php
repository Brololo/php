<?php

session_start();

require('PDO.php');
$pdo = bddConnect();

echo "

<form action='SendOffre.php' method='post'>
    <label>Titre : <input type='text' name='titre'></label><br>
    <label>Email : <input type='text' name='emailpro'></label><br>
    <label>Téléphone : <input type='text' name='Téléphone'></label><br>
    <label>Location : <input type='text' name='location'></label><br>
    <label>Diplome minimun : <input type='text' name='diplome'></label><br>
    <label>Décrire l'offre :
    <textarea name='description'></textarea></label><br>
    <button type='submit'>Envoyer</button>
</form>

"

?>