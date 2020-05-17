<?php

session_start();

require('PDO.php');
$pdo = bddConnect();

$IDCANDIDAT = $_SESSION['IDCompte'];

$query = $pdo->prepare('SELECT * FROM postulat WHERE IDCANDIDAT = :IDCANDIDAT');
$query->execute(array("IDCANDIDAT"=>$IDCANDIDAT));
$resultat = $query->fetchall();

foreach($resultat as $candidature){
    $OffreID = $candidature['OffreID'];
    $query = $pdo->prepare('SELECT * FROM offres WHERE OffreID = :OffreID');
    $query->execute(array('OffreID'=>$OffreID));
    $res = $query->fetch();
    $reponse = $candidature['Accepter'];
    $titre = $res['titre'];
    $email = $res['emailpro'];
    $tel = $res['tel'];
    $entreprise = $res['username'];

    if($reponse == 'OUI'){
        echo "
        Votre candidature chez $entreprise avec pour titre $titre à été accepté.
        <br> Veuillez contactez l'entreprise avec l'adresse email $email ou avec le numéro suivant $tel.
        <br>
        <br>
        " ;
    } elseif($reponse == '?'){
        echo "
        Votre candidature chez $entreprise avec pour titre $titre n'à pas obtenue de réponse pour l'instant revenez plus tard.
        <br>
        <br>
        " ;
    } else {
        echo "
        Votre candidature chez $entreprise avec pour titre $titre à été refusé.
        <br>
        <br>
        " ;
    }
}
?>