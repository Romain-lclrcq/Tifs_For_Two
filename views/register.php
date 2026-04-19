<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/header.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link rel="stylesheet" href="/assets/css/register.css">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>

<body>
    <?php include __DIR__ . '/../views/templates/header.php'  ?>
    <h3> Créez vous un compte pour prendre rendez-vous ! </h3>
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
                <input type="tel" name="telNumber" value="<?= $telNumber ?>" required>
            </label>
            <label>Adresse mail :
                <input type="email" name="mail" value='<?= $mail ?>' required>
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
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        </fieldset>
        <input type="submit" value="Valider mon inscription">
    </form>
    <?php include __DIR__ . '/../views/templates/footer.html' ?>
</body>

</html>