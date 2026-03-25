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

    <form action="/register/register" method="post">
        <fieldset>
            <label> Nom :
                <input type="text" name="lastname" placeholder="Peuplu" value="Peuplu" required>
            </label>
            <label> Prénom :
                <input type="text" name="firstname" placeholder="Jean" value="Jean" required>
            </label>
            <label> Date de naissance :
                <input type="date" name="birthday" value="1999/01/01" required>
            </label>
        </fieldset>
        <fieldset>
            <label>Numéro de téléphone :
                <input type="tel" name="telNumber" placeholder="06.12.34.45.56.78" value="06.12.34.45.56.78" required>
            </label>
            <label>Adresse mail :
                <input type="email" name="mail" placeholder="Jean@Peuplu.com" value="Jean@Peuplu.com" required>
            </label>
        </fieldset>
        <fieldset>

            <label>Mot de passe :
                <input type="password" name="password" value="oui" required>
            </label>
            <label>Confirmation :
                <input type="password" name="confirmPassword" value="oui" required>
            </label>
        </fieldset>
        <input type="submit" value="Valider mon inscription">
    </form>
    <!-- TODO attention au Value -->
    <!-- TODO faire un sorte de garder les cases remplies en cas d'echec de création de compte -->
    <?php include __DIR__ . '/../views/templates/footer.html' ?>
</body>

</html>