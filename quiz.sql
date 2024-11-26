-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 26 Nov 2024 pada 18.28
-- Versi server: 8.0.40-cll-lve
-- Versi PHP: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `answers`
--

CREATE TABLE `answers` (
  `category` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `q_id` varchar(3) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `answer` varchar(2000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `points` int DEFAULT NULL,
  `id` varchar(4) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `answers`
--

INSERT INTO `answers` (`category`, `q_id`, `answer`, `points`, `id`) VALUES
('comfort', 'Q1', 'Circle yang sefrekuensi dan obrolannya nyambung', 10, 'Q1A'),
('acknowledgement', 'Q1', 'Circle yang mengapresasi dan menghargai tindakanku', 10, 'Q1B'),
('affirmation', 'Q1', 'Circle yang mau untuk memahami, menemani, dan melibatkan aku', 10, 'Q1C'),
('order', 'Q1', 'Circle yang bisa ikutin ekspetasiku bisa ngikut seleraku', 10, 'Q1D'),
('dominance', 'Q1', 'Circle di mana aku didengarkan dan dianggap penting', 10, 'Q1E'),
('excellence', 'Q1', 'Circle di mana aku punya kelebihan dan bisa menutupi kekurangan orang lain', 10, 'Q1F'),
('freedom', 'Q1', 'Circle yang tidak terlalu mengikat atau menuntut', 10, 'Q1G'),
('comfort', 'Q2', 'Ada dosen yang mendampingi dan baik banget. Teman-teman yang ikut lomba enak diajak kerja sama, aku kenal, dan nyambung. Apalagi ada subsidi dari kampus untuk biaya pendaftarannya', 10, 'Q2A'),
('acknowledgement', 'Q2', 'Jika aku ikut lomba ini, aku bisa punya prestasi yang berguna untuk aku dan portofolioku untuk masa depan', 10, 'Q2B'),
('affirmation', 'Q2', 'Aku akan ikut jika circle kelompok ku juga ikut', 10, 'Q2C'),
('order', 'Q2', 'Aku sudah tahu apa yang harus aku lakukan dan aku sudah punya tim yang mendukung aku', 10, 'Q2D'),
('dominance', 'Q2', 'Lomba ini akan membuat aku diperhitungkan dan jadi orang yang punya suara di jurusan ini', 10, 'Q2E'),
('excellence', 'Q2', 'Jika aku bisa melewati tantangan ini, aku akan menjadi lebih expert lagi', 10, 'Q2F'),
('freedom', 'Q2', 'Ikut dalam lomba memberiku kebebasan untuk mengambil risiko dan mencoba hal-hal baru', 10, 'Q2G'),
('comfort', 'Q3', 'Orang yang ga nyambung sama aku dan bisa bikin persiapan lomba jadi ga nyaman', 10, 'Q3A'),
('acknowledgement', 'Q3', 'Orang yang sok pintar dan meremehkan aku', 10, 'Q3B'),
('affirmation', 'Q3', 'Orang yang enggak suka aku ikut lomba ini', 10, 'Q3C'),
('order', 'Q3', 'Orang yang tidak mau mengikuti arahan dan punya cara sendiri', 10, 'Q3D'),
('dominance', 'Q3', 'Orang yang tidak mau mendengarkan pendapat orang lain dan bekerja sendirian', 10, 'Q3E'),
('excellence', 'Q3', 'Orang yang jago-jago semua karena nantinya akan terlalu bersaing', 10, 'Q3F'),
('freedom', 'Q3', 'Orang yang terlalu kaku atau terikat pada satu cara kerja', 10, 'Q3G'),
('comfort', 'Q4', 'Aku merasa tidak nyaman, burned out, dan ingin segera selesai dari struggle ini', 10, 'Q4A'),
('acknowledgement', 'Q4', 'Tidak apa-apa karena orang lain akan tahu dan memperhitungkan kerja kerasku', 10, 'Q4B'),
('affirmation', 'Q4', 'Aku akan mencari orang yang mau mendengarkan cerita dan keluh kesahku', 10, 'Q4C'),
('order', 'Q4', 'Aku akan benar-benar memperhatikan semuanya agar tidak ada detail yang terlewat dalam menyelesaikan masalah ini', 10, 'Q4D'),
('dominance', 'Q4', 'Aku harus jadi orang yang paling punya pengaruh dalam masalah ini supaya aku bisa menyelesaikan dengan baik', 10, 'Q4E'),
('excellence', 'Q4', 'Aku suka dengan tantangan dan aku bakal bisa menyelesaikannya dengan sangat baik', 10, 'Q4F'),
('freedom', 'Q4', 'Aku tidak akan diatur oleh masalah ini dan aku akan menyelesaikannya dengan caraku sendiri', 10, 'Q4G'),
('comfort', 'Q5', 'Aku tidak ingin berlarut-larut dalam situasi yang tidak mengenakkan ini', 10, 'Q5A'),
('acknowledgement', 'Q5', 'Aku tidak ingin orang lain menilai aku tidak kompeten', 10, 'Q5B'),
('affirmation', 'Q5', 'Aku tidak ingin orang lain menilai aku dari kegagalanku sehingga mempengaruhi sikap mereka terhadap diriku', 10, 'Q5C'),
('order', 'Q5', 'Aku tidak ingin orang lain tidak percaya pendapatku sehingga mereka tidak lagi mengikuti saranku', 10, 'Q5D'),
('dominance', 'Q5', 'Aku tidak ingin orang lain menganggap aku tidak punya kredibilitas sehingga aku tidak punya pengaruh atas diri mereka', 10, 'Q5E'),
('excellence', 'Q5', 'Aku tidak ingin tidak punya kesempatan untuk memperbaiki kesalahanku kembali', 10, 'Q5F'),
('freedom', 'Q5', 'Aku tidak ingin kekalahan ini mempengaruhi diriku', 10, 'Q5G'),
('comfort', 'Q6', 'Ambil posisi paling enak di kamar, dengan AC dingin dan selimut tebal. Bahkan jika bisa, aku ingin bisa mengganti channel netflix tanpa menggerakkan tanganku.', 10, 'Q6A'),
('acknowledgement', 'Q6', 'Berada di circle yang tahu kelebihanku dan bisa menghargai keberadaan diriku sehingga berdampak positif untuk perkembanganku', 10, 'Q6B'),
('affirmation', 'Q6', 'Bersama orang-orang yang membuat aku bisa menjadi apa adanya dan seru-seruan bareng', 10, 'Q6C'),
('order', 'Q6', 'Merapikan dan mengefisienkan sistem hidup supaya lebih efisien lagi keesokan harinya', 10, 'Q6D'),
('dominance', 'Q6', 'Berada di tempat dan circle yang aku didengarkan dan mau menghargai pendapatku', 10, 'Q6E'),
('excellence', 'Q6', 'Memperbanyak skill agar lebih banyak kemampuan yang dapat aku asah lagi', 10, 'Q6F'),
('freedom', 'Q6', 'Apapun, aku akan melakukan apapun terserah aku', 10, 'Q6G'),
('comfort', 'Q7', 'Ada tugas dadakan yang mengharuskan aku kerja kelompok dengan temanku sampai lembur di kampus', 10, 'Q7A'),
('acknowledgement', 'Q7', 'Effortku ke kampus dan lanjut kerja tidak dihargai oleh dosen', 10, 'Q7B'),
('affirmation', 'Q7', 'Aku sudah memakan waktu lama untuk siap-siap terlebih dahulu ke kampus, namun teman-temanku masih tidak menghargai apa yang aku lakukan', 10, 'Q7C'),
('order', 'Q7', 'Banyak hal yang terjadi di luar ekspetasiku dan menyalahi cara yang sudah aku susun hari ini', 10, 'Q7D'),
('dominance', 'Q7', 'Ada temanku yang menjadwalkan kerja kelompok dan mengatur pembagian tugas terlebih dahulu tanpa meminta persetujuanku', 10, 'Q7E'),
('excellence', 'Q7', 'Ketika aku tidak dapat melakukan solusi kreatif atau kontribusi positif', 10, 'Q7F'),
('freedom', 'Q7', 'Ketika aku tidak bisa menolak paksaan kembali ke kampus tersebut', 10, 'Q7G'),
('comfort', 'Q8', 'Aku akan titip absen ke ketua kelas dan pergi ke perpustakaan/collab room untuk rebahan', 10, 'Q8A'),
('acknowledgement', 'Q8', 'Menggunakan kesempatan saat semua orang sedang tidak tertarik subjeknya, untuk mengamankan posisi sebagai anak yang cukup excel di kelas', 10, 'Q8B'),
('affirmation', 'Q8', 'Aku ingin cari suatu hal yang bisa entertain teman-temanku yang juga bosan dengan pelajaran ini', 10, 'Q8C'),
('order', 'Q8', 'Aku akan mencoba menjawab pertanyaan-pertanyaan dosen agar aku bisa mengarahkan alur pembahasan di kelas', 10, 'Q8D'),
('dominance', 'Q8', 'Aku akan menjadi orang yang dipercaya dosen untuk membantu menertibkan kelas dan mengembalikan kondusivitas pelajaran', 10, 'Q8E'),
('excellence', 'Q8', 'Keadaan harusnya tidak mempengaruhi kualitas konsentrasi dan pembelajaranku', 10, 'Q8F'),
('freedom', 'Q8', 'Aku akan keluar kelas dan melakukan hal lain yang menurutku lebih berguna', 10, 'Q8G'),
('comfort', 'Q9', 'Dipaksa terus bekerja tidak peduli kondisi yang kurang mendukung ini', 10, 'Q9A'),
('acknowledgement', 'Q9', 'Ketika orang-orang menganggap aku tidak punya solusi atas situasi ini', 10, 'Q9B'),
('affirmation', 'Q9', 'Waktu timku pergi mencari kesenangan sendiri-sendiri dan meninggalkanku', 10, 'Q9C'),
('order', 'Q9', 'Ketika banyak hal yang kemudian terjadi di luar ekspektasiku', 10, 'Q9D'),
('dominance', 'Q9', 'Ketika semua orang mulai melakukan segala sesuatu yang menurutku sudah keluar batas', 10, 'Q9E'),
('excellence', 'Q9', 'Ketika aku tidak bisa menemukan solusi yang baik di situasi ini, padahal seharusnya aku bisa', 10, 'Q9F'),
('freedom', 'Q9', 'Tidak mau terus-terusan menunggu tanpa kepastian, aku akan melakukan yang aku mau lakukan', 10, 'Q9G'),
('comfort', 'Q10', 'Mulai ga nyambung dan aku mulai ga paham apa yang diobrolin', 10, 'Q10A'),
('acknowledgement', 'Q10', 'Mereka jarang mengapresiasi effort ku', 10, 'Q10B'),
('affirmation', 'Q10', 'Mereka ngomongin aku di belakang dan udah ga pernah ajak hangout bareng', 10, 'Q10C'),
('order', 'Q10', 'Udah pada beda dan jalan sendiri-sendiri', 10, 'Q10D'),
('dominance', 'Q10', 'Aku sudah tidak diperhitungkan dan pendapatku tidak dianggap penting', 10, 'Q10E'),
('excellence', 'Q10', 'Growthku terhambat dan aku sulit mengembangkan hal baru dalam diriku', 10, 'Q10F'),
('freedom', 'Q10', 'Mereka terlalu menuntut dan mengatur aku', 10, 'Q10G');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `category` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`category`) VALUES
('comfort'),
('acknowledgement'),
('affirmation'),
('order'),
('dominance'),
('excellence'),
('freedom');

-- --------------------------------------------------------

--
-- Struktur dari tabel `questions`
--

CREATE TABLE `questions` (
  `id` varchar(3) COLLATE utf8mb4_general_ci NOT NULL,
  `question` varchar(2000) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `questions`
--

INSERT INTO `questions` (`id`, `question`) VALUES
('Q1', 'Hari pertama masuk kuliah setelah WGG, kamu melihat beberapa teman sejurusanmu udah bentuk circle. Kamu ingin masuk circle yang seperti apa dalam perkuliahanmu?'),
('Q10', 'Tiba-tiba kamu merasa ga cocok dengan circle mu. Kira-kira apa yang bikin kamu ga cocok dengan circle mu?'),
('Q2', 'Setelah beberapa bulan berkuliah, kamu tiba-tiba diajak dosen untuk ikut lomba. Kamu tahu bahwa lomba itu akan mengorbankan banyak waktu dan tenaga. Apa yang membuat kamu tetap ingin ikut?'),
('Q3', 'Kamu sudah ikut lomba dan saatnya memilih anggota dalam timmu untuk ikut bersamamu. Orang seperti apa yang kamu hindari untuk masuk dalam timmu?'),
('Q4', 'Di saat kamu sedang struggle dan berjuang, kondisi apa yang paling menggambarkan situasimu?'),
('Q5', 'Jika kamu kalah dalam lomba itu, hal apa yang tidak kamu inginkan terjadi?'),
('Q6', 'Hari ini hari liburmu nih! Kamu punya kesempatan untuk melakukan apapun yang kamu mau. Kira kira apa yang akan kamu lakukan untuk memaksimalkan hari liburmu?'),
('Q7', 'Semua tanggungan pekerjaan sudah selesai, sudah mandi, saatnya istirahat. Tiba-tiba ditelpon dan diminta menyusul ke kampus lagi. Apa yang tidak kamu inginkan terjadi?'),
('Q8', 'Kamu sedang berada di dalam kelas yang menurutmu tidak menarik dan kamu tidak paham tujuan belajarnya. Apa respon yang paling menggambarkan dirimu?'),
('Q9', 'Kamu menunggu wifi petra stabil lagi dalam rentang waktu yang tidak pasti di tengah kamu mengerjakan tugas dan timmu kehilangan motivasi. Hal apa yang paling kamu tidak inginkan terjadi?');

-- --------------------------------------------------------

--
-- Struktur dari tabel `results`
--

CREATE TABLE `results` (
  `nrp` varchar(9) COLLATE utf8mb4_general_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kenyamanan` decimal(4,1) DEFAULT NULL,
  `pengakuan` decimal(4,1) DEFAULT NULL,
  `penerimaan` decimal(4,1) DEFAULT NULL,
  `kontrol` decimal(4,1) DEFAULT NULL,
  `kuasa` decimal(4,1) DEFAULT NULL,
  `superioritas` decimal(4,1) DEFAULT NULL,
  `kebebasan` decimal(4,1) DEFAULT NULL,
  `full_result` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tops` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `answers`
--
ALTER TABLE `answers`
  ADD KEY `q_id` (`q_id`);

--
-- Indeks untuk tabel `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`nrp`),
  ADD KEY `nrp` (`nrp`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`q_id`) REFERENCES `questions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
