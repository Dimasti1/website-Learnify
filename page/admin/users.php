<?php
session_start();
require '../../db/function.php';

if (!isset($_SESSION["login"]) || $_SESSION["id_login"] !== "34") {
  header("location: ../login.php");
  exit;
}

if (isset($_SESSION["login"])) {
  $id_user = $_SESSION['id_login'];
  $profile = query("SELECT * FROM login WHERE id_login = '$id_user'")[0];
}

$kelas = query("SELECT * FROM kelas");

$user = query("SELECT data_kelas.id_kelas,data_kelas.id_user,data_kelas.tgl_pendaftaran,
                      login.nama,login.foto,
                      kelas.nama_kelas
                      FROM data_kelas 
              INNER JOIN kelas ON data_kelas.id_kelas = kelas.id_kelas
              INNER JOIN login ON data_kelas.id_user = login.id_login");

$totaluser = query("SELECT kelas.nama_kelas, count(data_kelas.id_kelas) as total FROM kelas
                      LEFT JOIN data_kelas ON data_kelas.id_kelas = kelas.id_kelas GROUP BY kelas.id_kelas");
                      // var_dump($totaluser);die;

if (isset($_POST["cari"])) {
  // var_dump($_POST);
  // die;
  $user = cariuser($_POST["kelas"], $_POST["user"]);
}
// var_dump($user);
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Users</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
  <!-- Icon Title -->
  <link rel="icon" href="../Assets/Logo-Learnify.png" type="image/x-icon" />

  <!-- icon -->
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="../../css/kelas-profil.css" />
  <!-- <link rel="stylesheet" href="../../css/main.css" /> -->
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
      <div class="collapse navbar-collapse justify-content-end " id="navbarNavDropdown">
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

          <li class="nav-item me-4">
            <a class="nav-link" href="../about-us.php">About Us</a>
          </li>
          <?php
          if (isset($_SESSION["login"])) { ?>
            <li class="nav-item dropdown me-4">
              <a class="nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                <div class="account d-flex">
                  <img src="../../Assets/profile/<?= $profile['foto'] ?>" class="rounded-circle me-3" height="28"
                    alt="Pict" loading="lazy" />
                  <p class="dropdown-toggle">
                    <?= $_SESSION["nama"] ?>
                  </p>
                </div>

              </a>



              <ul class="dropdown-menu dropstart me-4">
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

  <div class="container">
    <div class="row grid gap-3">
      <!-- Start Sidebar fixx -->
      <div class="col-lg-3">
        <div class="sticky-top mt-4">
          <br />
          <div class="p-4 shadow-4 rounded-3 sidebar">
            <div class="">
              <h5 class="text-center">Users</h5>
              <hr />
              <div class="d-grid gap-2">
                <a href="users.php" class="d-grid gap-2">
                  <button class="btn btn-primary disabled" type="button"> <span><i class='bx bx-user'></i></span>
                    Users</button>
                </a>

                <a href="kelas.php" class="d-grid gap-2">
                  <button class="btn btn-primary " type="button"> <span><i class='bx bx-id-card'></i></span>
                    Class</button>
                </a>

                <a href="mentor.php" class="d-grid gap-2">
                  <button class="btn btn-primary " type="button"> <span><i class='bx bx-user-voice'></i></span>
                    Mentor</button>
                </a>

                <a href="tools.php" class="d-grid gap-2">
                  <button class="btn btn-primary " type="button"> <span><i class='bx bx-terminal'></i></span>
                    Tools</button>
                </a>

                <a href="materi.php" class="d-grid gap-2">
                  <button class="btn btn-primary " type="button"> <span><i class='bx bx-book-bookmark'></i></span>
                    Materi</button>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Sidebar -->

      <!-- Start Main Content -->      
      <div class="col-lg-8 mt-5">
      <div class="row">
        <?php foreach ($totaluser as $row) : ?>
          <div class="card m-2" style="width: 22.5rem;">
              <div class="card-body">
                <h5 class="card-title"><?= $row['nama_kelas']?></h5>
                <p class="card-text"><?= $row['total']?> Terdaftar</p>
              </div>
            </div>
          <?php endforeach ?>
      </div>
        <form action="" method="post">
          <div class="row mb-4 ">
            <div class="col-lg-5  ">
              <div class="row d-flex justify-content-start">
                <label for="inputState" class="form-label text-start">Filter Kelas</label>
                <div class="col-lg-12 d-flex">
                  <select class="form-select 3 me-lg-2 " aria-label="Default select example" name="kelas">
                    <option selected value="">Pilih Kelas</option>
                    <?php foreach ($kelas as $row): ?>
                      <option value="<?= $row['id_kelas'] ?>"><?= $row['nama_kelas'] ?></option>
                    <?php endforeach ?>
                  </select>

                </div>
              </div>
            </div>
            <div class="col-lg-7 justify-content-start mt-2 mt-lg-0 ">
              <div class="row d-flex ">
                <label for="inputEmail4" class="form-label">Cari User</label>
                <div class="col-lg-12 d-flex justify-content-between">

                  <input type="text" class="form-control me-2" id="inputEmail4" name="user"
                    placeholder="Masukan nama user">

                  <button class="btn btn-primary btn-md d-flex justify-content-between" type="submit" name="cari"> <span
                      class="me-2"><i class='bx bx-search'></i></span>
                    Cari</button>

                  <!-- Btn refresh -->
                  <button class="btn btn-primary btn-md d-flex ms-2"> <span class=""><i
                        class='bx bx-refresh'></i></span>

                  </button>
                </div>
              </div>
            </div>


          </div>
        </form>
        <div class="row -table">

          <div class="table" style="overflow-x:auto;">


            <table class="table table-striped table-hover">
              <tr class="text-center ">
                <th class="text-center">ID</th>
                <th class="text-center" width="100px">Profil</th>
                <th class="text-start" width="200px">Nama</th>
                <th class="text-start">Kelas</th>
                <th class="text-center">Waktu Begabung</th>

              </tr>

              <?php foreach ($user as $row): ?>
                <tr class="">
                  <td class="text-center">
                    <?= $row["id_user"] ?>
                  </td>
                  <td class="d-flex justify-content-center">
                    <img src="../../Assets/profile/<?= $row["foto"] ?>" alt="Foto" class="img-fluid w-75" />
                  </td>
                  <td class="">
                    <?= $row["nama"] ?>
                  </td>
                  <td>
                    <?= $row["nama_kelas"] ?>
                  </td>
                  <td class="text-center">
                    <?= $row["tgl_pendaftaran"] ?>
                  </td>

                </tr>
              <?php endforeach ?>

            </table>
          </div>
        </div>
        <!-- End Main Content -->
      </div>
      <!-- ------End Row Main Detail Kelas------- -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
      crossorigin="anonymous"></script>
</body>

</html>