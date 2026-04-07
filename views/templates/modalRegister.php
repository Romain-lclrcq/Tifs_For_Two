<dialog open>
    <form action="<?= $url ?>" method="POST">
        <?php if ($url === '/register') : ?>
            <input type="hidden" value="<?= $_POST['lastname'] ?>" name="lastname">
            <input type="hidden" value="<?= $_POST['firstname'] ?>" name="firstname">
            <input type="hidden" value="<?= $_POST['birthday'] ?>" name="birthday">
            <input type="hidden" value="<?= $_POST['mail'] ?>" name="mail">
            <input type="hidden" value="<?= $_POST['telNumber'] ?>" name="telNumber">
        <?php endif; ?>
        <input type="submit" value="X">
    </form>
    <p>
        <?php if ($success == true) {
            echo "<div>";
            echo "<h3>Félicitation</h3>";
            echo "<p>Vous êtes désormais inscrit !</p>";
            echo "</div>";
        } else {
            echo "<h3>L'inscription a échoué:</h3>";
            echo "<ul>";
            foreach ($result as $error) {
                echo "<li>" . $error . "</li>";
            }
            echo "</ul>";
        }
        ?>
    </p>
    <!-- TODO Faire le css de la modal -->
</dialog>

<style>
    dialog {
        position: absolute;
        top: 40vh;
        left: 30vw;
        width: 40vw;
        height: 20vh;
        border: 2px solid #cb45c4;
        box-shadow: 5px 5px 10px 5px;

    }

    dialog>div {
        display: flex;
        gap: 1em;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        text-align: center;
    }

    dialog>form {
        position: absolute;
        right: 10px;
        top: 10px;
    }

    dialog>form>input[type="submit"] {
        border: none;
        background: white;
        cursor: pointer;
        padding: 10px;
        font-weight: 900;
    }

    dialog h3 {
        text-decoration: underline;
        text-align: center;
        margin: 1em 0;
    }

    dialog li {
        width: 80%;
        list-style-position: inside;
        margin: .5em 1em;
    }

    @media screen and (max-width: 1000px) {
        dialog {
            height: 30vh;
        }

        dialog H3 {
            margin: 2em 1em;
        }

    }
</style>