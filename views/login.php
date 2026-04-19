<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/css/header.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link rel="stylesheet" href="/assets/css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>

<body>
    <?php include __DIR__ . '/../views/templates/header.php' ?>

    <form action="/login/login" method="post">
        <fieldset>
            <legend>Connectez-vous !</legend>
            <?php if (!empty($_SESSION['error'])): ?>
                <p class="messErr">
                    <?= $_SESSION['error'] ?>
                </p>
            <?php endif; ?>
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
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <input type="submit" value="Se connecter">
    </form>
    <p class="error">
    </p>
    <?php include __DIR__ . '/../views/templates/footer.html' ?>

</body>

</html>