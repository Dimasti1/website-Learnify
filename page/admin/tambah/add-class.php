<?php
session_start();

require '../../../db/function.php';

if (!isset($_SESSION["login"]) || $_SESSION["id_login"] !== "34") {
    header("location: ../../login.php");
    exit;
}

if (isset($_POST["submit"])) {
    if (tmbhkls($_POST) > 0) {
        echo "<script>
              alert('user baru berhasil ditambahkan'); 
              document.location.href = '../kelas.php';   
        </script>";
    } else {
        echo mysqli_error($conn);
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Kelas</title>
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
                    <a href="../kelas.php" class="d-flex justify-content-end">
                        <button type="button" class="btn-close" aria-label="Close"></button>
                    </a>
                    <h3 class="text-center mt-3">Buat Kelas Baru</h3>
                </div>

                <!-- from -->

                <div class="col-8 my-4">
                    <form action="" method="post" enctype="multipart/form-data">
                        <h4>Informasi Awal Kelas</h4>
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukan nama kelas">
                        </div>
                        <div class="mb-3">
                            <label for="detail" class="form-label">Detail Awal</label>
                            <input type="text" class="form-control" id="detail" name="detail" placeholder="Masukan sedikit detail awal kelas">
                        </div>
                        <div class="mb-3">
                            <h6>Thumbnail</h6>
                            <div class="input-group ">
                                <input type="file" class="form-control" id="tmbnail" name="foto">
                                <label class="input-group-text" for="tmbnail">Upload</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="dtl_kls" class="form-label">Detail Kelas</label>
                            <textarea type="text" class="form-control" id="dtl_kls" name="detail_kelas" placeholder="Masukan sedikit detail awal kelas"> </textarea>
                        </div>
                        <div class="mb-3">
                            <label for="kode_kls" class="form-label">Kode Kelas</label>
                            <input type="text" class="form-control" id="kode_kls" name="kode_kelas" placeholder="Masukan kode kelas">
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg" name="submit">Buat Kelas</button>
                    </form>
                </div>

                <!-- end form -->
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>