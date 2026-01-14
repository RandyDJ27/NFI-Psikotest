<?php include('../config/koneksi.php'); ?>
<div class="row" id="body-row">
    <div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
        <ul class="list-group">
            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small>MENU</small>
            </li>
            <a href="?module=home" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fas fa-home fa-fw mr-3"></span>
                    <span class="menu-collapsed">Beranda</span>
                </div>
            </a>
            <a href="?module=soal" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-tasks fa-fw mr-3"></span>
                    <span class="menu-collapsed">Kelola Soal Tes</span>
                </div>
            </a>
            <a href="?module=hasiltes"
                class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-file-alt fa-fw mr-3"></span>
                    <span class="menu-collapsed">Hasil Tes</span>
                </div>
            </a>
            <a href="?module=pengaturantes"
                class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-tools fa-fw mr-3"></span>
                    <span class="menu-collapsed">Pengaturan Tes</span>
                </div>
            </a>
            <a href="?module=users"
                class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-users fa-fw mr-3"></span>
                    <span class="menu-collapsed">Daftar Peserta</span>
                </div>
            </a>
            <a href="?module=pengguna"
                class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-user-alt fa-fw mr-3"></span>
                    <span class="menu-collapsed">Pengguna</span>
                </div>
            </a>
            <a href="?module=tentang"
                class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-laptop fa-fw mr-3"></span>
                    <span class="menu-collapsed">Tentang</span>
                </div>
            </a>
            <a href="http://localhost/psikotes/admin/logout.php"
                class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-sign-out-alt fa-fw mr-3"></span>
                    <span class="menu-collapsed">Keluar</span>
                </div>
            </a>
        </ul>
    </div> <!-- End Sidebar -->

    <!-- MAIN -->
    <div class="col">

        <div id="page-wrapper">
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-lg-12">
                        <!--   <h3 class="page-header"> Peraturan </h3> -->

                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <div class="card-header bg-danger text-white">
                            Tentang Aplikasi Psikotes Online
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="http://localhost/psikotes/asset/img/logo-baru.png" width="70%" alt="" srcset="">
                                </div>
                                <div class="col-md-9">
                                    <p class="light">Aplikasi Psikotes Online merupakan program pelaksanaan kegiatan tes
                                        psikotes secara online. Aplikasi ini memiliki dua level hak akses yaitu
                                        administrator dan peserta tes. Untuk level admin memiliki fasilitas berupa
                                        manajemen soal, peserta tes, pengaturan tes, dan hasil tes. Untuk informasi tes
                                        psikotes berupa hasil yang lulus tes, tidak lulus tes, jumlah peserta tes dan
                                        informasi yang sudah mengerjakan tes dan yang belum mengerjakan tes. Untuk level
                                        peserta tes dapat mendaftar pada aplikasi dengan persyaratan umurnya harus lebih
                                        dari 17 tahun untuk dapat mendaftar, fasilitas untuk peserta tes berupa
                                        informasi pengaturan tes, mengerjakan soal tes dan melihat hasil tes psikotes.
                                    </p>
                                </div>
                            </div><br><br>
                            <div class="row"><br><br>
                                <div class="col-md-4">
                                    <a href="https://nissinfoods.co.id/" target="_blank"
                                        rel="noopener noreferrer">
                                        <img src="http://localhost/psikotes/asset/img/logo-baru.png" alt="" srcset="">
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="https://servicedesk.nissinfoods.co.id" target="_blank"
                                        rel="noopener noreferrer">
                                        <img src="http://localhost/psikotes/asset/img/sdp.png" alt="" srcset="">
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="http://instagram.com/blogbugabagi" target="_blank"
                                        rel="noopener noreferrer">
                                        <img src="http://localhost/psikotes/asset/img/fb.png" alt="" srcset="">
                                    </a>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->



</div>
</div>