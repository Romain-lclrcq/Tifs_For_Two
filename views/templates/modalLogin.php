<dialog open>
    <form action="/home/">
        <input type="submit" value="X">
    </form>
    <div>

        <p>"Connexion réussie"</p>
        <p>Bienvenue </p>
        <!-- TODO mettre le nom dans le 'bvn' au dessus -->
    </div>
</dialog>

<style>
    dialog {
        position: absolute;
        z-index: 1;
        top: 40%;
    }

    dialog>div {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
</style>