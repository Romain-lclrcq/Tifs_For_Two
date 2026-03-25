<style>
    .modalUpdate {
        position: fixed;
        top: 50%;
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

    btnCloseModal.addEventListener("click", (evt) => {
        evt.preventDefault()
        modalUpdate.close();
    })
</script>