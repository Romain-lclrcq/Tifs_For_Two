<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/header.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link rel="stylesheet" href="/assets/css/opinion.css">
    <title>Document</title>
</head>

<body>
    <?php include __DIR__ . '/templates/header.php'    ?>
    <table>
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Commentaire</th>
                <th>Date de publication</th>
                <th>Note (/5)</th>
            </tr>
        </thead>

        <?php foreach ($opinions as $opinion) : ?>
            <tr>
                <th><?= $opinion['firstname'] ?></th>
                <th><?= $opinion['commentary'] ?></th>
                <th><?= $opinion['date']->format('d M') ?></th>
                <th><?= $opinion['note'] ?> // Remplacer la note par un nombre d'étoile</th>
            </tr>
        <?php endforeach; ?>
    </table>

    <div class="cut"></div>
    <h3>Vous aussi postez votre commentaire !</h3>
    <form action="#" method="post">
        <label>Votre commentaire :
            <textarea name="descriptif"></textarea>
        </label>
        <div>
            <label>Votre note (/5) :</label>
            <input type="radio" name="note" class="note" value="1" id="labelNote1">
            <label for='labelNote1'>1</label>

            <input type="radio" name="note" class="note" value="2" id="labelNote2">
            <label for='labelNote2'>2</label>

            <input type="radio" name="note" class="note" value="3" id="labelNote3">
            <label for='labelNote3'>3</label>

            <input type="radio" name="note" class="note" value="4" id="labelNote4">
            <label for='labelNote4'>4</label>

            <input type="radio" name="note" class="note" value="5" id="labelNote5">
            <label for='labelNote5'>5</label>

        </div>
        <input type="submit" value="Publier mon avis">
    </form>
    <?php include __DIR__ . '/templates/footer.html' ?>
</body>

</html>