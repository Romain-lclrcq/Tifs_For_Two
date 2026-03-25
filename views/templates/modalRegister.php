<dialog open>
    <form action="<?= $url ?>" method="POST">
        <input type="submit" value="X">
    </form>
    <p>
        <?php if ($success == true) {
            echo "Vous êtes désormais inscrit";
        } else {

            foreach ($result as $error) {
                echo $error . "<br>";
            }
        }
        ?>
    </p>
    <!-- TODO Faire le css de la modal -->
</dialog>

<style>
    dialog {
        position: absolute;
        top: 40%;
        left: 40%;
    }
</style>