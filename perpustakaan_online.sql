-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Jul 2024 pada 09.03
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan_online`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL,
  `publisher` varchar(100) NOT NULL,
  `year_of_publication` year(4) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `availability` tinyint(1) DEFAULT 1,
  `image_path` varchar(255) DEFAULT NULL,
  `synopsis` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `books`
--

INSERT INTO `books` (`book_id`, `title`, `author`, `publisher`, `year_of_publication`, `isbn`, `category_id`, `availability`, `image_path`, `synopsis`) VALUES
(1, 'Your Name', 'Makoto Shinkai', 'Haru', '2016', '978-623-7351-20-7 ', 1, 1, 'yourname.jpg', 'Your Name menceritakan tentang seorang gadis sekolah menengah bernama Mitsuha Miyamizu yang memiliki sebuah mimpi yang sangat kontras dengan kehidupannya saat ini di pedesaan. Mitsuha mendambakan untuk menjalani kehidupan seorang anak laki-laki di kota Tokyo yang ramai.'),
(9, 'The Chronicles of Narnia #1: The Magician`s Nephew', 'C.S. Lewis', 'Gramedia', '2022', '9786020336398', 1, 1, 'Narnia_1_cov_page-0001.jpg', 'Petualangan dimulai! Narnia… tanah tempat para Hewan yang Bisa Bicara tinggal… tempat sang penyihir menunggu… dan dunia yang baru akan terbentuk. Dalam petualangan untuk menyelamatkan seseorang, dua sahabat dipaksa masuk ke dunia lain, tempat seorang penyihir jahat berniat memperbudak mereka. Tetapi, Aslan Sang Singa menyanyikan lagu yang membuat tanah baru tercipta, tanah yang di kemudian hari dikenal sebagai Narnia. Dan di Narnia, segala hal mungkin terjadi…'),
(10, ' Heartbreak Motel', 'Ika Natassa', 'Gramedia', '2022', '9786020658841', 1, 1, 'heartbreak_motel_cov_a2uK3fK.jpg', 'Dalam hidup yang tidak pernah berhenti menyimpan misteri dan menyembunyikan arti, tidak selalu memberikan jawaban atas setiap pertanyaan, dan waktu bergulir—satu jam, satu momen, satu hari, satu minggu, satu bulan—pertanyaan dan permasalahan baru terus lahir sebelum yang lama sempat terurai, Ava menemukan panggilan hati sebagai aktris sejak usianya enam belas tahun.\r\n\r\nBerpindah dari satu peran ke peran lain—ada yang dia pilih, ada yang memilihnya—Ava berupaya membuat semua yang tidak dipahaminya tentang takdir menjadi terasa masuk akal. Dia tidak peduli bahwa setiap selesai memikul peran, dia harus menyepi, jungkir balik memulihkan diri di satu tempat yang disebutnya Heartbreak Motel. Di ulang tahunnya yang ketiga puluh, dimulai dari tempat itu, pertanyaan-pertanyaan baru menyergapnya tumpang-tindih, dihadirkan oleh tiga lelaki yang mengisyaratkan sekaligus mengecoh masa lalu, masa kini, dan masa depannya.'),
(11, 'Black Showman dan Pembunuhan di Kota Tak Bernama', 'Keigo Higashino', 'Gramedia', '2021', '9786020657691', 1, 1, 'Black_Showman_cov.jpg', 'Pembunuhan bisa terjadi di mana saja, termasuk di sebuah kota kecil, terpencil, dan nyaris terlupakan di tengah pandemi Covid-19. Seorang mantan guru SMP ditemukan tewas tercekik di halaman rumahnya sendiri. Polisi tidak tahu apakah ini pembunuhan terencana, pembunuhan tak disengaja, atau aksi pencurian yang berakhir dengan pembunuhan.\r\n\r\nKorban adalah guru yang disegani. Setelah pensiun pun, mantan murid-muridnya sering menghubunginya untuk meminta bantuan atau nasihat. Jadi, tentu saja para mantan muridnya, yang pulang ke kota itu demi menghadiri reuni, termasuk dalam daftar orang-orang yang dicurigai. Polisi kebingungan, dan si pembunuh lega karena identitasnya tidak akan pernah ketahuan.\r\n\r\nNamun, ia tidak menyangka bahwa putri korban akan muncul bersama pamannya—seorang mantan pesulap eksentrik—dan ikut menyelidiki apa yang sebenarnya terjadi dan mencari tahu siapa yang membunuh Kamio Eiichi.'),
(13, 'Perpustakaan Tengah Malam (The Midnight Library)', 'Matt Haig', 'Gramedia', '2020', '9786020649320', 1, 1, '9786020649320_the_midnight_library_cov.jpg', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `borrowingrecords`
--

CREATE TABLE `borrowingrecords` (
  `record_id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `borrow_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` enum('borrowed','returned') NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `borrowingrecords`
--

INSERT INTO `borrowingrecords` (`record_id`, `book_id`, `member_id`, `borrow_date`, `return_date`, `status`, `user_id`) VALUES
(7, 1, 2, '2024-07-01', '2024-07-01', 'returned', 2),
(8, 1, 2, '2024-07-01', '2024-07-01', 'returned', 2),
(9, 1, 2, '2024-07-06', '2024-07-06', 'returned', 2),
(10, 9, 2, '2024-07-06', '2024-07-06', 'returned', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Fiksi'),
(2, 'Non-Fiksi'),
(3, 'Teknologi'),
(4, 'Sains');

-- --------------------------------------------------------

--
-- Struktur dari tabel `members`
--

CREATE TABLE `members` (
  `member_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `members`
--

INSERT INTO `members` (`member_id`, `first_name`, `last_name`, `email`, `phone`, `address`) VALUES
(1, 'Agus', 'Wahyudi', 'agus.wahyudi@example.com', '08123456789', 'Jl. Jendral Sudirman No. 123'),
(2, 'Dewi', 'Lestari', 'dewi.lestari@example.com', '08765432100', 'Jl. Gatot Subroto No. 456'),
(3, 'Budi', 'Santoso', 'budi.santoso@example.com', '08987654321', 'Jl. HR Rasuna Said No. 789'),
(4, 'Siti', 'Nurhaliza', 'siti.nurhaliza@example.com', '08123456789', 'Jl. Thamrin No. 1011'),
(5, 'Ahmad', 'Subagyo', 'ahmad.subagyo@example.com', '08111222333', 'Jl. Diponegoro No. 1213');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('admin','librarian','member') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `role`) VALUES
(1, 'yoga', '$2y$10$TwaHFfvNxMrrFRSAKjrjrun4bX3mQYau84azN8QHmHj9oPDJ6Ev1m', 'yoga@example.com', 'admin'),
(2, 'rizki', '$2y$10$DADteJbbIt5OTQYvFB8tnetsNe8VLFNCRvXf6pCVGPKN9roFBZWWq', 'rizki@example.com', 'member');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indeks untuk tabel `borrowingrecords`
--
ALTER TABLE `borrowingrecords`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indeks untuk tabel `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `borrowingrecords`
--
ALTER TABLE `borrowingrecords`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Ketidakleluasaan untuk tabel `borrowingrecords`
--
ALTER TABLE `borrowingrecords`
  ADD CONSTRAINT `borrowingrecords_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
  ADD CONSTRAINT `borrowingrecords_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
