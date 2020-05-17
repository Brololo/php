<?php
if(empty($_POST["username"]) or empty($_POST["pwd"])){
    header('Location: index.php');
}

require('PDO.php');

$pdo = bddConnect();

$query = $pdo->prepare('SELECT IDCompte, CompteType, username, pwd FROM compte WHERE username = :username');
$query->execute(array('username' => $_POST['username']));
$resultat = $query->fetch();
if (empty($resultat['username']) or empty($resultat['pwd'])){
    echo 'Mauvais identifiant';
} else {
    if ($_POST['pwd']==$resultat['pwd']) {
        session_start();
        $_SESSION["IS_CONNECTED"] = True;
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["CompteType"] = $resultat["CompteType"];
        $_SESSION["IDCompte"] = $resultat["IDCompte"];
        header('Location:home.php');
        exit;
    } else {
        echo 'Mauvais mot de passe';
    }
}
?>