<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link rel="stylesheet" href="/assets/css/home.css">
    <link rel="stylesheet" href="/assets/css/header.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">


    <title>Tifs For Two</title>
</head>

<body>
    <?php include __DIR__ . '/../views/templates/header.php' ?>


    <main>
        <div>
            <section id="s1">
                <div>
                    <h3>QUI SOMMES NOUS</h3>
                    <p>
                        Depuis plus de 15 ans, notre salon de coiffure est devenu une institution incontournable à Neuilly-en-Thelle.
                        Porté par l'expertise d'une gérante passionnée et d'une équipe soudée de deux collaboratrices talentueuses,
                        nous mettons notre savoir-faire au service de votre beauté et de votre bien-être.
                    </p>
                    <p>
                        Dans une ambiance chaleureuse et familiale, nous avons à cœur de créer un lien privilégié avec chacun de nos clients.
                        Que vous veniez pour une coupe tendance, une coloration sur-mesure ou un simple moment de détente,
                        notre trio d'expertes combine expérience et créativité pour sublimer votre chevelure.
                        La fidélité de notre clientèle depuis plus d'une décennie est notre plus belle récompense :
                        entrez, installez-vous, et laissez-nous prendre soin de vous.
                    </p>
                </div>
                <img src="/assets/img/Equipe.png" alt="" />
            </section>
            <div class="cut"></div>

            <section id="s2">
                <div>
                    <h3>Colorations Végétales...</h3>
                    <p>
                        Soucieuses de votre santé et de la vitalité de vos cheveux, nous avons choisi de mettre à l'honneur la coloration végétale.
                        Bien plus qu'une simple alternative, c'est un véritable soin protecteur qui respecte la fibre capillaire tout en offrant des reflets intenses et
                        une brillance incomparable.
                    </p>
                    <p>
                        Composées exclusivement de plantes tinctoriales et de soins naturels,
                        nos colorations sont sans substances chimiques agressives. Elles sont idéales pour celles et
                        ceux qui souhaitent une couverture des cheveux blancs tout en douceur, ou simplement apporter de la profondeur à leur couleur naturelle sans l'abîmer.
                        Confiez votre chevelure à notre équipe d'expertes pour une transition vers une beauté plus éthique, saine et durable.
                    </p>
                </div>
                <img src="/assets/img/CouleurVegetale.png" alt="" />
            </section>
            <div class="cut"></div>
            <section>
                <div>
                    <h3>... & Bien être</h3>
                    <p>
                        Parce que la beauté des cheveux commence par la détente de l'esprit,
                        nous avons conçu un espace dédié au bien-être absolu.
                        Pionnières de la relaxation à Neuilly-en-Thelle, nous vous invitons à découvrir l'expérience unique du Head Spa.
                        Bien plus qu'un simple shampooing, c'est un rituel holistique associant soins profonds du cuir chevelu et techniques de massages crâniens ancestrales.
                    </p>
                    <p>
                        Laissez-vous transporter par nos massages relaxants qui libèrent les tensions,
                        stimulent la microcirculation et favorisent la pousse de vos cheveux.
                        Dans une atmosphère apaisante, loin du tumulte quotidien, notre équipe prend le temps de masser votre cuir chevelu,
                        votre nuque et vos épaules. Que vous optiez pour un soin purifiant ou un modelage relaxant, chaque geste est une invitation au lâcher-prise.
                        Offrez-vous ce moment privilégié : une escale bien-être où le temps semble s'arrêter.
                    </p>
                </div>
                <img src="/assets/img/headSpa.jpg" alt="" />
            </section>
        </div>

        <aside>
            <h3>
                Vos derniers avis
            </h3>
            <?php foreach ($opinions as $opinion) : ?>

                <div class="minicut"></div>
                <span>
                    <div>
                        <p><?= $opinion['firstname'] ?></p>
                        <p><?= $opinion['date']->format('d/m/y') ?></p>
                        <p><?= $opinion['note'] ?>/5</p>
                    </div>
                    <p><?= $opinion['commentary'] ?></p>
                </span>
            <?php endforeach; ?>
        </aside>
    </main>


    <?php include __DIR__ . '/../views/templates/footer.html' ?>
</body>

</html>