<?php if (isset($_SESSION['IS_CONNECTED'])) {
    header('Location: home.php');
}
else {
    ?>
    <h2>Créer un compte</h2>
    <form action="CreateAccountCandidat.php" method="post">
        <input type="text" name="nom" placeholder="NOM" />
        <input type="text" name="prenom" placeholder="PRENOM" />
        <input type="text" name="username" placeholder="NOM D'UTILISATEUR" />
        <input type="text" name="email" placeholder="EMAIL" />
        <input type="text" name="mdp" placeholder="MOT DE PASSE" />
        <button type="submit">Envoyer</button>
    </form>
    <a href="index.php"> Connexion </a>
<?php
}
?>