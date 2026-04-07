<?php
if ($_SESSION['Id_account'] == 34) {

    $appointmentToday = $result['today'];
    $appointmentFuture = $result['future'];
    usort($appointmentFuture, function ($a, $b) {
        return $a['dateAppointment'] <=> $b['dateAppointment'];
    });
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/css/header.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link rel="stylesheet" href="/assets/css/dashboard.css">
</head>

<body>
    <?php include __DIR__ . '/../views/templates/header.php' ?>

    <?php if ($_SESSION['Id_account'] !== 34): ?>

        <h3>Information de votre compte</h3>
        <ul>
            <li>Date de création (a venir)</li>
            <li><?= $_SESSION['mail'] ?></li>
            <li><?= $_SESSION['tel'] ?></li>
            <!-- TODO voir pour mettre la date de création dans les infos du compte -->
        </ul>
        <div class='cut'></div>
        <section>
            <h3>Utilisateur</h3>
            <small>Prenez rendez-vous pour toute la famille</small>
            <?php include __DIR__ . '/../views/templates/cardsUserDashboard.php' ?>
        </section>
        <div class='cut'></div>
        <section>
            <h3>Votre historique de réservation </h3>
            <?php include __DIR__ . '/../views/templates/appointmentHistoryDashboard.php' ?>
        </section>

    <?php else : ?>
        <section class='sectionToday'>

            <h3>Les rendez-vous du jour : </h3>
            <?php if (empty($result)) : ?>
                <p>le chomage te guette</p>

            <?php else : ?>


                <table class="adminToday">
                    <thead>
                        <tr>
                            <th colspan="2">Nom du client</th>
                            <th>Prestation</th>
                            <th>Durée de la prestation</th>
                            <th>Heure du rendez-vous</th>
                            <th>Personnel</th>
                        </tr>
                    </thead>

                    <?php foreach ($appointmentToday as $listing) : ?>
                        <tr>
                            <th><?= $listing['firstname'] ?></th>
                            <th><?= $listing['lastname'] ?></th>
                            <th><?= $listing['prestation'] ?></th>
                            <th><?= $listing['timeOfPrestation'] ?></th>
                            <th><?= $listing['hourAppointment'] ?></th>
                            <th><?= $listing['employe'] ?></th>
                        </tr>


                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </section>
        <div class="cut"></div>
        <section class='futureAppointment'>
            <h3>Les prochains rendez-vous : </h3>
            <table>
                <thead>
                    <tr>
                        <th colspan="2">Nom du client</th>
                        <th>Prestation</th>
                        <th>Durée de la prestation</th>
                        <th>Date et Heure du rendez-vous</th>
                        <th>Personnel</th>
                    </tr>
                </thead>
                <?php foreach ($appointmentFuture as $listing): ?>
                    <?php $date = (new DateTime($listing['dateAppointment']))->format('d/m/Y h\h i') ?>

                    <tr>
                        <th><?= $listing['firstname'] ?></th>
                        <th><?= $listing['lastname'] ?></th>
                        <th><?= $listing['prestation'] ?></th>
                        <th><?= $listing['timeOfPrestation'] ?></th>
                        <th><?= $date ?></th>
                        <th><?= $listing['employe'] ?></th>
                    </tr>
                <?php endforeach; ?>
            </table>

        </section>


    <?php endif; ?>


    <?php include __DIR__ . '/../views/templates/footer.html' ?>
    <?php include __DIR__ . '/../views/templates/modalCreateCustomer.php' ?>
    <?php include __DIR__ . '/../views/templates/modalUpdateCustomer.php' ?>
</body>

</html>