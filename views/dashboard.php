<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/css/header.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
</head>

<body>
    <?php include __DIR__ . '/../views/templates/header.php' ?>
    <h1>Information de votre compte</h1>
    <ul>
        <li>Date de création (a venir)</li>
        <li><?= $_SESSION['mail'] ?></li>
        <li><?= $_SESSION['tel'] ?></li>
        <!-- TODO voir pour mettre la date de création dans les infos du compte -->
    </ul>
    <div class='cut'></div>
    <section>
        <h2>Utilisateur</h2>
        <small>Prenez rendez-vous pour toute la famille</small>
        <?php include __DIR__ . '/../views/templates/cardsUserDashboard.php' ?>
        <p>Listing de tous les utilisateurs avec possibilité de modification et de rajouter des utilisateurs</p>
    </section>
    <div class='cut'></div>
    <section>
        <h2>Votre historique de réservation </h2>
        <p>listing de toutes les réservation + bouton pour rediriger vers les avis</p>
        <?php include __DIR__ . '/../views/templates/appointmentHistoryDashboard.php' ?>
    </section>
    <?php include __DIR__ . '/../views/templates/footer.html' ?>
    <?php include __DIR__ . '/../views/templates/modalCreateCustomer.php' ?>
    <?php include __DIR__ . '/../views/templates/modalUpdateCustomer.php' ?>
</body>

</html>