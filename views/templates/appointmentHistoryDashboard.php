<?php
$appointments = $_SESSION['appointments'];

usort($appointments, function ($a, $b) {
    return $b <=> $a;
});

echo "<table>";
echo '<thead>';
echo '<tr >';
echo "<th> Prénom </th>";
echo "<th> Nom</th>";
echo "<th class='serviceTable'> Prestation</th>";
echo "<th> Heure et date de réservation</th>";
echo "<th>Prestation réalisé par :</th>";
echo '</tr>';
echo '</thead>';


foreach ($appointments as $appointment) {
    echo '<tr>';
    echo "<th>" . $appointment['firstname'] . "</th>";
    echo "<th>" . $appointment['lastname'] . "</th>";
    echo "<th class='serviceTable'>" . $appointment['service'] . "</th>";
    echo "<th>" . $appointment['date'] . "</th>";
    echo "<th>" . $appointment['employe'] . "</th>";
    echo '</tr>';
}
echo "</table>"
?>
<style>
    table {
        border-collapse: collapse;
        margin: 0 auto;
        text-align: center;
    }

    tr {
        border-bottom: 1px solid #cb45c4;
        border-top: 1px solid #cb45c4;
    }

    thead {
        background-color: white;
        font-weight: 900;
    }

    th {
        padding: 1em 5vw;
        font-weight: lighter;

    }

    .serviceTable {
        padding: 0 7vw;
    }

    /* .appointment {
        margin: 10em;
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 2em;
        border-bottom: 1px solid #cb45c4;
        border-top: 1px solid #cb45c4;
    }

    .name {

        display: flex;
        flex-direction: column;
        align-items: center;
    } */
</style>
// -> Pour tous les membres, je vais chercher tous les rendez vous