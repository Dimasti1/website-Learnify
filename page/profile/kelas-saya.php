<?php
session_start();

require '../../db/function.php';

if (!isset($_SESSION["login"])) {
  header("location: ../login.php");
  exit;
}

$kelas = query("SELECT * FROM kelas");

if (isset($_SESSION["login"])) {
  $id_user = $_SESSION['id_login'];
  // $data_kelas = mysqli_query($conn, "SELECT * FROM data_kelas WHERE (id_kelas ='$id') AND (id_user = '$id_user')");
  // var_dump($data_kelas);
  $profile = query("SELECT * FROM login WHERE id_login = '$id_user'")[0];
  $kelas_saya = query("SELECT * FROM data_kelas INNER JOIN kelas
  ON data_kelas.id_kelas = kelas.id_kelas WHERE id_user ='$id_user'");
  // var_dump($kelas_saya);
}

if (isset($_POST["submit"])) {
  if (tmbhnilai($_POST) > 0) {
    echo "<script>
          alert('user baru berhasil ditambahkan');    
    </script>";
    header("location: kelas-saya.php");
  } else {
    echo mysqli_error($conn);
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
  <!-- Icon Title -->
  <link rel="icon" href="../../Assets/Logo-Learnify.png" type="image/x-icon" />

  <!-- icon -->
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="../../css/kelas-profil.css" />
  <!-- <link rel="stylesheet" href="../../css/main.css" /> -->
  <title>Profile Akun</title>
</head>

<body>
  <!-- Start Navbar -->
  <nav class="navbar navbar-expand-lg bg-light shadow-sm bg-body rounded">
    <div class="container">
      <a class="navbar-brand" href="../../index.php">
        <img src="../../Assets/Logo-Learnify.png" alt="Logo" width="30" height="24"
          class="d-inline-block align-text-top">
        Learnify
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item me-4">
            <a class="nav-link active" aria-current="page" href="../../index.php">Home</a>
          </li>
          <li class="nav-item dropdown me-4">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Course
            </a>
            <ul class="dropdown-menu me-4">
              <?php
              foreach ($kelas as $row):
                ?>
                <li>
                  <a class="dropdown-item" href="../detail/detail.php?id=<?= $row['id_kelas'] ?>"><?= $row['nama_kelas'] ?></a>
                </li>
              <?php endforeach ?>
            </ul>
          </li>
          <!-- <li class="nav-item me-4">
                    <a class="nav-link" href="#">Blog</a>
                </li> -->
          <li class="nav-item me-4">
            <a class="nav-link" href="../about-us.php">About Us</a>
          </li>
          <?php
          if (isset($_SESSION["login"])) { ?>
            <li class="nav-item dropdown me-4">
              <a class="nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                <div class="account d-flex">
                  <img src="../../Assets/profile/<?= $profile['foto'] ?>" class="rounded-circle me-3" height="32"
                    alt="Foto" loading="lazy" />
                  <p class="dropdown-toggle">
                    <?= $_SESSION["nama"] ?>
                  </p>
                </div>

              </a>
              <ul class="dropdown-menu me-4">
                <li>
                  <a class="dropdown-item" href="../profile/profile.php">My profile</a>
                </li>
                <li>
                  <a class="dropdown-item" href="../profile/kelas-saya.php">Kelas Saya</a>
                </li>
                <hr />
                <li>
                  <a class="dropdown-item" href="../logout.php">Logout</a>
                </li>
              </ul>
            </li>
          <?php } else { ?>
            <a href="../login.php" class="btn btn-sm btn-outline-primary px-4 mx-lg-2 mb-2 mb-md-0">
              Masuk
            </a>
            <a href="../regist.php" class="btn btn-sm btn-primary px-4 mx-lg-2">Daftar</a>
          <?php } ?>
        </ul>


      </div>
    </div>
  </nav>
  <!-- End Navbar -->

  <div class="container mb-5">
    <!-- ------Start Row Main Detail Kelas------- -->
    <div class="container">
      <div class="row grid gap-3">
        <!-- Start Sidebar Detail Program BE -->
        <div class="col-lg-3">
          <div class="sticky-top mt-4">
            <br />
            <div class="p-4 shadow-4 rounded-3 sidebar">
              <div class="">
                <h5 class="text-center">
                  <?= $profile["nama"] ?>
                </h5>
                <hr />
                <div style="font-size: smaller" class="ms-3">
                  <a href="kelas-saya.php">
                    <p>Kelas Saya</p>
                  </a>
                  <a href="profile.php">
                    <p>Setting Akun</p>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Sidebar Detail Program BE -->

        <!-- Start Main Content -->
        <div class="col-lg-8 container-product">
          <div class="row mt-5">
            <?php
            foreach ($kelas_saya as $row):
              ?>
              <div class="col-lg-5 col-md-6 mb-4">
                <div class="card">
                  <div class="img-box">
                    <img src="../../Assets/<?= $row["gambar_kelas"] ?>" alt="" class="img-fluid" />
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

                      <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#exampleModal" data-bs-whatever="@mdo">Beri Penilaian</button>


                      <a href="../materi/materi.php?id=<?= $row["kode_materi"] ?>"><button type="button"
                          class="btn btn-primary btn-sm">
                          Lihat Kelas
                        </button>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Start Pop Up Modal Penilaian  -->
              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Berikan Penilaian Kelas</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <input type="hidden" value="<?= $row["id_data_kelas"] ?>" name="id">
                        <div class="mb-3">
                          <label for="asal_instansi" class="col-form-label">Asal Instansi:</label>
                          <input type="text" class="form-control" id="asal_instansi" name="asal_instansi">
                        </div>
                        <div class="mb-3">
                          <label for="message-text" class="col-form-label">Review Kelas</label>
                          <textarea class="form-control" id="message-text" name="penilaian"></textarea>
                          <p class="mt-1">*Maksimal 15 Kata</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" name="submit" class="btn btn-primary">Kirim Penilaian</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            <?php endforeach ?>
          </div>
        </div>
        <!-- ------End Row Main Detail Kelas------- -->
      </div>
    </div>
  </div>



  <!-- Start Pop Up Modal Penilaian  -->

  <!-- Start Footer -->
  <footer class="footer bg-primary mt-5">
    <div class="container pt-5">
      <div class="row mb-3 d-flex align-items-center">
        <a class="navbar-brand fs-4 fw-semibold d-flex align-items-center me-3" href="/index.php">
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

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="script/script.js"></script>

  <!-- Script JS -->
  <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
</body>

</html>