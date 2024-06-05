<!DOCTYPE html>
<html lang="en">

<?php
require '../db/function.php';

if (isset($_POST["register"])) {
  if (registrasi($_POST) > 0) {
    echo "<script>
            alert('user baru berhasil ditambahkan');
            document.location.href = 'login.php';    
      </script>";
  } else {
    echo mysqli_error($conn);
  }
}
?>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Regist</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <link rel="icon" href="../Assets/Logo-Learnify.png" type="image/x-icon" />
  <!-- My Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <!-- <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet"> -->
  <!-- My CSS -->
  <link rel="stylesheet" href="../css/login-regis.css" />
</head>

<body>
  <div class="container-login-regis">
    <div class="container container-hero d-flex justify-content-center align-items-center">
      <div class="row d-flex justify-content-center align-items-center">
        <!-- Left Side -->
        <div class="col-md-6 justify-content-center left-side">
          <div class="container p-5">
            <a href="#" class="d-flex align-items-center">
              <img src="../Assets/Logo-Learnify.png" alt="Logo" width="40" height="32"
                class="d-inline-block align-text-center" />
              <p class="mt-1 fw-bold">Learnify</p>
            </a>

            <h5 class="mt-3">
              Selamat Datang 👋<i class="fas fa-hand-paper"></i>
            </h5>
            <h3 class="fw-bold">Daftar Untuk Belajar Skill Baru</h3>
            <img class="img-fluid" src="../Assets/Hero 1.svg" alt="" class="justify-content-center" />
          </div>
        </div>

        <!-- ENd Left Side -->
        <!-- Right Side -->
        <div class="col-md-5 justify-content-center right-side py-lg-2 px-lg-5 rounded mb-sm-3 mt-lg-2">
          <div class="container">
            <form action="" method="post">
              <div class="mb-0 mt-3 d-flex justify-content-end">
                <a href="../index.php">
                  <button type="button" class="btn-close" aria-label="Close"></button>
                </a>
              </div>
              <div class="mb-0 mt-2">
                <h5 class="fw-bold">Buat Akun Anda</h5>
              </div>
              <div class="mb-0 mt-2">
                <label for="nama" class="form-label">Nama</label>
                <input type="nama" class="form-control" id="nama" placeholder="Masukan Nama Anda" name="nama" />
              </div>
              <div class="mb-0 mt-2">
                <label for="username" class="form-label">Username</label>
                <input type="username" class="form-control" id="username" placeholder="Masukan Username"
                  name="username" />
              </div>
              <div class="mb-0 mt-2">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Masukan Email" name="email" />
              </div>
              <div class="mb-0 mt-2">
                <label for="pwd" class="form-label">Password</label>
                <input type="password" class="form-control" id="pwd" placeholder="Masukan Password" name="password" />
              </div>
              <div class="mb-0 mt-2">
                <label for="pwd" class="form-label">Konfirmasi Ulang Passsword</label>
                <input type="password" class="form-control" id="pwd" placeholder="Masukan Password" name="password2" />
              </div>
              <div class="mb-0 mt-4">
                <button type="submit" class="btn btn-primary btn-lg col-12" name="register">
                  Daftar
                </button>
              </div>
              <div class="mt-3">
                <p class="text-center">
                  Anda Sudah Memiliki Akun? <a href="login.php">Masuk</a>
                </p>
              </div>
            </form>
          </div>
        </div>
        <!-- ENd Right Side -->
      </div>
    </div>
  </div>
</body>

</html>