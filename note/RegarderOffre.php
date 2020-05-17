<?php

session_start();

require('PDO.php');
$pdo = bddConnect();

$OffreID = $_POST['id'];

$query = $pdo->prepare('SELECT * FROM offres where OffreID = :OffreID');
$query->execute(array( "OffreID"=>$OffreID ));
$res = $query->fetch();

$IDCompte = $res['IDCompte'];
$entreprise = $res["username"];

echo "

L'entreprise " . $entreprise . " propose un job : 
<br> 
<br>
Description : 
<br>
" . $res["Description"] . " 
<br>
<br>
Location :" . $res["location"] . " 
<br>
<br>
Vous pouez les contactez avec le numéro de téléphone suivant : " . $res["tel"] . "
<br>
<br>
Ou avec l'adresse Email suivant : " . $res["emailpro"] . "
<br>
<br>
Vous pouvez postuler avec le bouton suivant qui va envoyer votre cv à l'entreprise.
<br>
<br>
<form action='SendPostulat.php' method='post'>
<button type='submit' name = 'nom' value='$entreprise'>Envoyer votre CV</button>
<input type='hidden' name='IDOffre' value='$OffreID'>
<input type='hidden' name='IDCOmpte' value='$IDCompte'>
</form>"
;
?>