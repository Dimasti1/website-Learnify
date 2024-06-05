<?php
session_start();

require '../../../db/function.php';

$id = $_GET["id"];

if (!isset($_SESSION["login"]) || $_SESSION["id_login"] !== "34") {
    header("location: ../../login.php");
    exit;
}

if (hapustools($id) > 0) { // Jika function hapus ber nilai >0 maka sukses <0 gagal
    echo "<script>
        alert ('Data berhasil Dihapus');
        document.location.href = '../tools.php';
         </script>";
} else {
    echo "<script>
        alert ('Data Gagal Dihapus');
        document.location.href = '../tools.php';
        </script>";
}
