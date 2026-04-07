<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['firstname'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $telNumber = $_POST['telNumber'];
    $mail = $_POST['mail'];
} else {
    $firstname = '';
    $lastname = '';
    $mail = '';
    $telNumber = '';
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/header.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link rel="stylesheet" href="/assets/css/register.css">
    <title>Document</title>
</head>

<body>
    <?php include __DIR__ . '/../views/templates/header.php'  ?>
    <h3> Créez vous un compte afin de pouvoir prendre rendez-vous ! </h3>
    <form action="/register/register" method="post">
        <fieldset>
            <legend>Utilisateur</legend>
            <label> Nom :
                <input type="text" name="lastname" value="<?= $lastname ?>" required>
            </label>
            <label> Prénom :
                <input type="text" name="firstname" value="<?= $firstname ?>" required>
            </label>
            <label> Date de naissance :
                <input type="date" name="birthday" required>
            </label>
        </fieldset>
        <fieldset>
            <legend>Compte</legend>
            <label>Numéro de téléphone :
                <input type="tel" name="telNumber" value="<?= $telNumber ?>" placeholder="06.12.34.45.56." required>
            </label>
            <label>Adresse mail :
                <input type="email" name="mail" value='<?= $mail ?>' placeholder="Jean@Peuplu.com" required>
            </label>
        </fieldset>
        <fieldset>
            <legend>Sécurité</legend>
            <label>Mot de passe :
                <input type="password" name="password" required>
            </label>
            <label>Confirmation :
                <input type="password" name="confirmPassword" required>
            </label>
        </fieldset>
        <input type="submit" value="Valider mon inscription">
    </form>
    <!-- TODO attention au Value -->
    <!-- TODO faire un sorte de garder les cases remplies en cas d'echec de création de compte -->
    <?php include __DIR__ . '/../views/templates/footer.html' ?>
</body>

</html>