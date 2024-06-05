<?php
session_start();

require '../../db/function.php';

$id = $_GET["id"];

if (isset($_SESSION["login"])) {
    $id_user = $_SESSION['id_login'];
    $data_kelas = mysqli_query($conn, "SELECT * FROM data_kelas WHERE (id_kelas ='$id') AND (id_user = '$id_user')");
    // var_dump($data_kelas);
    $profile = query("SELECT * FROM login WHERE id_login = '$id_user'")[0];
}

$kelasnv = query("SELECT * FROM kelas ");

$kelas = query("SELECT * FROM kelas  WHERE id_kelas= '$id'")[0];
// var_dump($kelas);
$kode = $kelas["kode_materi"];

$tools = query("SELECT * FROM tools WHERE kode_materi= '$kode'");
// var_dump($tools);

$mentor = query("SELECT * FROM mentor WHERE kode_kelas= '$kode'");
// var_dump($mentor);

$materi = query("SELECT id_materi,judul_materi,deskripsi_materi FROM materi WHERE kode_materi= '$kode'");
// var_dump($materi);

if (isset($_POST["submit"])) {

    if (mskkelas($_POST) > 0) {
        echo "<script>
        alert ('Anda Berhasil Memasuki Kelas');
        document.location.href = '../profile/kelas-saya.php';
        </script>";
    } else {
        echo "<script>
        alert ('Anda Gagal memasuki Kelas');
        document.location.href = '../../index.php';
        </script>";
    }
}

