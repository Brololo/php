<?php

session_start();

require('PDO.php');
$pdo = bddConnect();

$IDCompte = $_POST['IDCompte'];

if ($_POST['CompteType'] == 'CANDIDAT'){

    $query2 = $pdo->prepare("SELECT * FROM compte WHERE IDCompte = :IDCompte");
    $query2->execute(array('IDCompte'=>$IDCompte));
    $resultat = $query2->fetch();

    $query = $pdo->prepare("DELETE FROM compte WHERE IDCompte = :IDCompte");
    $query->execute(array('IDCompte'=>$IDCompte));

    $folder = strtolower($resultat["LastName"]."_".$resultat["FirstName"]);

    $file = $folder . "/CV.pdf";

    if(file_exists($file)){
        unlink($file);
    }

    rmdir($folder);

    $query3 = $pdo->prepare("DELETE FROM postulat WHERE IDCANDIDAT = :IDCompte");
    $query3->execute(array('IDCompte'=>$IDCompte));
    header('Location: deconnexion.php');

} elseif ($_POST['CompteType'] == 'ENTREPRISE'){

    $query2 = $pdo->prepare("DELETE FROM postulat WHERE CompteID = :IDCompte");
    $query2->execute(array('IDCompte'=>$IDCompte));

    $query = $pdo->prepare("DELETE FROM compte WHERE IDCompte = :IDCompte");
    $query->execute(array('IDCompte'=>$IDCompte));

    $query3 = $pdo->prepare("DELETE FROM offres WHERE IDCompte = :IDCompte");
    $query3->execute(array('IDCompte'=>$IDCompte));
    header('Location: deconnexion.php');

}
?>