<?php
session_start();

if (isset($_SESSION["login"])) { // jika sudah memiliki data session login maka
  header("location: ../index.php");
  exit;
}

require '../db/function.php';

if (isset($_POST["masuk"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  // mengecek apakah ada username yang sama didatabse
  $result = mysqli_query($conn, "SELECT * FROM login WHERE username = '$username'");

  // mysqli_num_rows($result) melakukan pengecekan dalam databse kalau ada >1
  if (mysqli_num_rows($result) === 1) {
    // cek password
    $row = mysqli_fetch_assoc($result);

    // cek apakah string yang dimasukkan lalu diacak, sama dengan string yang sudah diacak di database
    if (password_verify($password, $row["password"])) {
      //set session
      $_SESSION["login"] = true; // menyimpan data sesssion login untuk semua halaman
      $_SESSION["id_login"] = $row["id_login"];
      $_SESSION["nama"] = $row["nama"];


      if ($row["id_login"] != "34") {
        header("location: ../index.php");
      } else {
        header("location: admin/users.php");
      }
      exit;
    } else {
      echo "<script>
            alert('Salah Password');
            document.location.href = 'login.php';    
      </script>";
    }
  }
  $error = true;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
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
            <a href="#" class="d-flex align-items-center link-underline-opacity-0">
              <img src="../Assets/Logo-Learnify.png" alt="Logo" width="40" height="32"
                class="d-inline-block align-text-center" />
              <p class="mt-1 fw-bold ">Learnify</p>
            </a>

            <h5 class="mt-3">
              Selamat Datang Kembali 👋<i class="fas fa-hand-paper"></i>
            </h5>
            <h3 class="fw-bold">Login Untuk Belajar Lagi</h3>
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
              <div class="mb-3 mt-3">
                <h5 class="fw-bold">Masuk Ke Akun Anda</h5>
              </div>
              <div class="mb-3 mt-3">
                <label for="username" class="form-label">Username</label>
                <input type="username" class="form-control" id="username" placeholder="Masukan Username"
                  name="username" />
              </div>
              <!-- <div class="mb-3 mt-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Masukan Email" name="email" />
              </div> -->
              <div class="mb-3 mt-3">
                <label for="pswd" class="form-label">Password</label>
                <input type="password" class="form-control" id="pswd" placeholder="Masukan Password" name="password" />
              </div>
              <div class="mb-3 mt-4">
                <button type="submit" class="btn btn-primary btn-lg col-12" name="masuk">
                  Masuk
                </button>
              </div>
              <div class="mt-3">
                <p class="text-center">
                  Anda Belum Memiliki Akun? <a href="regist.php">Daftar</a>
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