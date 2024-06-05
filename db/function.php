<?php
$conn = mysqli_connect("localhost", "root", "", "digiskill");

// function untuk query data kedalam sebuah row
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    // var_dump($rows);
    return $rows;
    if (!$result) {
        echo mysqli_error($conn);
    }
}

// function tambah data login atau registrasi
function registrasi($data)
{
    global $conn;

    // strtolower() berfungsi untuk membuat huruf menjadi kecil
    // stripslashes() untuk menghapus karakter backslas
    $nama = $data["nama"];
    $username = strtolower(stripslashes($data["username"]));
    $email = mysqli_real_escape_string($conn, $data["email"]);
    // mysqli_real_escape_string() memasukkan simbol" dengan aman
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM login WHERE username = '$username'");


    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert ('Username Sudah Terdaftar');
        </script>";
        return false;
    }

    // cek apakah password 1 dan 2 sama?
    if ($password !== $password2) {
        echo "<script>
        alert ('Konfirmasi Password tidak sesuai');
        </script>";
        return false;
    }
    // encrypsi password mengacak string menjadi hash atau acak
    $password = password_hash($password, PASSWORD_DEFAULT);

    // menambahkan user baru kedalam database
    $query = "INSERT INTO login VALUES('','$nama','$username','$email','$password','','647430197ece6.png','','','')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

