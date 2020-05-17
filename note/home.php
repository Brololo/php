<?php
session_start();

if ($_SESSION["IS_CONNECTED"] != TRUE) {
    header('Location: index.php');
}

require('PDO.php');

$pdo = bddConnect();

$nom = $_SESSION["username"];

if($_SESSION["CompteType"]=="CANDIDAT"){

    $query = $pdo->prepare('SELECT FirstName, LastName FROM compte WHERE username = :nom');
    $query->execute(array("nom"=>$nom));
    $resultat = $query->fetch();

    $query = $pdo->prepare('SELECT OffreID, titre, location, username FROM offres');
    $query->execute(array());
    $offres = $query->fetchall();

    $folder = strtolower($resultat["LastName"]."_".$resultat["FirstName"]);
    if(file_exists($folder)==FALSE){
        mkdir($folder);
    }
    $IDCompte = $_SESSION['IDCompte'];

    echo "Bonjour ".htmlspecialchars($resultat["LastName"])." ".htmlspecialchars($resultat["FirstName"]);

    echo "<form action='deconnexion.php' method='post' >
    <button type='submit'>Déconnexion</button>
    </form>

    <form action='profile.php'>
    <button type='submit'>Faire son profile</button>
    </form>

    <form action='mesCandidatures.php'>
    <button type='submit'>Regarder vos candidatures</button>
    </form>
    
    <form action='UpdateCV.php' method='post' enctype='multipart/form-data'>
    <input type='file' name='fileToUpload' id='fileToUpload' />
    <button type='submit' value='Upload Image' name='file'>Envoyer votre CV PDF</button>
    </form>";

    foreach($offres as $offre){
        $titre = $offre["titre"];
        $username = $offre["username"];
        $location = $offre["location"];
        $OffreID = $offre["OffreID"];
        echo "
        $titre  </br>
        $username </br>
        $location </br>
        <form action='RegarderOffre.php' method='post' >
        <button type='submit' name='id' value='$OffreID'>Regarder l'offre</button>
        </form>
       " ;
    }
    echo"
    <form action='deletecompte.php' method='post'>
    <input type='hidden' name='CompteType' value='CANDIDAT'>
    <button type='submit' name='IDCompte' value='$IDCompte'>Supprimer votre compte</button>
    </form>
    ";
}

if($_SESSION["CompteType"]=="ENTREPRISE"){

    $id = $_SESSION["IDCompte"];

    echo "Bonjour ".htmlspecialchars($nom);

    echo "<form action='deconnexion.php' method='post' >
    <button type='submit'>Déconnexion</button>
    </form>

    <form action='profile.php'>
    <button type='submit'>Modifier son profile</button>
    </form>

    <form action='FaireOffre.php' method='post' >
    <button type='submit'>Faire une offre</button>
    </form>";

    $query = $pdo->prepare('SELECT * FROM offres WHERE IDCompte = :id');
    $query->execute(array('id' => $id));
    $offres = $query->fetchall();

    foreach($offres as $offre){
        $titre = $offre["titre"];
        $username = $offre["username"];
        $location = $offre["location"];
        $OffreID = $offre["OffreID"];
        echo "
        $titre  </br>
        $username </br>
        $location </br>
        <form action='ModifierOffre.php' method='post' >
        <button type='submit' name='id' value='$OffreID'>Modifier l'offre</button>
        </form>
        <form action='RegarderPostulat.php' method='post' >
        <button type='submit' name='OffreID' value='$OffreID'>Regarder les candidatures</button>
        </form>
        " ;
    }
    echo"
        <form action='deletecompte.php' method='post' >
        <input type='hidden' name='CompteType' value='ENTREPRISE'>
        <button type='submit' name='IDCompte' value='$id'>Supprimer votre compte</button>
        </form>
        ";
}

if($_SESSION["CompteType"]=="ADMIN"){

    echo "Bonjour l'admin <br> <br>
    <form action='deconnexion.php' method='post' >
    <button type='submit'>Déconnexion</button>
    </form>";

    $query = $pdo->prepare('SELECT * FROM offres');
    $query->execute(array());
    $offres = $query->fetchall();

    $query2 = $pdo->prepare('SELECT * FROM compte WHERE CompteType = "ENTREPRISE"');
    $query2->execute(array());
    $entreprises = $query2->fetchall();

    $query3 = $pdo->prepare('SELECT * FROM compte WHERE CompteType = "CANDIDAT"');
    $query3->execute(array());
    $candidats = $query3->fetchall();

    foreach($offres as $offre){
        $titre = $offre["titre"];
        $username = $offre["username"];
        $location = $offre["location"];
        $OffreID = $offre["OffreID"];
        echo "
        $titre  </br>
        $username </br>
        $location </br>
        <form action='ModifierOffre.php' method='post' >
        <button type='submit' name='id' value='$OffreID'>Modifier l'offre</button>
        </form>
        <form action='deleteoffre.php' method='post' >
        <button type='submit' value='$OffreID'>Delete l'offre</button>
        </form>
        " ;
    }

    foreach($entreprises as $entreprise){
        $CompteType = $entreprise["CompteType"];
        $nom = $entreprise["username"];
        $compteid = $entreprise["IDCompte"];
        echo "
        $nom  </br>
        $compteid </br>
        <form action='profile.php' method='post'>
        <input type='hidden' name='username' value='$nom'>
        <button type='submit' value='$compteid'>Modifier son profile</button>
        </form>
        <form action='deletecompte.php' method='post'>
        <input type='hidden' name='CompteType' value='ENTREPRISE'>
        <button type='submit' name='IDCompte' value='$compteid'>Delete son compte</button>
        </form>
        " ;
    }

    foreach($candidats as $candidat){
        $CompteType = $candidat["CompteType"];
        $nom = $candidat["username"];
        $compteid = $candidat["IDCompte"];
        echo "
        $nom  </br>
        $compteid </br>
        <form action='profile.php' method='post'>
        <input type='hidden' name='username' value='$nom'>
        <button type='submit' value='$compteid'>Modifier son profile</button>
        </form>
        <form action='deletecompte.php' method='post'>
        <input type='hidden' name='CompteType' value='CANDIDAT'>
        <button type='submit' name='IDCompte' value='$compteid'>Delete son compte</button>
        </form>
        " ;
    }
}
?>