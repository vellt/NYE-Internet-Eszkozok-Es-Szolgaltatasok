<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">PHP gyakorlat</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <?php if(!isset($_SESSION['user'])):?>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php?oldal=fooldal">Főoldal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?oldal=regisztracio">Regisztráció</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?oldal=belepes">Belépés</a>
          </li>
        <?php endif ?>

        <?php if(isset($_SESSION['user'])):?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?oldal=profil">Profil oldal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?oldal=felhasznalok">Felhasználók lista</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?kilepes">Kilépés</a>
        <?php endif ?>
        </li>
      </ul>
    </div>
  </div>
</nav>