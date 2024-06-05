<?php
session_start();

require '../../../db/function.php';

if (!isset($_SESSION["login"]) || $_SESSION["id_login"] !== "34") {
    header("location: ../../login.php");
    exit;
}


$id = $_GET["id"];

$mentor = query("SELECT * FROM mentor INNER JOIN kelas ON 
                    mentor.kode_kelas = kelas.kode_materi
                      WHERE id_mentor = '$id'")[0];
// var_dump($mentor);
if (isset($_POST["submit"])) {
    // var_dump($_POST);
    // var_dump($_FILES);
    // die;
    if (editmentor($_POST) > 0) {
        echo "<script>
        alert ('Data Mentor Berhasil Diubah');
        document.location.href = '../mentor.php';
        </script>";
    } else {
        echo "<script>
        alert ('Data Gagal Diubah');
        document.location.href = '../mentor.php';
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
    <title>Edit Mentor</title>
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
                    <a href="../mentor.php" class="d-flex justify-content-end">
                        <button type="button" class="btn-close" aria-label="Close"></button>
                    </a>
                    <h3 class="text-center mt-3">Edit Mentor</h3>
                </div>
                <!-- from -->
                <div class="col-8 my-4">
                    <!-- <h4>Informasi Awal Kelas</h4> -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" name="id_mentor" rows="3" value="<?= $mentor['id_mentor'] ?>">
                        <input type="hidden" class="form-control" name="foto_lama" rows="3" value="<?= $mentor['foto'] ?>">

                        <div class="mb-3">
                            <h6>Kelas</h6>
                            <select class="form-select" aria-label="Default select example" name="kode_kelas">
                                <option value="<?= $mentor["kode_kelas"] ?>" selected><?= $mentor["nama_kelas"] ?>
                                </option>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Mentor</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $mentor['nama_mentor'] ?>">
                        </div>

                        <div class="mb-3">
                            <label for="pekerjaan" class="form-label">Pekerjaan Mentor</label>
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="<?= $mentor['pekerjaan'] ?>">
                        </div>

                        <div class="mb-3">
                            <label for="pengalaman" class="form-label">Pengalaman</label>
                            <textarea class="form-control" id="pengalaman" name="pengalaman" rows="3"><?= $mentor['pengalaman'] ?></textarea>
                        </div>
                        <div class="mb-3">
                            <h6>Foto</h6>
                            <div class="input-group ">
                                <input type="file" class="form-control" id="foto" name="foto">
                                <label class="input-group-text" for="foto">Upload</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="instagram" class="form-label">Instagram</label>
                            <input class="form-control" id="instagram" name="instagram" rows="3" value="<?= $mentor['instagram'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="linkedin" class="form-label">LinkedIn</label>
                            <input class="form-control" id="linkedin" name="linkedin" rows="3" value="<?= $mentor['linkedIn'] ?>">
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg" name="submit">Edit Mentor</button>
                    </form>

                </div>

                <!-- end form -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>