////////////////function untuk edit profile login
function editprofile($data)
{
    global $conn;
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $username = htmlspecialchars($data["username"]);
    $email = htmlspecialchars($data["email"]);
    $no_telp = htmlspecialchars($data["no_telp"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $provinsi = htmlspecialchars($data["provinsi"]);
    $kota = htmlspecialchars($data["kota"]);
    $password = htmlspecialchars($data["password"]);
    $fotolama = htmlspecialchars($data["foto_lama"]);

    //cek apakah user pilih gambar baru atau tidak
    if ($_FILES['foto']['error'] === 4) {
        $foto = $fotolama;
    } else {
        if ($fotolama === "647430197ece6.png") {
            $foto = editprof();
        } else {
            $tempat = "../../Assets/profile/" . $fotolama;
            unlink($tempat);
            $foto = editprof();
        }
    }

    // hapus dlu lalu simpan data baru
    // 
    // 
    // var_dump($tempat);
    // die;
    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "UPDATE login SET
            nama = '$nama',
            username = '$username',
            email = '$email',
            password = '$password',
            nomor_hp = '$no_telp',
            foto = '$foto',
            alamat = '$alamat',
            provinsi = '$provinsi',
            kota = '$kota'
            WHERE id_login = $id
        ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
// edit gambar profile
function editprof()
{
    $namafile = $_FILES['foto']['name'];
    $ukuranfile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpname = $_FILES['foto']['tmp_name'];

    // cek apakah ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
        alert ('Pilih Gambar terlebih dahulu');
        </script>";
        return false;
    }

    // cek yang diupload ekstensinya apkah gambar atau bukan
    $ekstensigambarValid = ['jpg', 'png', 'jpeg'];
    $ekstensigambar = explode('.', $namafile); // sebagai pemisah antara nama file dengan ekstensi
    //  contohnya ferdy.png maka menjadi ['ferdy','png']
    $ekstensigambar = strtolower(end($ekstensigambar)); // strtolower merubah nama file menjadi lowercase/ huruf kecil
    // end mengambil explode yang paling akhir

    if (!in_array($ekstensigambar, $ekstensigambarValid)) { // melakukan pengecekan string didalam array
        // fungsi ini menghasilkan true jika ada false jika tidak
        echo "<script>
        alert ('Yang anda upload bukan gambar');
        </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if ($ukuranfile > 5000000000) { //dalam bentuk byte
        echo "<script>
        alert ('file yang anda upload terlalu besar');
        </script>";
        return false;
    }

    //lolos pengecekan gambar siap diupload

    // generate nama gambar random baruu
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensigambar;

    // mengirim kedalam directory 
    move_uploaded_file($tmpname, '../../Assets/profile/' . $namafilebaru);

    return $namafilebaru; // untuk diproses dalam function tambah sebagai nama file yang disimpan

}


////////////////function untuk upload gambar profile yang disimpan ke dalam profile
// function upload()
// {
//     $namafile = $_FILES['foto']['name'];
//     $ukuranfile = $_FILES['foto']['size'];
//     $error = $_FILES['foto']['error'];
//     $tmpname = $_FILES['foto']['tmp_name'];

//     // cek apakah ada gambar yang diupload
//     if ($error === 4) {
//         echo "<script>
//         alert ('Pilih Gambar terlebih dahulu');
//         </script>";
//         return false;
//     }

//     // cek yang diupload ekstensinya apkah gambar atau bukan
//     $ekstensigambarValid = ['jpg', 'png', 'jpeg'];
//     $ekstensigambar = explode('.', $namafile); // sebagai pemisah antara nama file dengan ekstensi
//     //  contohnya ferdy.png maka menjadi ['ferdy','png']
//     $ekstensigambar = strtolower(end($ekstensigambar)); // strtolower merubah nama file menjadi lowercase/ huruf kecil
//     // end mengambil explode yang paling akhir

//     if (!in_array($ekstensigambar, $ekstensigambarValid)) { // melakukan pengecekan string didalam array
//         // fungsi ini menghasilkan true jika ada false jika tidak
//         echo "<script>
//         alert ('Yang anda upload bukan gambar');
//         </script>";
//         return false;
//     }

//     // cek jika ukurannya terlalu besar
//     if ($ukuranfile > 5000000000) { //dalam bentuk byte
//         echo "<script>
//         alert ('file yang anda upload terlalu besar');
//         </script>";
//         return false;
//     }

//     //lolos pengecekan gambar siap diupload

//     // generate nama gambar random baruu
//     $namafilebaru = uniqid();
//     $namafilebaru .= '.';
//     $namafilebaru .= $ekstensigambar;

//     // mengirim kedalam directory 
//     move_uploaded_file($tmpname, '../../../Assets/profile/' . $namafilebaru);

//     return $namafilebaru; // untuk diproses dalam function tambah sebagai nama file yang disimpan

// }

////////////////function untuk upload gambar asset dalam program 
function uploadasst()
{
    $namafile = $_FILES['foto']['name'];
    $ukuranfile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpname = $_FILES['foto']['tmp_name'];

    // cek apakah ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
        alert ('Pilih Gambar terlebih dahulu');
        </script>";
        return false;
    }

    // cek yang diupload ekstensinya apkah gambar atau bukan
    $ekstensigambarValid = ['jpg', 'png', 'jpeg'];
    $ekstensigambar = explode('.', $namafile); // sebagai pemisah antara nama file dengan ekstensi
    //  contohnya ferdy.png maka menjadi ['ferdy','png']
    $ekstensigambar = strtolower(end($ekstensigambar)); // strtolower merubah nama file menjadi lowercase/ huruf kecil
    // end mengambil explode yang paling akhir

    if (!in_array($ekstensigambar, $ekstensigambarValid)) { // melakukan pengecekan string didalam array
        // fungsi ini menghasilkan true jika ada false jika tidak
        echo "<script>
        alert ('Yang anda upload bukan gambar');
        </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if ($ukuranfile > 5000000000) { //dalam bentuk byte
        echo "<script>
        alert ('file yang anda upload terlalu besar');
        </script>";
        return false;
    }

    //lolos pengecekan gambar siap diupload

    // generate nama gambar random baruu
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensigambar;

    // mengirim kedalam directory 
    move_uploaded_file($tmpname, '../../../Assets/' . $namafilebaru);

    return $namafilebaru; // untuk diproses dalam function tambah sebagai nama file yang disimpan
}

////////////////function untuk upload gambar profile yang disimpan ke dalam profile
function editupload()
{
    $namafile = $_FILES['foto']['name'];
    $ukuranfile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpname = $_FILES['foto']['tmp_name'];

    // cek apakah ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
        alert ('Pilih Gambar terlebih dahulu');
        </script>";
        return false;
    }

    // cek yang diupload ekstensinya apkah gambar atau bukan
    $ekstensigambarValid = ['jpg', 'png', 'jpeg'];
    $ekstensigambar = explode('.', $namafile); // sebagai pemisah antara nama file dengan ekstensi
    //  contohnya ferdy.png maka menjadi ['ferdy','png']
    $ekstensigambar = strtolower(end($ekstensigambar)); // strtolower merubah nama file menjadi lowercase/ huruf kecil
    // end mengambil explode yang paling akhir

    if (!in_array($ekstensigambar, $ekstensigambarValid)) { // melakukan pengecekan string didalam array
        // fungsi ini menghasilkan true jika ada false jika tidak
        echo "<script>
        alert ('Yang anda upload bukan gambar');
        </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if ($ukuranfile > 5000000000) { //dalam bentuk byte
        echo "<script>
        alert ('file yang anda upload terlalu besar');
        </script>";
        return false;
    }

    //lolos pengecekan gambar siap diupload

    // generate nama gambar random baruu
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensigambar;

    // mengirim kedalam directory 
    move_uploaded_file($tmpname, '../../../Assets/profile/' . $namafilebaru);

    return $namafilebaru; // untuk diproses dalam function tambah sebagai nama file yang disimpan

}

////////////////function untuk upload gambar asset dalam program 
function edituploadasst()
{
    $namafile = $_FILES['foto']['name'];
    $ukuranfile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpname = $_FILES['foto']['tmp_name'];

    // cek apakah ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
        alert ('Pilih Gambar terlebih dahulu');
        </script>";
        return false;
    }

    // cek yang diupload ekstensinya apkah gambar atau bukan
    $ekstensigambarValid = ['jpg', 'png', 'jpeg'];
    $ekstensigambar = explode('.', $namafile); // sebagai pemisah antara nama file dengan ekstensi
    //  contohnya ferdy.png maka menjadi ['ferdy','png']
    $ekstensigambar = strtolower(end($ekstensigambar)); // strtolower merubah nama file menjadi lowercase/ huruf kecil
    // end mengambil explode yang paling akhir

    if (!in_array($ekstensigambar, $ekstensigambarValid)) { // melakukan pengecekan string didalam array
        // fungsi ini menghasilkan true jika ada false jika tidak
        echo "<script>
        alert ('Yang anda upload bukan gambar');
        </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if ($ukuranfile > 5000000000) { //dalam bentuk byte
        echo "<script>
        alert ('file yang anda upload terlalu besar');
        </script>";
        return false;
    }

    //lolos pengecekan gambar siap diupload

    // generate nama gambar random baruu
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensigambar;

    // mengirim kedalam directory 
    move_uploaded_file($tmpname, '../../../Assets/' . $namafilebaru);

    return $namafilebaru; // untuk diproses dalam function tambah sebagai nama file yang disimpan
}

///////////////// Function masuk kelas
function mskkelas($data)
{
    global $conn;

    $id_kelas = mysqli_real_escape_string($conn, $data["id_kelas"]);
    $id_user = mysqli_real_escape_string($conn, $data["id_user"]);
    $date = date('Y/m/d', time());
    // var_dump($date);
    // die;
    $query = "INSERT INTO data_kelas VALUES('','$id_kelas','$id_user','$date','',NULL,NULL)";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


////////////////function Kelas////////////////////////////
function tmbhkls($data)
{
    global $conn;

    // strtolower() berfungsi untuk membuat huruf menjadi kecil
    // stripslashes() untuk menghapus karakter backslas
    $nama = mysqli_real_escape_string($conn, $data["judul"]);
    $detail = mysqli_real_escape_string($conn, $data["detail"]);
    $thumbnail = uploadasst();
    // mysqli_real_escape_string() memasukkan simbol" dengan aman
    $dtl_kls = mysqli_real_escape_string($conn, $data["detail_kelas"]);
    $kode_kelas = mysqli_real_escape_string($conn, $data["kode_kelas"]);

    // menambahkan kelas baru kedalam database
    $query = "INSERT INTO kelas VALUES('','$nama','$detail','$thumbnail','$dtl_kls','$kode_kelas')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function editkelas($data)
{
    global $conn;

    $id = $data["id_kelas"];
    $nama = mysqli_real_escape_string($conn, $data["judul"]);
    $detail = mysqli_real_escape_string($conn, $data["detail"]);
    // mysqli_real_escape_string() memasukkan simbol" dengan aman
    $dtl_kls = mysqli_real_escape_string($conn, $data["detail_kelas"]);
    $kode_kelas = mysqli_real_escape_string($conn, $data["kode_kelas"]);
    $fotolama = mysqli_real_escape_string($conn, $data["foto_lama"]);

    //cek apakah user pilih gambar baru atau tidak
    if ($_FILES['foto']['error'] === 4) {
        $thumbnail = $fotolama;
    } else {
        $tempat = "../../../Assets/" . $fotolama;
        unlink($tempat);
        $thumbnail = edituploadasst();
    }

    $query = "UPDATE kelas SET
            nama_kelas = '$nama',
            detail_awal = '$detail',
            gambar_kelas = '$thumbnail', 
            detail_program = '$dtl_kls',
            kode_materi = '$kode_kelas'
            WHERE id_kelas = $id
        ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function hapuskls($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM kelas WHERE id_kelas = $id");

    return mysqli_affected_rows($conn);
}

////////////////function Mentor////////////////////////////
function tmbhmntr($data)
{
    global $conn;

    // strtolower() berfungsi untuk membuat huruf menjadi kecil
    // stripslashes() untuk menghapus karakter backslas
    $kode_kelas = $data["kode_kelas"];
    $nama = mysqli_real_escape_string($conn, $data["nama"]);
    $foto = uploadasst();
    $pekerjaan = mysqli_real_escape_string($conn, $data["pekerjaan"]);
    $pengalaman = mysqli_real_escape_string($conn, $data["pengalaman"]);
    // mysqli_real_escape_string() memasukkan simbol" dengan aman
    $instagram = mysqli_real_escape_string($conn, $data["instagram"]);
    $linkedin = mysqli_real_escape_string($conn, $data["linkedin"]);

    // menambahkan kelas baru kedalam database
    $query = "INSERT INTO mentor VALUES('','$kode_kelas','$nama','$foto','$pekerjaan','$pengalaman','$instagram','$linkedin')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function editmentor($data)
{
    global $conn;

    $id = $data["id_mentor"];
    $kode_kelas = mysqli_real_escape_string($conn, $data["kode_kelas"]);
    $nama = mysqli_real_escape_string($conn, $data["nama"]);
    $fotolama = mysqli_real_escape_string($conn, $data["foto_lama"]);
    $pekerjaan = mysqli_real_escape_string($conn, $data["pekerjaan"]);
    $pengalaman = mysqli_real_escape_string($conn, $data["pengalaman"]);
    $instagram = mysqli_real_escape_string($conn, $data["instagram"]);
    $linkedin = mysqli_real_escape_string($conn, $data["linkedin"]);

    //cek apakah user pilih gambar baru atau tidak
    if ($_FILES['foto']['error'] === 4) {
        $foto = $fotolama;
    } else {
        $tempat = "../../../Assets/" . $fotolama;
        unlink($tempat);
        $foto = edituploadasst();
    }

    $query = "UPDATE mentor SET
            kode_kelas = '$kode_kelas',
            nama_mentor = '$nama',
            foto = '$foto', 
            pekerjaan = '$pekerjaan',
            pengalaman = '$pengalaman',
            instagram = '$instagram',
            linkedin = '$linkedin'
            WHERE id_mentor = $id
        ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function hapusmentor($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM mentor WHERE id_mentor = $id");

    return mysqli_affected_rows($conn);
}


////////////////function Tools////////////////////////////
function tmbhtools($data)
{
    global $conn;

    // strtolower() berfungsi untuk membuat huruf menjadi kecil
    // stripslashes() untuk menghapus karakter backslas
    $kode_kelas = $data["kode_kelas"];
    $icon = uploadasst();
    $nama = mysqli_real_escape_string($conn, $data["nama"]);
    $link = mysqli_real_escape_string($conn, $data["link"]);

    // menambahkan kelas baru kedalam database
    $query = "INSERT INTO tools VALUES('','$nama','$kode_kelas','$link','$icon')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function edittools($data)
{
    global $conn;

    $id = $data["id_tools"];
    $kode_kelas = mysqli_real_escape_string($conn, $data["kode_kelas"]);
    $nama = mysqli_real_escape_string($conn, $data["nama"]);
    $fotolama = mysqli_real_escape_string($conn, $data["foto_lama"]);
    $link_tools = mysqli_real_escape_string($conn, $data["link"]);


    //cek apakah user pilih gambar baru atau tidak
    if ($_FILES['foto']['error'] === 4) {
        $foto = $fotolama;
    } else {
        $tempat = "../../../Assets/" . $fotolama;
        unlink($tempat);
        $foto = edituploadasst();
    }

    $query = "UPDATE tools SET
            nama_tools = '$nama',
            kode_materi = '$kode_kelas',
            link_tools = '$link_tools', 
            gambar_tools = '$foto'
            
            WHERE id_tools = $id
        ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function hapustools($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM tools WHERE id_tools = $id");

    return mysqli_affected_rows($conn);
}


////////////////function Materi////////////////////////////
function tmbhmateri($data)
{
    global $conn;
    // strtolower() berfungsi untuk membuat huruf menjadi kecil
    // stripslashes() untuk menghapus karakter backslas
    $kode_kelas = $data["kode_kelas"];
    $urutan = mysqli_real_escape_string($conn, $data["urutan"]);
    $judul = mysqli_real_escape_string($conn, $data["judul"]);
    $deskripsi = mysqli_real_escape_string($conn, $data["deskripsi"]);
    $link_materi = mysqli_real_escape_string($conn, $data["link_materi"]);

    // menambahkan kelas baru kedalam database
    $query = "INSERT INTO materi VALUES('','$urutan','$kode_kelas','$judul','$link_materi','$deskripsi')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function editmateri($data)
{
    global $conn;

    $id = $data["id_materi"];
    $kode_kelas = mysqli_real_escape_string($conn, $data["kode_kelas"]);
    $urutan = mysqli_real_escape_string($conn, $data["urutan"]);
    $judul_materi = mysqli_real_escape_string($conn, $data["judul"]);
    $deskripsi_materi = mysqli_real_escape_string($conn, $data["deskripsi"]);
    $link_materi = mysqli_real_escape_string($conn, $data["link_materi"]);



    $query = "UPDATE materi SET
            urutan = '$urutan',
            kode_materi = '$kode_kelas',
            judul_materi = '$judul_materi',
            link_materi = '$link_materi', 
            deskripsi_materi = '$deskripsi_materi'
            WHERE id_materi = $id
        ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function hapusmateri($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM materi WHERE id_materi = $id");

    return mysqli_affected_rows($conn);
}


////////////////function penilaian////////////////////////////
function tmbhnilai($data)
{
    global $conn;
    // strtolower() berfungsi untuk membuat huruf menjadi kecil
    // stripslashes() untuk menghapus karakter backslas
    $id = mysqli_real_escape_string($conn, $data["id"]);
    $asal_instansi = mysqli_real_escape_string($conn, $data["asal_instansi"]);
    $penilaian = mysqli_real_escape_string($conn, $data["penilaian"]);

    // menambahkan kelas baru kedalam database
    $query = "UPDATE data_kelas SET
            penilaian = '$penilaian',
            asal_instansi = '$asal_instansi'
            WHERE id_data_kelas = $id
        ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cariuser($kelas, $user)
{
    $query = "SELECT data_kelas.id_kelas,data_kelas.id_user,data_kelas.tgl_pendaftaran,
                    login.nama,login.foto,
                    kelas.nama_kelas
                    FROM data_kelas 
                INNER JOIN kelas ON data_kelas.id_kelas = kelas.id_kelas
                INNER JOIN login ON data_kelas.id_user = login.id_login
                WHERE data_kelas.id_kelas LIKE '%$kelas%' AND
                login.nama LIKE '%$user%'";

    return query($query); // mengolah kembali hasil ke dalam function query

}

function carimentor($kelas, $mentor)
{
    $query = "SELECT mentor.id_mentor,mentor.foto,mentor.nama_mentor,mentor.pekerjaan,mentor.pengalaman, kelas.nama_kelas
                  FROM mentor INNER JOIN kelas ON mentor.kode_kelas = kelas.kode_materi
                  WHERE kelas.id_kelas LIKE '%$kelas%' AND
                  mentor.nama_mentor LIKE '%$mentor%'
                  ";

    return query($query);
}

function carimateri($kelas)
{
    $query = "SELECT materi.id_materi,materi.judul_materi,materi.urutan, materi.link_materi, materi.deskripsi_materi, kelas.nama_kelas
                FROM materi INNER JOIN kelas ON materi.kode_materi = kelas.kode_materi      
                WHERE kelas.id_kelas LIKE '%$kelas%' ORDER BY urutan ASC
  ";
    return query($query);
}

function caritools($kelas)
{
    $query = "SELECT tools.id_tools,tools.gambar_tools, tools.nama_tools, tools.link_tools,
                    kelas.nama_kelas
                FROM tools INNER JOIN kelas ON tools.kode_materi = kelas.kode_materi
                WHERE kelas.id_kelas LIKE '%$kelas%' 
                ";

    return query($query);
}
