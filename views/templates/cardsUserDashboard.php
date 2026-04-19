<?php
$cardsUser = $_SESSION['customers'];
?>

<div class='contenairCardUser'>
    <?php

    foreach ($cardsUser as $user) {
        $idAccount = $user->getIdAccount();
        $userId = $user->getIdcustomer();
        echo "<div>";
        echo "<p>" . $user->getFirstname() . '</p>';
        echo "<p>" . $user->getLastname() . '</p>';
        echo "<p>" . $user->getBirthday()->format('d-m-Y') . '</p>';
        echo
        "<form method='post' action =''>
        <input type='hidden' name='IdCustomer' value=" . $userId . ">
        <input type='submit' value='Modifier'>
        </form>";
        echo
        "<form method='post' action =''>
        <input type='hidden' name='IdCustomer' value=" . $userId . ">
        <input type='hidden' name='delete' value='delete'>
        <input type='submit' class='confirmation' value='Supprimer'
        onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')\">
        </form>";
        echo "</div>";
    }

    ?>
    <!-- TODO faire la modal pour la création d'un utilisateur -->
</div>
<form action="" method="post">
    <input type="hidden" name="idAccount" value="<?= $idAccount ?>">
    <input type="submit" value="Ajouter une personne">
</form>
<style>
    .contenairCardUser {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        gap: 3em;
    }

    .contenairCardUser div {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .contenairCardUser div p {
        padding: .3em;
        letter-spacing: .1em;
    }

    form {
        display: flex;
        justify-content: center;
    }

    input[type="submit"] {
        background-color: white;
        color: #cb45c4;
        padding: .2em 2em;
        border: none;
        border-radius: 10px;
        box-shadow: 0 0 5px black;
        margin: 5px;
    }
</style>