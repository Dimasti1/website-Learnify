-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jun 2024 pada 22.04
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digiskill`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_kelas`
--

CREATE TABLE `data_kelas` (
  `id_data_kelas` int(20) NOT NULL,
  `id_kelas` int(20) NOT NULL,
  `id_user` int(20) NOT NULL,
  `tgl_pendaftaran` date NOT NULL,
  `metode_pembayaran` varchar(200) NOT NULL,
  `penilaian` varchar(200) DEFAULT NULL,
  `asal_instansi` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_kelas`
--

INSERT INTO `data_kelas` (`id_data_kelas`, `id_kelas`, `id_user`, `tgl_pendaftaran`, `metode_pembayaran`, `penilaian`, `asal_instansi`) VALUES
(33, 6, 33, '2024-06-03', '', NULL, NULL),
(34, 1, 35, '2024-06-03', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(20) NOT NULL,
  `nama_kelas` varchar(200) NOT NULL,
  `detail_awal` varchar(200) NOT NULL,
  `gambar_kelas` varchar(200) NOT NULL,
  `detail_program` varchar(2000) NOT NULL,
  `kode_materi` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `detail_awal`, `gambar_kelas`, `detail_program`, `kode_materi`) VALUES
(1, 'UI/UX Designn', 'Belajar UI/UX Design dengan Figma untuk pengembangan design website', '6464fa63d307f.png', 'asdasd', 101),
(2, 'Front-End Developer', 'Belajar membangun website yang dinamis dengan HTML, CSS dan JS', '0', ' ', 102),
(5, 'Back-End Developer', 'Belajar menggunkan PHP, framwork Laravel serta Github untuk kolaborasi', '6464fa7de42b4.png', ' Belajar menggunkan PHP, framwork Laravel serta Github untuk kolaborasi', 103),
(6, 'Grafik Desain', 'Belajar membuat poster digital', '64641b3b57c0e.jpeg', ' ', 104);

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id_login` int(20) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nomor_hp` varchar(12) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `kota` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id_login`, `nama`, `username`, `email`, `password`, `nomor_hp`, `foto`, `alamat`, `provinsi`, `kota`) VALUES
(33, 'dimas', 'dimas', 'dimassidomukti@gmail.com', '$2y$10$0MGJjGkOvldnaTxFqUCBMOxUuCAV7Fk2OgN.s/Z3Esi4.qWuq8Knq', '', '647430197ece6.png', '', '', ''),
(34, 'admin', 'admin1', 'dimaskenduruan@gmail.com', '$2y$10$fqXP9pnTkPJKln05EoKkT.9ADm165EnK0RQ5emJXkBW.gm4ho1aFq', '', '647430197ece6.png', '', '', ''),
(35, 'dimas', 'dimas1', 'dimasadiz.22088@mhs.unesa.ac.id', '$2y$10$iEayeILNIJJnk9FYxkPA8ODENxWD2Yf9VXKeqgSl3jXLwR7eZyf32', '', '647430197ece6.png', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi`
--

CREATE TABLE `materi` (
  `id_materi` int(20) NOT NULL,
  `urutan` int(11) NOT NULL,
  `kode_materi` int(20) NOT NULL,
  `judul_materi` varchar(200) NOT NULL,
  `link_materi` varchar(200) NOT NULL,
  `deskripsi_materi` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `materi`
--

INSERT INTO `materi` (`id_materi`, `urutan`, `kode_materi`, `judul_materi`, `link_materi`, `deskripsi_materi`) VALUES
(1, 1, 101, 'Apa itu UI UX??', 'https://youtu.be/cBGBXjzWVi0', 'xfgsjklsvsasxdvbsnansxbdvxban'),
(3, 2, 101, 'Belajar Dasar Figma', 'https://youtu.be/PJIKqnftfPw', 'Pada kedua ini akan membahas tentang dasar dasar figma, anda akan belajar tentang tools figma yang akan selalu digunakan oleh seorang UI/UX Designer'),
(4, 3, 101, 'Component di Figma', 'https://youtu.be/zGPQI6XcPkM', 'Salah satu fitur penting di figma, yaitu Component. Dengan               component kita bisa mengatur banyak elemen sekaligus di seluruhprojek kita. Kita juga bisa membuat design system yang \'hidup\'  '),
(5, 4, 101, 'Layouting', 'https://www.youtube.com/embed/41_zU4pheWg', 'Layout merupakan desain tata letak, sedangkan arti dari layout adalah suatu susunan, rancangan, atau tata letak ruang dari sebuah elemen yang sengaja didesain untuk bisa ditempatkan dalam suatu bidang'),
(6, 5, 101, 'Prototyping', 'https://www.youtube.com/embed/l-6vRjEknC0', 'Prototype merupakan tahapan yang ditujukan untuk mentransformasi sifat-sifat abstrak dari sebuah ide menjadi lebih berwujud.Prototype sangat penting dalam desain aplikasi atau desain website karena de'),
(7, 1, 102, 'Belajar Dasar HTML', 'https://www.youtube.com/embed/hMDJyb7VkYw', 'HTML adalah singkatan dari Hypertext Markup Language yang memiliki pengertian bahasa markup standar untuk membuat dan menyusun halaman pada aplikasi website. Pada materi ini akan membahas lengkap meng'),
(8, 2, 102, 'Menganal CSS', 'https://www.youtube.com/embed/CleFk3BZB3g', 'CSS adalah bahasa Cascading Style Sheet dan biasanya digunakan untuk mengatur tampilan elemen yang tertulis dalam bahasamarkup, seperti HTML. CSS berfungsi untuk memisahkan konten dari tampilan visual'),
(9, 3, 102, 'Belajar Framwork Bootstrap 5', 'https://www.youtube.com/embed/LkR-9Z1sle8', 'Bootstrap adalah framework HTML, CSS, dan JavaScript yang berfungsi untuk mendesain website responsive dengan cepat dan mudah. Pada materi ini akan dibahas tuntas mengenai bootsrap'),
(10, 1, 104, 'Photoshop 1', 'https://www.youtube.com/embed/25cPH8wUwLE?si=G51oGenolBr08f_M', ' Sejarah HTML\r\nAsal mula adanya HTML ini dicetuskan atau dibuat oleh Tim Berners Lee yang merupakan fisikawan di lembaga penelitian CERN di kota Swiss. Berners Lee awalnya memiliki ide atau pemikiran '),
(11, 4, 102, 'Mengenal Java Script', 'https://www.youtube.com/embed/SDROba_M42g', ' JavaScript adalah bahasa pemrograman yang digunakan dalam pengembangan website agar lebih dinamis dan interaktif. Kalau sebelumnya kamu hanya mengenal HTML dan CSS, nah sekarang kamu jadi tahu bahwa '),
(12, 1, 103, 'Apa itu PHP', 'https://www.youtube.com/embed/TaBWhb5SPfc', 'PHP adalah singkatan dari Hypertext Preprocessor, yaitu bahasa penulisan skrip yang sebenarnya mirip dengan JavaScript dan Python. Perbedaannya, PHP adalah bahasa yang biasanya digunakan untuk komunik'),
(13, 2, 103, 'Mengenal Git dan Github', 'https://www.youtube.com/embed/lTMZxWMjXQU', 'Git dan GitHub merupakan dua platform yang didirikan oleh satu perusahaan dengan tujuan sama\r\nserta fitur yang berbeda. Namun kedua platform ini sangat membantu pekerjaan programmer dalam menyusun kod'),
(14, 3, 103, 'Pemahaman Laravel', 'https://www.youtube.com/embed/ClMX6TXvh_o\"', ' <p>Laravel adalah framework berbasis bahasa pemrograman PHP yang bisa digunakan untuk membantu proses pengembangan sebuah website agar lebih maksimal. Dengan menggunakan Laravel, website yang dihasil'),
(15, 4, 0, 'Resp API', 'https://www.youtube.com/embed/9ed3b0tSRvI', 'API adalah sekumpulan aturan atau kode yang menghubungkan dua program atau lebih untuk\r\nberkomunikasi, API menjadi penghubung antar aplikasi / website dalam satu platform maupun  lintas platform. Sala'),
(16, 4, 103, 'Node JS', 'https://www.youtube.com/embed/b39Xqf5iyjo', 'Node.js adalah runtime environment untuk JavaScript yang bersifat open-source dan cross-platform. Dengan Node.js kita dapat menjalankan kode JavaScript di mana pun, tidak hanya terbatas pada lingkunga');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mentor`
--

CREATE TABLE `mentor` (
  `id_mentor` int(20) NOT NULL,
  `kode_kelas` int(12) NOT NULL,
  `nama_mentor` varchar(200) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `pekerjaan` varchar(200) NOT NULL,
  `pengalaman` varchar(2000) NOT NULL,
  `instagram` varchar(200) NOT NULL,
  `linkedIn` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mentor`
--

INSERT INTO `mentor` (`id_mentor`, `kode_kelas`, `nama_mentor`, `foto`, `pekerjaan`, `pengalaman`, `instagram`, `linkedIn`) VALUES
(1, 101, 'Dimas Adiz Setiawan', '64658cd65bd5d.png', 'UI/UX Designer and Full Stack Developer at Riliv', 'Dimas bekerja sebagai seorang UI/UX Designer dan Full Stack Developer di Riliv, sebuah perusahaan teknologi kesehatan di Indonesia. Dimas memiliki pengalaman selama 3 tahun di bidang desain antarmuka pengguna dan pengalaman', 'dimasadiz_', 'dimasadiz_'),
(2, 102, 'Dicky Andi Soffan', '64658ce63219a.png', 'Front-End-Developer di PT Sampoerna', 'Dicky adalah seorang Front End Developer di PT Sampoerna, sebuah perusahaan besar di Indonesia. Sebagai seorang Front End Developer, tugas utamanya adalah merancang dan mengembangkan tampilan depan halaman website.', 'watanacce', ''),
(17, 104, 'Tuti Dian Kusumawati', '64658cf1b6b84.png', 'Grafik Desain', 'Tuti berpengalaman kerja di PT Samoedra Indonesia sebagai Grafik Desain pada logo perusahaan.', 'dasdasasdasd', 'asdsad'),
(20, 103, 'Kayla Syva Syahputri', '646590525f0b2.png', 'Beck-End-Developer di Shopee Indonesia', 'Kayla septiawan lulusan UNESA Teknik Informatika, Beliau memiliki pengalaman dalam membangun website dari sisi Back-End. Kayla sudah memiliki pengalaman selama 10 Tahun ', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tools`
--

CREATE TABLE `tools` (
  `id_tools` int(11) NOT NULL,
  `nama_tools` varchar(50) NOT NULL,
  `kode_materi` varchar(50) NOT NULL,
  `link_tools` varchar(500) NOT NULL,
  `gambar_tools` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tools`
--

INSERT INTO `tools` (`id_tools`, `nama_tools`, `kode_materi`, `link_tools`, `gambar_tools`) VALUES
(4, 'PHP', '103', 'test aja', '647dbb188ad02.png'),
(6, 'Figma', '101', 'coba', '646596a6582a9.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_kelas`
--
ALTER TABLE `data_kelas`
  ADD PRIMARY KEY (`id_data_kelas`),
  ADD KEY `id_kelas` (`id_kelas`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `kode_materi` (`kode_materi`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indeks untuk tabel `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`);

--
-- Indeks untuk tabel `mentor`
--
ALTER TABLE `mentor`
  ADD PRIMARY KEY (`id_mentor`);

--
-- Indeks untuk tabel `tools`
--
ALTER TABLE `tools`
  ADD PRIMARY KEY (`id_tools`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_kelas`
--
ALTER TABLE `data_kelas`
  MODIFY `id_data_kelas` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `mentor`
--
ALTER TABLE `mentor`
  MODIFY `id_mentor` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `tools`
--
ALTER TABLE `tools`
  MODIFY `id_tools` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `data_kelas`
--
ALTER TABLE `data_kelas`
  ADD CONSTRAINT `data_kelas_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_kelas_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `login` (`id_login`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
