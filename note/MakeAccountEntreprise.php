<?php if (isset($_SESSION['IS_CONNECTED'])) {
    header('Location: home.php');
}
else {
    ?>
    <h2>Créer un compte</h2>
    <form action="CreateAccountEntreprise.php" method="post">
        <input type="text" name="nom" placeholder="NOM D'UTILISATEURS" />
        <input type="text" name="mdp" placeholder="MOT DE PASSE" />
        <input type="text" name="email" placeholder="EMAIL" />
        <button type="submit">Envoyer</button>
    </form>
    <a href="index.php"> Connexion </a>
<?php
}
?>