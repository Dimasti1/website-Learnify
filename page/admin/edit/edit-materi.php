<?php
session_start();

require '../../../db/function.php';

$id = $_GET["id"];

if (!isset($_SESSION["login"]) || $_SESSION["id_login"] !== "34") {
    header("location: ../../login.php");
    exit;
}

$materi = query("SELECT * FROM materi INNER JOIN kelas ON 
                    materi.kode_materi = kelas.kode_materi
                      WHERE id_materi = '$id'")[0];
// var_dump($materi);

if (isset($_POST["submit"])) {
    // var_dump($_POST);
    // var_dump($_FILES);
    // die;
    if (editmateri($_POST) > 0) {
        echo "<script>
              alert('Data Berhasil Diubah');  
              document.location.href = '../materi.php';     
        </script>";
    } else {
        echo "<script>
        alert ('Data Gagal Diubah');
        document.location.href = '../materi.php';
        </script>";
    }
}
$kelas = query("SELECT nama_kelas,kode_materi FROM kelas")
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Materi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <!-- Icon Title -->
    <link rel="icon" href="../Assets/logo-icon.svg" type="image/x-icon" />

    <!-- icon -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="../../css/kelas-profil.css" />
    <!-- <link rel="stylesheet" href="../../css/main.css" /> -->
</head>

<body>
    <div class="container  mt-5">
        <div class="col-12">
            <div class="row content d-flex justify-content-center">
                <div class="col-lg-8">
                    <a href="../materi.php" class="d-flex justify-content-end">
                        <!-- <img src="../../../Assets/x-circle.svg" alt="" class="h-50" /> -->
                        <button type="button" class="btn-close" aria-label="Close"></button>
                    </a>
                    <h3 class="text-center mt-3">Edit Materi</h3>
                </div>
                <!-- from -->
                <div class="col-8 my-4">
                    <!-- <h4>Informasi Awal Kelas</h4> -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" name="id_materi" rows="3" value="<?= $materi['id_materi'] ?>">

                        <div class="mb-3">
                            <h6>Kelas</h6>
                            <select class="form-select" aria-label="Default select example" name="kode_kelas">
                                <option value="<?= $materi["kode_materi"] ?>" selected><?= $materi["nama_kelas"] ?>
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="urutan" class="form-label">Urutan Materi</label>
                            <input type="text" class="form-control" id="urutan" name="urutan" value="<?= $materi["urutan"] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Materi</label>
                            <input type="text" class="form-control" id="judul" name="judul" value="<?= $materi["judul_materi"] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea type="text" class="form-control" id="deskripsi" rows="3" name="deskripsi"><?= $materi["deskripsi_materi"] ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="link_materi" class="form-label">Link</label>
                            <input type="text" class="form-control" id="link_materi" name="link_materi" value="<?= $materi["link_materi"] ?>">

                            <!-- <textarea class="form-control" id="link_materi" rows="3"
                                    name="link_materi"><?= $materi["link_materi"] ?></textarea> -->
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg" name="submit">Edit Materi</button>
                    </form>
                </div>

                <!-- end form -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>