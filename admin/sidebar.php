<?php include('../config/koneksi.php'); ?>

<nav class="navbar navbar-dark bg-danger shadow-sm">
  <div class="container-fluid">
    
    <a class="navbar-brand d-flex align-items-center" href="media.php?module=home">
      <img src="http://localhost/psikotes/asset/img/logo-baru.png" width="45" height="35" class="d-inline-block align-top mr-2">
      <span style="font-size: 18px; font-weight: bold;">Admin Psikotes</span>
    </a>

    <button class="navbar-toggler d-md-none" type="button" data-toggle="collapse" data-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="adminNavbar">
      <ul class="navbar-nav d-md-none">
        <li class="nav-item">
          <a class="nav-link text-white" href="media.php?module=home"><i class="fas fa-home mr-2"></i> Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="media.php?module=soal"><i class="fas fa-file-alt mr-2"></i> Kelola Soal</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="media.php?module=hasiltes"><i class="fas fa-poll mr-2"></i> Hasil Tes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="media.php?module=pengaturantes"><i class="fas fa-cog mr-2"></i> Peraturan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="media.php?module=users"><i class="fas fa-users mr-2"></i> Data Peserta</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="logout.php"><i class="fas fa-sign-out-alt mr-2"></i> Keluar</a>
        </li>
      </ul>
    </div>

  </div>
</nav>

<style>
  /* CSS UNTUK TAMPILAN DESKTOP (PC) */
  @media (min-width: 768px) {
    /* Pastikan menu horizontal di atas benar-benar hilang agar tidak dobel */
    #adminNavbar {
      display: none !important;
    }
    /* Menyembunyikan tombol hamburger di PC */
    .navbar-toggler {
      display: none !important;
    }
  }

  /* CSS UNTUK TAMPILAN MOBILE (HP) */
  @media (max-width: 767px) {
    .navbar-collapse {
      background-color: #dc3545; /* Merah sesuai identitas */
      padding: 10px;
      margin-top: 5px;
      border-radius: 5px;
    }
    .nav-link {
      border-bottom: 1px solid rgba(255,255,255,0.1);
      padding: 12px 5px;
    }
  }
</style>