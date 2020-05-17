<?php if (isset($_SESSION['IS_CONNECTED'])) {
    header('Location: home.php');
}
else {
    ?>
    <h2>Connexion</h2>
    <form action="connexion.php" method="post">
        <input type="text" name="username" placeholder="username" />
        <input type="text" name="pwd" placeholder="password" />
        <button type="submit">Envoyer</button>
    </form>
    <a href="MakeAccountCandidat.php"> Créer un compte candidat </a> <br>
    <a href="MakeAccountEntreprise.php"> Créer un compte entreprise </a>
<?php
}
?>