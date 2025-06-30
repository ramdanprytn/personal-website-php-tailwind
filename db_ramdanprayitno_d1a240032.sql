-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Jun 2025 pada 15.30
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ramdanprayitno_d1a240032`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_about`
--

CREATE TABLE `tbl_about` (
  `id_about` int(2) NOT NULL,
  `about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_about`
--

INSERT INTO `tbl_about` (`id_about`, `about`) VALUES
(1, 'Hai! Senang kamu mampir ke websitenya. Di sini, saya menuangkan hobi saya dalam ngoding, desain, dan bereksperimen dengan dunia teknologi web.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_artikel`
--

CREATE TABLE `tbl_artikel` (
  `id_artikel` int(5) NOT NULL,
  `nama_artikel` text NOT NULL,
  `isi_artikel` text NOT NULL,
  `kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_artikel`
--

INSERT INTO `tbl_artikel` (`id_artikel`, `nama_artikel`, `isi_artikel`, `kategori`) VALUES
(1, 'Apa Itu Full-Stack Developer?', 'Full-stack developer adalah seorang pengembang web yang menguasai dua sisi utama dari pengembangan aplikasi: front-end (tampilan pengguna) dan back-end (logika dan server). Mereka mampu membangun sebuah aplikasi dari tampilan antarmuka hingga pengelolaan database.\r\n\r\nKeterampilan Umum:\r\n\r\nFront-end: HTML, CSS, JavaScript, dan framework seperti React atau Vue.js\r\n\r\nBack-end: PHP, Node.js, Python, MySQL, MongoDB\r\n\r\nTools: Git, REST API, Docker, dan CI/CD\r\n\r\nFull-stack developer banyak dibutuhkan karena mereka fleksibel dan efisien dalam membangun aplikasi dari awal hingga akhir.', ''),
(2, 'Perbedaan Front-End, Back-End, dan Full-Stack', 'Dalam pengembangan web, ada tiga istilah penting:\r\n\r\nFront-End Developer: Fokus pada tampilan yang dilihat dan digunakan oleh pengguna. Tools: HTML, CSS, JavaScript, Tailwind CSS.\r\n\r\nBack-End Developer: Mengelola server, database, dan logika aplikasi. Tools: PHP, Laravel, Node.js, MySQL.\r\n\r\nFull-Stack Developer: Menggabungkan kedua peran di atas.\r\n\r\nMemahami perbedaan ini penting agar kita bisa memilih jalur karier atau mengatur tim dengan lebih efektif.', ''),
(3, 'Mengenal Tailwind CSS: Framework CSS Modern yang Efisien', 'Tailwind CSS adalah framework CSS berbasis utility-first yang memungkinkan pengembang membuat desain langsung di HTML tanpa menulis kode CSS terpisah.\r\n\r\nKeunggulan Tailwind:\r\n\r\nKode lebih ringkas dan mudah dibaca\r\n\r\nTidak perlu menulis CSS manual\r\n\r\nDesain konsisten dan cepat dibuat\r\n\r\nContoh:\r\n\r\n<button class=\"bg-blue-500 text-white px-4 py-2 rounded\">Klik Saya</button>\r\n\r\nTailwind cocok untuk pengembang yang ingin membangun UI modern secara cepat.', ''),
(4, 'Pentingnya Keamanan Website di Era Digital', 'Di era digital, keamanan website menjadi hal yang sangat krusial. Serangan seperti SQL Injection, XSS, dan CSRF bisa membahayakan data pengguna dan reputasi website.\r\n\r\nTips Keamanan:\r\n\r\nSelalu validasi dan sanitasi input pengguna\r\n\r\nGunakan HTTPS dan SSL\r\n\r\nSimpan password dengan hashing (misalnya bcrypt)\r\n\r\nGunakan prepared statement untuk database\r\n\r\nUpdate sistem dan library secara berkala\r\n\r\nDengan keamanan yang baik, website Anda tidak hanya andal tetapi juga dipercaya oleh pengguna.', ''),
(5, 'Apa Itu API dan Mengapa Penting untuk Web Developer', 'API (Application Programming Interface) adalah antarmuka yang memungkinkan dua sistem atau aplikasi untuk saling berkomunikasi. API banyak digunakan untuk mengakses data atau layanan dari pihak ketiga.\r\n\r\nJenis API:\r\n\r\nREST API: Menggunakan HTTP (GET, POST, PUT, DELETE)\r\n\r\nGraphQL: Lebih fleksibel, memungkinkan permintaan data spesifik\r\n\r\nContoh penggunaan API:\r\n\r\nMenampilkan data cuaca\r\n\r\nLogin menggunakan Google/Facebook\r\n\r\nPembayaran melalui payment gateway\r\n\r\nSebagai developer, memahami API adalah skill penting dalam membangun aplikasi modern.', ''),
(6, '5 Tools Wajib untuk Web Developer Pemula', 'Memulai karier sebagai web developer akan lebih mudah jika menggunakan tools yang tepat:\r\n\r\nVisual Studio Code (VS Code): Editor kode ringan dan powerful\r\n\r\nGit dan GitHub: Untuk versi kontrol dan kolaborasi\r\n\r\nPostman: Untuk menguji API\r\n\r\nFigma: Desain UI/UX secara kolaboratif\r\n\r\nBrowser Developer Tools: Debug dan optimasi langsung di browser\r\n\r\nDengan menguasai tools ini, Anda bisa bekerja lebih efisien dan profesional dalam pengembangan web.', 'UI/UX');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_gallery`
--

CREATE TABLE `tbl_gallery` (
  `id_gallery` int(5) NOT NULL,
  `judul` text NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_gallery`
--

INSERT INTO `tbl_gallery` (`id_gallery`, `judul`, `foto`) VALUES
(1, 'gambar 1', '497840522_18321245062206113_4974010457615564900_n.webp'),
(2, 'gambar 2', '491465142_18321245107206113_2961300679057553772_n.webp'),
(3, 'gambar 3', 'Punteun.webp'),
(6, 'gambar 4', 'Beginning.webp'),
(7, 'gambar 5', 'Menghabiskan THR.webp');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`username`, `password`) VALUES
('admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_about`
--
ALTER TABLE `tbl_about`
  ADD PRIMARY KEY (`id_about`);

--
-- Indeks untuk tabel `tbl_artikel`
--
ALTER TABLE `tbl_artikel`
  ADD PRIMARY KEY (`id_artikel`);

--
-- Indeks untuk tabel `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  ADD PRIMARY KEY (`id_gallery`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_about`
--
ALTER TABLE `tbl_about`
  MODIFY `id_about` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_artikel`
--
ALTER TABLE `tbl_artikel`
  MODIFY `id_artikel` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  MODIFY `id_gallery` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
