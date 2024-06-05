<?php
session_start();

require '../../db/function.php';

if (!isset($_SESSION["login"])) {
    header("location: ../login.php");
    exit;
}

$id = $_GET["id"];

if (isset($_SESSION["login"])) {
    $id_user = $_SESSION['id_login'];
    $profile = query("SELECT * FROM login WHERE id_login = '$id_user'")[0];
}

$materi = query("SELECT * FROM materi WHERE kode_materi ='$id'");
// var_dump($materi);
$kelas = query("SELECT * FROM kelas ");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--end required-->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />

    <link rel="stylesheet" href="../../css/materi.css" />
    <!-- <link rel="stylesheet" href="../../css/main.css"> -->
    <title>Learnify-Materi-UI/UX</title>
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
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../../Assets/profile/<?= $profile['foto'] ?>" class="rounded-circle" height="22" alt="Foto" loading="lazy" />
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

    <!--accordion-->

    <div class="container accordion" id="accordionExample">
        <div class="row my-5">
            <br /><br />
            <div class="col-lg-3 text-center">
                <!-- Materi 1 -->
                <div class="accordion-item">
                    <?php foreach ($materi as $row) : ?>
                        <h2 class="accordion-header mb-2">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#materi-<?= $row['id_materi'] ?>" aria-expanded="true" aria-controls="materi-<?= $row['id_materi'] ?>">
                                Materi <?= $row['urutan'] ?>
                            </button>
                        </h2>
                    <?php endforeach ?>
                    <!-- <h2 class="accordion-header mb-2">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#materi-5" aria-expanded="false" aria-controls="materi-5">
                            Materi 5
                        </button>
                    </h2> -->
                </div>
            </div>
            <div class="col-lg-9">
                <?php foreach ($materi as $row) : ?>
                    <!-- Vid Materi 1 -->
                    <div id="materi-<?= $row['id_materi'] ?>" class="accordion-collapse collapse " data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="card card-body">
                                <div class="ratio ratio-16x9">
                                    <iframe src="<?= $row['link_materi'] ?>" class="" allowfullscreen>
                                    </iframe>
                                </div>
                                <div class="1. Pengenalan UI/UX py-3"></div>
                                <div class="d-grid gap-5 d-md-flex justify-content-arround">
                                    <h2 class="fs-7">
                                        <?= $row['urutan'] ?>.
                                        <?= $row['judul_materi'] ?>
                                    </h2>
                                </div>
                                <div class="d-grid gap-2 d-md-flex justify-content-end">
                                    <a href="#" type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#materi-2" aria-expanded="false" aria-controls="materi-2">Next</a>
                                </div>

                                <br><br>
                                <p>
                                    <?= $row['deskripsi_materi'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>

                <!-- Vid Materi 5 -->
                <!-- <div id="materi-5" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/l-6vRjEknC0" class="" allowfullscreen>
                            </iframe>
                        </div>
                        <div class="5. Prototype (Figma) py-3"></div>
                        <div class="d-grid gap-5 d-md-flex justify-content-arround">
                            <h2 class="fs-7">5. Prototype (Figma)</h2>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-end">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Tugas" data-bs-whatever="@mdo">Kirim Tugas</button>
                        </div>

                        <p>Apa itu Prototype Figma?</p>
                        <p></p>
                        <p>
                            Prototype merupakan tahapan yang ditujukan untuk mentransformasi
                            sifat-sifat abstrak dari sebuah ide menjadi lebih berwujud.
                            Prototype sangat penting dalam desain aplikasi atau desain
                            website karena dengan prototype kita dapat menguji jalannya
                            aplikasi sebelum aplikasi itu di-develop oleh programmer.
                        </p>
                    </div>
                </div> -->
            </div>
            <!-- Modal Tugas -->
            <div class="modal fade" id="Tugas" tabindex="-1" aria-labelledby="TugasLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="TugasLabel">Submit Tugas</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    Kirim link tugas yang telah diberikan oleh mentor
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Link Tugas</label>
                                    <textarea class="form-control" id="message-text"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Footer -->
    <footer class="footer bg-primary mt-5">
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
                        &copy;Copyright 2022 all right reserved | Kelompok 2 Analisis Perancangan
                        Sistem - PTI-C 2022
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>
<!--end accordion-->