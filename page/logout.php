<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();
echo "<script>
            alert('Anda berhasil Logout');
            document.location.href = '../index.php';    
      </script>";

exit;
