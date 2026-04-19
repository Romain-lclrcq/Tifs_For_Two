<style>
    .modalUpdate {
        position: fixed;
        /* top: 50%; */
        margin: 0 auto;
        width: 70vw;
        display: flex;
        flex-direction: column;
        align-items: center;


    }

    .modalUpdate form {
        margin-top: 2em;
        margin-bottom: 1em;
        display: flex;
        flex-direction: column;
        gap: .5em;
        align-items: center;
    }

    .modalUpdate input[type='submit'],
    .modalUpdate button {
        background-color: white;
        color: #cb45c4;
        border: none;
        padding: 1em 2em;
        border-radius: 10px;
        box-shadow: 0 0 10px black;
    }
</style>

<?php
$showDialog = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['IdCustomer'])) {
    $showDialog = true;
}
?>
<dialog class='modalUpdate' <?= $showDialog ? 'open' : '' ?>>


    <form action="/dashboard/update" method="POST">
        <input type="text" name="lastname" id="" value="<?= $userUpdate->getLastname() ?> ">
        <input type="text" name="firstname" id="" value="<?= $userUpdate->getFirstname() ?>">
        <input type="date" name="birthday" id="" value="<?= $userUpdate->getBirthday()->format('Y-m-d') ?>">
        <input type="hidden" name="idAccount" value="<?= $userUpdate->getIdAccount() ?>">
        <input type="hidden" name="idCustomer" value="<?= $userUpdate->getIdcustomer() ?>">
        <input type="submit" value="Valider le changement">
    </form>
    <button>Annuler</button>
    <br>

</dialog>

<script>
    const btnCloseModal = document.querySelector('.modalUpdate button')
    const modalUpdate = document.querySelector('.modalUpdate')
    console.log(btnCloseModal);


    btnCloseModal.addEventListener("click", (evt) => {
        modalUpdate.style.display = 'none'
    })
</script>