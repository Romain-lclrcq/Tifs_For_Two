<header>
  <nav>
    <a href="/home">
      <img src="/assets/img/Logo Tifs for two.png" alt="" />
    </a>
    <ul>
      <li><a href="/service">Nos services</a></li>
      <li><a href="/opinion">Vos avis</a></li>
      <li><a href="#">Prendre rendez-vous</a></li>
      <li><a href="#">Contact</a></li>
      <?php if (empty($_SESSION['Id_account'])): ?>
        <span class="register">
          <li>
            <a href="/login">Se connecter</a>
          </li>
          <li>
            <a href="/register">Créer son compte</a>
          </li>
        </span>
      <?php else : ?>
        <span class="register">
          <li>
            <a href="/dashboard">Mon compte</a>
          </li>
          <li>
            <a href="/dashboard/disconnect">Se déconnecter</a>
          </li>
        </span>
      <?php endif; ?>
    </ul>
    <div>
      <span></span>
      <span></span>
      <span></span>
    </div>
  </nav>
</header>
<div class="title">
  <h1>Tifs For Two</h1>
  <h2>Couleur végétale & Bien-être</h2>
</div>
<div class="cut"></div>
<script src="/assets/js/header.js"></script>