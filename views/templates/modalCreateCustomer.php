<style>
    .modalCreate {
        position: fixed;
        top: 40%;
    }
</style>

<?php
$showModal = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idAccount'])) {
    $showModal = true;
}

?>

<dialog class='modalCreate' <?= $showModal ? 'open' : '' ?>>
    <form action="/dashboard/create" method="post">
        <input type="hidden" name="idAccount" value="<?= $_POST['idAccount'] ?>">
        <label> Nom :
            <input type="text" name="lastname">
        </label>
        <label> Prénom :
            <input type="text" name="firstname">
        </label>
        <label> Date de naissance :
            <input type="date" name="birthday">
        </label>

        <input type="submit" value="Créer le nouvelle utilisateur">
        <button>X</button>


    </form>
</dialog>

<script>
    const btnCancelCreate = document.querySelector(".modalCreate > form button");
    const modalCreateUser = document.querySelector('.modalCreate')
    btnCancelCreate.addEventListener('click', (evt) => {
        evt.preventDefault()
        modalCreateUser.close()
    })
</script>