$penilaian = query("SELECT login.nama,login.foto,data_kelas.id_user,data_kelas.penilaian,data_kelas.asal_instansi 
FROM data_kelas 
INNER JOIN login 
ON data_kelas.id_user = login.id_login 
WHERE id_kelas = '$id' AND asal_instansi IS NOT NULL ");
// var_dump($penilaian);
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <!-- Modal -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icon Title -->
    <link rel="icon" href="../Assets/Logo-Learnify.png" type="image/x-icon" />
    <!-- icon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../css/detail.css">
    <link rel="stylesheet" href="../../css/main.css" />

    <title>Detail
        <?= $kelas["nama_kelas"] ?>
    </title>

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
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Course
                        </a>
                        <ul class="dropdown-menu me-4">
                            <?php
                            foreach ($kelasnv as $row):
                                ?>
                                <li>
                                    <a class="dropdown-item" href="detail.php?id=<?= $row['id_kelas'] ?>"><?= $row['nama_kelas'] ?></a>
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
                                    <img src="../../Assets/profile/<?= $profile['foto'] ?>" class="rounded-circle me-3"
                                        height="32" alt="Foto" loading="lazy" />
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
        <!-- ------Start Row Main Detail Kelas------- -->
        <div class="mt-2">
            <div class="row grid gap-3 ">

                <!-- Start Sidebar Detail Program UIUX -->
                <div class="col-lg-3 ">
                    <div class="sticky-top mt-5">
                        <br>
                        <div class="p-4 shadow-4 rounded-3 sidebar ">
                            <div class="">
                                <h5 class="text-center"> Detail Program </h5>
                                <hr>
                                <div style="font-size: smaller" class="ms-3">
                                    <a href="#tentang-program">
                                        <p> Tentang Program </p>
                                    </a>
                                    <a href="#mentor">
                                        <p> Mentor Kelas</p>
                                    </a>
                                    <a href="#kurikulum">
                                        <p> Kurikulum Program</p>
                                    </a>
                                    <a href="#tools">
                                        <p> Tools </p>
                                    </a>
                                    <a href="#testimoni">
                                        <p> Testimoni </p>
                                    </a>

                                </div>
                            </div>
                            <div class="sticky-top text-center mt-5">
                                <?php if (isset($_SESSION["login"])) {
                                    if (mysqli_fetch_assoc($data_kelas)) { ?>
                                        <a href="../profile/kelas-saya.php">
                                            <button class="btn btn-primary px-4 px-3"
                                                style="font-size: smaller; font-weight: bold;">
                                                Lihat Kelas Saya</button>
                                        </a>
                                    <?php } elseif ($id_user === "20") { ?>
                                        <!-- Kosong admin tidak boleh join kelas -->
                                    <?php } else { ?>
                                        <form action="" method="post">
                                            <input type="hidden" class="form-control" name="id_kelas" rows="3"
                                                value="<?= $id ?>">
                                            <input type="hidden" class="form-control" name="id_user" rows="3"
                                                value="<?= $_SESSION["id_login"] ?>">
                                            <button type="submit" class="btn btn-primary px-4 px-3"
                                                style="font-size: smaller; font-weight: bold;" name="submit"
                                                onclick="return confirm('Apakah Anda Yakin?')">
                                                Belajar Sekarang
                                            </button>
                                        </form>
                                    <?php }
                                } else { ?>
                                    <a href="../login.php"><button type="button" class="btn btn-primary px-4 px-3"
                                            style="font-size: smaller; font-weight: bold;" name="submit">
                                            Belajar Sekarang
                                        </button></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Sidebar Detail Program UIUX -->

                <!-- The Modal -->
                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <button type="button" class="btn-close right" data-bs-dismiss="modal"></button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="container">
                                    <div class="text-center">
                                        <h3>Memilih Kelas UI/UX Design</h3>
                                        <img src="../../Assets/done-logo.svg" alt="done-logo.svg"
                                            class="img img-fluid rounded p-5">
                                        <a href="../profile/kelas-saya.php">
                                            <button type="submit" class="btn btn-primary btn-lg col-10 mb-2">
                                                Selanjutnya
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <!-- <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div> -->
                        </div>
                    </div>
                </div>
                <!-- End The Modal -->

                <!-- Start Main Content -->
                <div class="col-lg-8 ">
                    <div class="mt-5">
                        <br>
                        <!-- Start Main Contenct Tentang Program UIUX -->
                        <div class="tentang-program mb-5" id="tentang-program">
                            <h6> Tentang Program </h6>
                            <h4> Dapatkan Kelas Gratis <span>
                                    <?= $kelas["nama_kelas"] ?>
                            </h4></span>
                            <p> Bersama Learnify anda bisa mendaftar kelas
                                <?= $kelas["nama_kelas"] ?> dengan gratis tanpa dipunggut biaya sedikitpun.
                            </p>
                            <p>
                                <?= $kelas["detail_program"] ?>
                            </p>
                            <p>Dengan arahan mentor, kali ini kita akan belajar bagaimana langkah awal dalam memulai
                                sebagai
                                <?= $kelas["nama_kelas"] ?> yang baik dan benar, serta dengan cara yang mudah dipahami
                                oleh pemula.
                            </p>
                        </div>
                        <!-- End Main Contenct Tentang Program UIUX -->

                        <!-- Start Mentor Kelas UIUX -->
                        <div class="mentor-kelas my-5" id="mentor">
                            <h6> Mentor Kelas </h6>
                            <h4> Belajar Langsung Dari Ahlinya </h4>
                            <p> Anda akan belajar langsung dari mentor yang ahli dalam bidang
                                <?= $kelas["nama_kelas"] ?>
                            </p>
                            <?php foreach ($mentor as $row): ?>
                                <div class="row mb-5">
                                    <div class="col-lg-4">
                                        <img src="../../Assets/<?= $row["foto"] ?>" alt="mentor-ui-ux"
                                            class="img img-fluid rounded">
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="text-mentor">
                                            <h5 class="fw-bold">
                                                <?= $row["nama_mentor"] ?>
                                            </h5>
                                            <p class="fw-bold"> <span>
                                                    <?= $row["pekerjaan"] ?>
                                                </span> </p>
                                            <p>
                                                <?= $row["pengalaman"] ?>
                                            </p>
                                        </div>
                                        <div class="d-flex">
                                            <a href="<?= $row["instagram"] ?>" target="_blank"><img
                                                    src="../../Assets/instagram.svg" alt=""></a>
                                            <a href="<?= $row["linkedIn"] ?>" target="_blank"><img
                                                    src="../../Assets/linkedin.svg" alt=""></a>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach ?>
                        </div>
                        <!-- End Mentor Kelas UIUX -->

                        <!-- Start Kurikulum Program -->
                        <div class="kurikulum-program mb-5" id="kurikulum">
                            <h6> Kurikulum Program </h6>
                            <h4> Dapatkan Skill Baru Bersama <span> Learnify </h4></span>
                            <p> Kurikulum yang tersedia telah disesuaikan dengan kebutuhan saat ini yang akan selalu
                                update dengan
                                perkembangan, anda akan mempelajari materi dibawah ini </p>
                            <!-- Start Accordion -->
                            <div class="accordion" id="accordionExample">
                                <?php foreach ($materi as $row): ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading<?= $row["id_materi"]; ?>">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse<?= $row["id_materi"]; ?>" aria-expanded="true"
                                                aria-controls="collapse<?= $row["id_materi"]; ?>">
                                                <?= $row["judul_materi"]; ?>
                                            </button>
                                        </h2>
                                        <div id="collapse<?= $row["id_materi"]; ?>" class="panel-collapse collapse **in**"
                                            aria-labelledby="heading<?= $row["id_materi"]; ?>"
                                            data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <?= $row["deskripsi_materi"]; ?><br>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?><br>
                                <!-- End Accordion -->
                            </div>
                            <!-- End Kurikulum Program -->

                            <!-- Start Tools UIUX -->
                            <div class="tools-uiux mb-5" id="tools">
                                <h6> Tools </h6>
                                <h4> Belajar
                                    <?= $kelas["nama_kelas"] ?> dengan Tools Gratis
                                </h4>
                                <p> Pada sesi pembelajaran pelatihan menggunakan software yang gratis dan mudah
                                    digunakan secara
                                    bersama-sama.
                                </p>

                                <div class="d-flex align-items-center align-self-center">
                                    <?php foreach ($tools as $row): ?>
                                        <div class="d-flex align-items-center me-5">
                                            <a href="<?= $row["link_tools"] ?>" target="_blank"><img
                                                    src="../../Assets/<?= $row["gambar_tools"] ?>" class="img w-75"></a>
                                            <p class="ms-2">
                                                <?= $row["nama_tools"] ?>
                                            </p>
                                        </div>
                                    <?php endforeach ?>
                                </div>


                            </div>
                            <!-- End Tools UIUX -->

                            <!-- Start Testimoni -->
                            <div class="testimoni mb-5" id="testimoni">
                                <h6> Testimoni </h6>
                                <h4> Kata Mereka tentang Kelas
                                    <?= $kelas["nama_kelas"] ?> Learnify
                                </h4>
                            </div>
                            <div class="row">
                                <div class="col-12 testimoni">
                                    <!-- Swiper -->

                                    <di class="swiper mySwiperTesti pb-4 pb-sm-5">
                                        <div class="swiper-wrapper"
                                            style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">

                                            <!-- Card Start -->
                                            <?php foreach ($penilaian as $row): ?>
                                                <div class="swiper-slide card p-2">
                                                    <div class="card-body">
                                                        <p class="body-testi mt-3">
                                                            <?= $row["penilaian"] ?>
                                                        </p>
                                                        <div
                                                            class="detail d-flex justify-content-between align-items-center mt-4">
                                                            <div class="user d-flex align-items-center">
                                                                <img src="../../Assets/profile/<?= $row["foto"] ?>"
                                                                    alt="avatar-review-1"
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
                                            <!-- Card End -->



                                        </div>
                                        <div class="swiper-pagination pt-5 myt-5"></div>
                                </div>

                            </div>
                        </div>
                        <!-- End Testimoni -->


                        <!-- End Main Content -->
                    </div>
                </div>
                <!-- ------End Row Main Detail Kelas------- -->
            </div>
        </div>
    </div>

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
                            <i class='bx bx-map me-2'></i>
                            <p>
                                Jl. Ketintang, Kel. Ketintang, Kec. Gayungsari, Kota Surabaya
                            </p>
                        </a>
                        <a href=" 
                        #" class="d-flex align-items-start">
                            <i class='bx bx-envelope me-2'></i>

                            <p>
                                learnify@gmail.com
                            </p>
                        </a>

                        <a href=" 
                        #" class="d-flex align-items-start">
                            <i class='bx bx-phone me-2'></i>

                            <p>
                                +62 821 4271 4527
                            </p>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1  col-md-6 mt-4 mt-sm-0 mb-sm-4">
                    <h3>Informasi</h3>
                    <div class="row d-flex mt-3">
                        <a href="#" class="mb-1">Home</a>
                        <a href="#" class="mb-1">About Us</a>
                    </div>

                </div>
                <div class="col-lg-2 offset-lg-1   col-md-6 mt-4 mt-sm-0 mb-sm-4">
                    <h3>Course</h3>
                    <div class="row d-flex mt-3">
                        <a href="#" class="mb-1">UI/UX Design</a>
                        <a href="#" class="mb-1">Front End Developer</a>
                        <a href="#" class="mb-1">Back End Developer</a>
                    </div>

                </div>
                <div class="col-lg-2 offset-lg-1   col-md-6 mt-4 mt-sm-0">
                    <h3>Ikuti Kami</h3>
                    <div class="sosmed mt-3 d-flex">
                        <a href=" #" class="me-2">
                            <i class='bx bxl-google'></i>
                        </a>
                        <a href="# " class="me-2">
                            <i class='bx bxl-youtube'></i>
                        </a>
                        <a href="#" class="me-2">
                            <i class='bx bxl-linkedin'></i>
                        </a>
                        <a href="#" class="me-2">
                            <i class='bx bxl-facebook'></i>
                        </a>
                        <a href="#" class="me-2">
                            <i class='bx bxl-instagram'></i>
                        </a>

                    </div>
                </div>

            </div>
            <div class="row text-center mt-2">
                <div class="col-12">
                    <p class="text-white">
                        &copy;Copyright 2022 all right reserved | Kelompok 2 Analisis Perancangan Sistem - PTI-C 2022
                    </p>
                </div>
            </div>
        </div>

    </footer>
    <!-- End Footer -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="../../script/script.js"></script>
    <!-- Modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>