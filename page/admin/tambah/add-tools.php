<?php
session_start();

require '../../../db/function.php';

if (!isset($_SESSION["login"]) || $_SESSION["id_login"] !== "34") {
    header("location: ../../login.php");
    exit;
}

if (isset($_POST["submit"])) {
    // var_dump($_POST);
    // var_dump($_FILES);
    // die;
    if (tmbhtools($_POST) > 0) {
        echo "<script>
              alert('user baru berhasil ditambahkan');  
              document.location.href = '../tools.php';     
        </script>";
    } else {
        echo mysqli_error($conn);
    }
}
$kelas = query("SELECT nama_kelas,kode_materi FROM kelas")
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Mentor</title>
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
                    <a href="../tools.php" class="d-flex justify-content-end">
                        <button type="button" class="btn-close" aria-label="Close"></button>

                    </a>
                    <h3 class="text-center mt-3">Tambah Tools</h3>
                </div>
                <!-- from -->
                <div class="col-8 my-4">
                    <!-- <h4>Informasi Awal Kelas</h4> -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <h6>Pilih Kelas</h6>
                            <select class="form-select" aria-label="Default select example" name="kode_kelas">
                                <option selected>Pilih Kelas</option>
                                <?php foreach ($kelas as $row) : ?>
                                    <option value="<?= $row["kode_materi"] ?>"><?= $row["nama_kelas"] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <h6>Icon Tools</h6>
                            <div class="input-group ">
                                <input type="file" class="form-control" id="icon" name="foto">
                                <label class="input-group-text" for="icon">Upload</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Tools</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan pekerjaan mentor">
                        </div>

                        <div class="mb-3">
                            <label for="link" class="form-label">Link</label>
                            <textarea class="form-control" id="link" rows="3" name="link"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary btn-lg">Tambah Tools</button>
                    </form>
                </div>

                <!-- end form -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>