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

$tools = query("SELECT tools.id_tools,tools.gambar_tools, tools.nama_tools, tools.link_tools,
              kelas.nama_kelas
             FROM tools INNER JOIN kelas ON tools.kode_materi = kelas.kode_materi");
// var_dump($tools);
if (isset($_POST["cari"])) {
  // var_dump($_POST);
  // die;
  $tools = caritools($_POST["kelas"]);
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tools</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
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
        <img src="../../Assets/Logo-Learnify.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
        Learnify
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
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
              foreach ($kelas as $row) :
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
                  <img src="../../Assets/profile/<?= $profile['foto'] ?>" class="rounded-circle me-3" height="32" alt="Pict" loading="lazy" />
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

  <div class="container">
    <div class="row grid gap-3">
      <!-- Start Sidebar fixx -->
      <div class="col-lg-3">
        <div class="sticky-top mt-4">
          <br />
          <div class="p-4 shadow-4 rounded-3 sidebar">
            <div class="">
              <h5 class="text-center">Tools</h5>
              <hr />


              <div class="d-grid gap-2">
                <a href="users.php" class="d-grid gap-2">
                  <button class="btn btn-primary " type="button"> <span><i class='bx bx-user'></i></span> Users</button>
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
                  <button class="btn btn-primary disabled " type="button"> <span><i class='bx bx-terminal'></i></span>
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
        <div class="row text-md-end mb-3 mb-sm-2">
          <a href="tambah/add-tools.php ">
            <button class="btn btn-primary btn-md"><span><i class='bx bx-plus'></i></span> Tambah Tools</button>
          </a>
        </div>
        <div class="row add-class  d-md-flex text-md-end mb-lg-4 mb-sm-4">
          <form action="" method="post">
            <div class="col">

              <!-- Filter end Btn add -->
              <div class="row d-flex justify-content">
                <label for="inputState" class="form-label text-start">Filter Kelas</label>
                <div class="col-lg-7 d-flex">
                  <select class="form-select 3 me-lg-2 me-2" aria-label="Default select example" name="kelas">
                    <option selected value=" ">Pilih Kelas</option>
                    <?php foreach ($kelas as $row) : ?>
                      <option value="<?= $row['id_kelas'] ?>"><?= $row['nama_kelas'] ?></option>
                    <?php endforeach ?>
                  </select>

                  <button class="btn btn-primary btn-md d-flex" type="submit" name="cari"> <span class="me-2"><i class='bx bx-filter'></i></span>
                    Filter</button>
                  <!-- Btn refresh -->
                  <button class="btn btn-primary btn-md d-flex ms-2"> <span class=""><i class='bx bx-refresh'></i></span>
                </div>
              </div>
          </form>
        </div>

        <!-- Tabel -->
        <div class="row -table mt-4">

          <div class="table" style="overflow-x:auto;">
            <table class="table table-striped table-hover align-middle">
              <tr>
                <th class="text-center" width="100px">ID</th>
                <th class="text-start" width="300px">Nama Kelas</th>
                <th class="text-center" width="500px">Icon</th>
                <th width="300px">Nama Tools</th>
                <th class="text-center" width="400px">Link</th>
                <th class="text-center" width="300px">Tindakan</th>

              </tr>
              <?php foreach ($tools as $row) : ?>
                <tr>
                  <td class="text-center">
                    <?= $row["id_tools"] ?>
                  </td>
                  <td class="text-start">
                    <?= $row["nama_kelas"] ?>
                  </td>
                  <td class="text-center">
                    <img src="../../Assets/<?= $row["gambar_tools"] ?>" alt="Tools" class="rounded w-50" />
                  </td>
                  <td class="text-center">
                    <?= $row["nama_tools"] ?>
                  </td>
                  <td class="text-center">
                    <i><a href="<?= $row["link_tools"] ?>">Download</a></i>
                  </td>
                  <td class="text-center">
                    <div class="d-flex">
                      <a href="edit/edit-tools.php?id=<?= $row["id_tools"] ?>" type="button" class="btn btn-primary btn-sm me-2">Edit</a>
                      <a href="hapus/hapus-tools.php?id=<?= $row["id_tools"] ?>" type="button" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin Menghapus data ini?')">Hapus</a>

                    </div>
                  </td>
                <?php endforeach ?>
                </tr>

                <tr>

                </tr>
            </table>
          </div>
        </div>

        <!-- End Tabel -->

      </div>
    </div>
  </div>


  <!-- End Main Content -->
  </div>
  <!-- ------End Row Main Detail Kelas------- -->
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>