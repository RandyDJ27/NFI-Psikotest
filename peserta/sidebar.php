<?php include('../config/koneksi.php'); ?>

<nav class="navbar navbar-dark bg-danger shadow-sm">
  <div class="container-fluid">
    
    <a class="navbar-brand d-flex align-items-center" href="media.php?hal=home">
      <img src="http://localhost/psikotes/asset/img/logo-baru.png" width="45" height="35" class="d-inline-block align-top mr-2">
      <span style="font-size: 16px; font-weight: bold;">Psikotes Online</span>
    </a>

    <button class="navbar-toggler d-md-none" type="button" data-toggle="collapse" data-target="#menuPeserta" aria-controls="menuPeserta" aria-expanded="false">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="menuPeserta">
      <ul class="navbar-nav d-md-none"> <li class="nav-item">
          <a class="nav-link text-white" href="media.php?hal=home"><i class="fas fa-home mr-2"></i> Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="media.php?hal=profiluser"><i class="fas fa-user mr-2"></i> Profil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="logout.php"><i class="fas fa-sign-out-alt mr-2"></i> Keluar</a>
        </li>
      </ul>
    </div>

  </div>
</nav>

<style>
  /* Styling untuk HP */
  @media (max-width: 767px) {
    .navbar-collapse {
      background-color: #dc3545;
      padding: 10px;
      margin-top: 5px;
      border-radius: 5px;
    }
    .nav-link {
      border-bottom: 1px solid rgba(255,255,255,0.1);
      padding: 10px 0;
    }
  }

  /* KUNCI: Di Desktop, sembunyikan area menu agar tidak merusak layout */
  @media (min-width: 768px) {
    #menuPeserta {
      display: none !important;
    }
  }
</style>