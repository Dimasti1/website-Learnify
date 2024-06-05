<?php
session_start();
require 'db/function.php';

$kelas = query("SELECT * FROM kelas");

$penilaian = query("SELECT login.nama,login.foto,data_kelas.id_user,data_kelas.penilaian,data_kelas.asal_instansi 
FROM data_kelas 
INNER JOIN login 
ON data_kelas.id_user = login.id_login 
WHERE asal_instansi IS NOT NULL");
// var_dump($penilaian);


if (isset($_SESSION["login"])) {
  $id_user = $_SESSION['id_login'];
  $profile = query("SELECT * FROM login WHERE id_login = '$id_user'")[0];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Learnify</title>
  <!-- Link Boostrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

  <!-- Icon Title -->
  <link rel="icon" href="Assets/Logo-Learnify.png" type="image/x-icon" />

  <!-- My Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

  <!-- <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet"> -->

  <!-- My CSS -->
  <link rel="stylesheet" href="css/main.css" />

  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

</head>

<body style="height: 2000px">
  <!-- Start Navbar -->
  <nav class="navbar navbar-expand-lg bg-light shadow-sm bg-body rounded">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="Assets/Logo-Learnify.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top" />
        Learnify
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
        <ul class="navbar-nav   ms-3 ">
          <li class="nav-item me-4">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item dropdown me-4 ">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Course
            </a>
            <ul class="dropdown-menu me-4">
              <?php
              foreach ($kelas as $row):
                ?>
                <li>
                  <a class="dropdown-item" href="page/detail/detail.php?id=<?= $row['id_kelas'] ?>"><?= $row['nama_kelas'] ?></a>
                </li>
              <?php endforeach ?>
            </ul>
          </li>
          <li class="nav-item me-4">
            <a class="nav-link" href="page/about-us.php">About Us</a>
          </li>
          <?php
          if (isset($_SESSION["login"])) { ?>
            <li class="nav-item dropdown me-4">
              <a class="nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="account d-flex ">
                  <img src="Assets/profile/<?= $profile['foto'] ?>" class="rounded-circle me-3 " height="32px" alt="Foto"
                    loading="lazy" />
                  <p class="   dropdown-toggle">
                    <?= $_SESSION["nama"] ?>
                  </p>
                </div>

              </a>
              <ul class="dropdown-menu me-4 dropdown-menu-end">
                <li>
                  <a class="dropdown-item" href="page/profile/profile.php">My profile</a>
                </li>
                <?php if ($_SESSION["id_login"] === "20") { ?>
                  <li>
                    <a class="dropdown-item" href="page/admin/users.php">Admin Page</a>
                  </li>
                <?php } else { ?>
                  <li>
                    <a class="dropdown-item" href="page/profile/kelas-saya.php">Kelas Saya</a>
                  </li>
                <?php } ?>
                <hr />
                <li>
                  <a class="dropdown-item" href="page/logout.php">Logout</a>
                </li>
              </ul>
            </li>
          <?php } else { ?>
            <a href="page/login.php" class="btn btn-sm btn-outline-primary px-4 mx-lg-2 mb-2 mb-md-0">
              Masuk
            </a>
            <a href="page/regist.php" class="btn btn-sm btn-primary px-4 mx-lg-2">Daftar</a>
          <?php } ?>

        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->

  <!-- Start Hero Section -->
  <div class="container container-hero my-5 hero-section">
    <div class="row mb-5">
      <!-- img -->
      <div class="col-md-6 d-flex justify-content-center order-sm-1 order-md-2">
        <img class="img w-100" src="Assets/Hero 1.svg" alt="" class="justify-content-center" />
      </div>
      <!-- ENd img -->
      <!-- text section -->
      <div class="col-md-6 d-flex align-items-center">
        <div>
          <h1 class="mt-5">
            Raih <span>karir</span> impian <br />
            bersama <span>Learnify</span>
          </h1>
          <p style="font-size: 20">
            Dapatkan pekerjaan impianmu untuk masa depanmu, bersama kami anda
            akan mendapatkan pelatihan secara gratis dan terbaik.
          </p>
          <?php if (isset($_SESSION["login"])) { ?>
            <a href="#kelas_terbaik" class="btn btn-primary mt-1 btn-lg px-3">Belajar Sekarang</a>
          <?php } else { ?>
            <a href="page/login.php" class="btn btn-primary mt-1 btn-lg px-3">Belajar Sekarang</a>
          <?php } ?>

        </div>
      </div>
    </div>
  </div>
  <!-- End Hero Section -->

  <!-- Start Vlue Propotition 1 -->
  <div class="container-fluid container-value-fluid value-1 value-text vp-1 my-5 mb-4 mb-md-5">
    <div class="container container-value">
      <div class="row">
        <div class="col">
          <h1 class="text-center mt-5">
            Dapatkan Skill Baru Bersama <span> Learnify</span>
          </h1>
          <p class="d-flex justify-content-center text-center mb-5 mb-md-5">
            Bersama Learnify anda akan mendapatkan <br />
            skill yang bermanfaat untuk menunjang <br />
            karir anda dimasa depan
          </p>
        </div>
      </div>

      <div class="row content-value mt-lg-5">
        <div class="col-md-4 text-center mb-4 mb-md-5">
          <div class="container-card p-3 rounded">
            <img src="Assets/icon-vallue1-1.svg" class="img mb-4 p-3 bg-icon rounded" alt="" />
            <h4 class="fw-bold">4 Ribu</h4>

            <p class="lh-sm d-inline-flex mt-0">
              Peserta Tergabung <br />
              Bersama Learnify
            </p>
          </div>
        </div>

        <div class="col-md-4 text-center mb-4 mb-md-5">
          <div class="container-card p-3 rounded">
            <img src="Assets/icon-vallue1-2.svg" class="img mb-4 p-3 bg-icon rounded" alt="" />
            <h4 class="fw-bold">25+</h4>

            <p class="lh-sm d-inline-flex mt-0">
              Banyak Mentor <br />
              Yang Berpengalaman
            </p>
          </div>
        </div>

        <div class="col-md-4 text-center mb-4 mb-md-5">
          <div class="container-card p-3 rounded">
            <img src="Assets/icon-vallue1-3.svg" class="img mb-4 p-3 bg-icon rounded" alt="" />
            <h4 class="fw-bold">100+</h4>

            <p class="lh-sm d-inline-flex mt-0">
              Video Kelas Pilihan <br />
              Terbaik Untuk Anda
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Vlue Propotition 1 -->

  <!-- Value Proprotition 2 -->
  <div class="container container-value-2 mt-5 mx-5 value-2 text-center">
    <div class="row text-center mx-4 mx-md-5">
      <h1 class="">Mengapa memilih <span> Learnify?</span></h1>
      <p>
        Bergabung bersama Learnify anda akan mendapatkan banyak keuntungan
      </p>
    </div>

    <div class="row row-content align-items-center mt-4 mt-md-5">
      <div class="col-md-5">
        <img src="Assets/Hero 3.svg" class="img w-100" alt="" />
      </div>
      <div class="col-md-7">
        <div class="row grid gap-3 d-flex justify-content-end">
          <div class="col-md-5 card-value-2 text-center py-3">
            <img src="Assets/image 7.png" alt="" class="bg-icon p-2 rounded" />
            <p class="heading-card">Pembelajaran Gratis</p>
            <p>
              Pembelajaran bisa anda dapatkan dengan gratis tanpa pembayaran
              apapun.
            </p>
          </div>
          <div class="col-md-5 card-value-2 text-center py-3">
            <img src="Assets/image 7.png" alt="" class="bg-icon p-2 rounded" />
            <p class="heading-card">Materi Tersetruktur</p>
            <p>
              Semua materi yang ada sudah tersusun dengan terstruktur akan
              mempermudah pembelajaran.
            </p>
          </div>
          <div class="col-md-5 card-value-2 text-center py-3">
            <img src="Assets/image 7.png" alt="" class="bg-icon p-2 rounded" />
            <p class="heading-card">Menambah Soft Skill</p>
            <p>
              Dengan bergabung bersama Learnify anda akan mendapatkan
              keahlian pada bidiang digital.
            </p>
          </div>
          <div class="col-md-5 card-value-2 text-center py-3">
            <img src="Assets/image 7.png" alt="" class="bg-icon p-2 rounded" />
            <p class="heading-card">Grup Diskusi Bimbingan</p>
            <p>
              Anda bisa bergabung dengan anggota Learnify lainnya untuk
              berdiskusi bersama mentor ahli.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Value Proprotition 2 -->

  <!-- Start Card Produk -->
  <div class="container container-product mx-4 mx-md-5 mt-5">
    <div class="row text-center mx-4 mx-md-5">
      <h1 class="" id="kelas_terbaik">Program Kelas Terbaik <span> Learnify?</span></h1>
      <p>
        Learnify menyediakan kelas pilihan terbaik untuk meningkakan keahlian
        anda
      </p>
    </div>

    <div class="row mt-5">
      <?php foreach ($kelas as $row): ?>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card">
            <div class="img-box">
              <img src="Assets/<?= $row["gambar_kelas"] ?>" alt="" class="img-fluid" />
              <div class="bg-img px-4">
                <!-- <div class="info">
                  <p class="member m-0">1.232 Siswa Terdaftar</p>
                  <div class="rate">
                    <i class="bx bxs-star"></i>
                    <i class="bx bxs-star"></i>
                    <i class="bx bxs-star"></i>
                    <i class="bx bxs-star"></i>
                    <i class="bx bxs-star"></i>
                  </div>
                </div> -->
              </div>
            </div>

            <div class="product-caption mt-4">
              <h3 class="product-name">
                <?= $row["detail_awal"] ?>
              </h3>
              <div href="#" class="badge px-3 py-2">
                <?= $row["nama_kelas"] ?>
              </div>
              <div class="product-btn mt-5 d-flex justify-content-between align-items-center">
                <?php
                $kode_materi = $row["kode_materi"];
                $jumlah_materi = query("SELECT count(kode_materi) FROM materi WHERE kode_materi ='$kode_materi'")[0];
                // var_dump($jumlah_materi);
                ?>
                <div class="info-video">
                  <?= $jumlah_materi["count(kode_materi)"] ?> Video
                </div>
                <a href="page/detail/detail.php?id=<?= $row["id_kelas"] ?>"><button type="button"
                    class="btn btn-primary btn-sm">
                    Detail Kelas
                  </button>
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach ?>
    </div>
  </div>
  <!-- End Card Produk -->

  <!-- Start Testimoni -->
  <div class="container-fluid container-review vp-1 my-5 mb-4 mb-md-5 py-md-5">
    <div class="container container-value">
      <div class="row text-center">
        <div class="col-lg-8 mx-auto">
          <h2 class="text-center mt-5">
            Apa Kata Mereka Yang Sudah Menyelesaikan Kelas di <span> Learnify ? </span>
          </h2>
        </div>
      </div>
      <div class="row my-5">
        <div class="col-12">
          <!-- Swiper -->
          <div class="swiper mySwiperTesti pb-4 pb-sm-5">
            <div class="swiper-wrapper" style="
                  transform: translate3d(0px, 0px, 0px);
                  transition-duration: 0ms;
                ">
              <?php foreach ($penilaian as $row): ?>
                <div class="swiper-slide card p-4">
                  <div class="card-body">
                    <p class="body-testi mt-3">
                      <?= $row["penilaian"] ?>
                    </p>
                    <div class="detail d-flex justify-content-between align-items-center mt-4">
                      <div class="user d-flex align-items-center">
                        <img src="Assets/profile/<?= $row["foto"] ?>" alt="avatar-review-1"
                          class="rounded-circle img-fluid w-25" />
                        <div class="profile ms-3">
                          <p class="name m-0">
                            <?= $row["nama"] ?>
                          </p>
                          <p class="status m-0">
                            <?= $row["asal_instansi"] ?>
                          </p>
                        </div>
                      </div>
                      <div class="icon-quote">
                        <i class="bx bxs-quote-right"></i>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach ?>


            </div>
            <div class="swiper-pagination pt-5 myt-5"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Testimoni -->

  <!-- Strat CTA -->
  <div class="container py-5 my-5 container-cta">
    <div class="row d-flex align-items-center">
      <div class="col-lg-6 mt-3 order-2 order-lg-1">
        <h1>Bersiap untuk Belajar dan Kembangkan sp Skill Anda</h1>
        <p>
          Langsung bergabung dengan Learnify dan dapatkan banyak manfaatnya
        </p>
        <?php if (isset($_SESSION["login"])) { ?>
          <a href="#kelas_terbaik" class="btn btn-primary mt-1 btn-lg px-3">Belajar Sekarang</a>
        <?php } else { ?>
          <a href="page/login.php" class="btn btn-primary mt-1 btn-lg px-3">Belajar Sekarang</a>
        <?php } ?>
      </div>
      <div class="col-lg-6 order-1 order-lg-2 d-flex justify-content-center">
        <img src="Assets/Hero 3.svg" alt="Hero-3" class="img w-75 d-flex justify-content-center" />
      </div>
    </div>
  </div>
  <!-- Strat CTA -->

  <!-- Start Footer -->
  <footer class="footer bg-primary">
    <div class="container pt-5">
      <div class="row mb-3 d-flex align-items-center">
        <a class="navbar-brand fs-4 fw-semibold d-flex align-items-center me-3" href="#">
          Learnify
        </a>
      </div>
      <div class="row row-content justify-content-between justify-content-md-start">
        <div class="col-lg-3 col-md-6 mb-sm-4">
          <h3>Hubungi Kami</h3>
          <div class="row d-flex mt-3">
            <a href=" 
                        https://goo.gl/maps/V9TZsWie5Ug1UdAR9" terget="_blank" class="d-flex align-items-start">
              <i class="bx bx-map me-2"></i>
              <p>
                Jl. Ketintang, Kel. Ketintang, Kec. Gayungsari, Kota Surabaya
              </p>
            </a>
            <a href=" 
                        #" class="d-flex align-items-start">
              <i class="bx bx-envelope me-2"></i>

              <p>learnify@gmail.com</p>
            </a>

            <a href=" 
                        #" class="d-flex align-items-start">
              <i class="bx bx-phone me-2"></i>

              <p>+62 821 4271 4527</p>
            </a>
          </div>
        </div>
        <div class="col-lg-2 offset-lg-1 col-md-6 mt-4 mt-sm-0 mb-sm-4">
          <h3>Informasi</h3>
          <div class="row d-flex mt-3">
            <a href="#" class="mb-1">Home</a>
            <a href="#" class="mb-1">About Us</a>
          </div>
        </div>
        <div class="col-lg-2 offset-lg-1 col-md-6 mt-4 mt-sm-0 mb-sm-4">
          <h3>Course</h3>
          <div class="row d-flex mt-3">
            <a href="#" class="mb-1">UI/UX Design</a>
            <a href="#" class="mb-1">Front End Developer</a>
            <a href="#" class="mb-1">Back End Developer</a>
          </div>
        </div>
        <div class="col-lg-2 offset-lg-1 col-md-6 mt-4 mt-sm-0">
          <h3>Ikuti Kami</h3>
          <div class="sosmed mt-3 d-flex">
            <a href=" #" class="me-2">
              <i class="bx bxl-google"></i>
            </a>
            <a href="# " class="me-2">
              <i class="bx bxl-youtube"></i>
            </a>
            <a href="#" class="me-2">
              <i class="bx bxl-linkedin"></i>
            </a>
            <a href="#" class="me-2">
              <i class="bx bxl-facebook"></i>
            </a>
            <a href="#" class="me-2">
              <i class="bx bxl-instagram"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="row text-center mt-2">
        <div class="col-12">
          <p class="text-white">
            &copy;Copyright 2022 all right reserved | Kelompok 2 Analisis
            Perancangan Sistem - PTI-C 2022
          </p>
        </div>
      </div>
    </div>
  </footer>
  <!-- End Footer -->

  <!-- ------------------------------------------------------------ -->

  <!-- Jquery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="script/script.js"></script>

  <!-- Script JS -->
  <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>

  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  <script src="script/script.js"></script>
</body>

</html>