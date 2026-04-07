<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/css/header.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link rel="stylesheet" href="/assets/css/login.css">
</head>

<body>
    <?php include __DIR__ . '/../views/templates/header.php' ?>

    <form action="/login/login" method="post">
        <fieldset>
            <legend>Connectez-vous !</legend>

            <label>Votre mail :
                <input type="text" name="mail">
            </label>
            <label>Votre mot de passe :
                <input type="password" name="password">
            </label>
            <label>Voulez-vous rester connecté ?
                <input type="checkbox" name="connexion" valuer="oui" id="">
            </label>
        </fieldset>
        <input type="submit" value="Se connecter">
    </form>
    <p class="error">
        <?php
        if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        } ?>
    </p>
    <?php include __DIR__ . '/../views/templates/footer.html' ?>

</body>

</html>