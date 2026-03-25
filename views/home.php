<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link rel="stylesheet" href="/assets/css/home.css">
    <link rel="stylesheet" href="/assets/css/header.css">

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
                        Lorem ipsum dolor sit amet. Sed autem voluptatibus est illo quod non
                        doloribus temporibus rem obcaecati quia ut dolore vero. Sit nihil illo
                        eum saepe voluptatum aut quod architecto non inventore facere. Eos
                        voluptatem dignissimos est recusandae quia aut molestias facilis a
                        repellendus harum hic exercitationem enim a amet ratione ut molestiae
                        rerum. Ut voluptas sint vel exercitationem omnis aut quibusdam omnis
                        quo dolorem voluptatem eos molestias dolores.
                    </p>
                </div>
                <img src="/assets/img/Equipe.png" alt="" />
            </section>
            <div class="cut"></div>

            <section id="s2">
                <div>
                    <h3>Colorations Végétales...</h3>
                    <p>
                        Lorem ipsum dolor sit amet. Sed autem voluptatibus est illo quod non
                        doloribus temporibus rem obcaecati quia ut dolore vero. Sit nihil illo
                        eum saepe voluptatum aut quod architecto non inventore facere. Eos
                        voluptatem dignissimos est recusandae quia aut molestias facilis a
                        repellendus harum hic exercitationem enim a amet ratione ut molestiae
                        rerum. Ut voluptas sint vel exercitationem omnis aut quibusdam omnis
                        quo dolorem voluptatem eos molestias dolores.
                    </p>
                </div>
                <img src="/assets/img/CouleurVegetale.png" alt="" />
            </section>
            <div class="cut"></div>
            <section>
                <div>
                    <h3>... & Bien être</h3>
                    <p>
                        Lorem ipsum dolor sit amet. Sed autem voluptatibus est illo quod non
                        doloribus temporibus rem obcaecati quia ut dolore vero. Sit nihil illo
                        eum saepe voluptatum aut quod architecto non inventore facere. Eos
                        voluptatem dignissimos est recusandae quia aut molestias facilis a
                        repellendus harum hic exercitationem enim a amet ratione ut molestiae
                        rerum. Ut voluptas sint vel exercitationem omnis aut quibusdam omnis
                        quo dolorem voluptatem eos molestias dolores.
                    </p>
                </div>
                <img src="/assets/img/headSpa.jpg" alt="" />
            </section>
        </div>

        <aside>
            <h3>
                Vos derniers avis
            </h3>
            <div class="cut"></div>
            <p>
                Note globale : <br> <meter value="1"></meter>
                <br>ca peut etre sympa mais a voir plus tard
            </p>
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