-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Sep 2024 pada 14.07
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.12

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
  `category` varchar(255) DEFAULT NULL,
  `q_id` varchar(3) DEFAULT NULL,
  `answer` varchar(2000) DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `id` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `answers`
--

INSERT INTO `answers` (`category`, `q_id`, `answer`, `points`, `id`) VALUES
('kenyamanan', 'Q1', 'kenyamanan. Lorem ipsum dolor si', 50, 'Q1A'),
('pengakuan', 'Q1', 'pengakuan. Lorem ipsum dolor si', 20, 'Q1B'),
('penerimaan', 'Q1', 'penerimaan. Lorem ipsum dolor si', 20, 'Q1C'),
('kontrol', 'Q1', 'kontrol. Lorem ipsum dolor si', 40, 'Q1D'),
('kuasa', 'Q1', 'kuasa. Lorem ipsum dolor si', 40, 'Q1E'),
('superioritas', 'Q1', 'superioritas. Lorem ipsum dolor si', 30, 'Q1F'),
('kebebasan', 'Q1', 'kebebasan. Lorem ipsum dolor si', 20, 'Q1G'),
('kenyamanan', 'Q2', 'kenyamanan. Lorem ipsum dolor si', 50, 'Q2A'),
('pengakuan', 'Q2', 'pengakuan. Lorem ipsum dolor si', 20, 'Q2B'),
('penerimaan', 'Q2', 'penerimaan. Lorem ipsum dolor si', 20, 'Q2C'),
('kontrol', 'Q2', 'kontrol. Lorem ipsum dolor si', 40, 'Q2D'),
('kuasa', 'Q2', 'kuasa. Lorem ipsum dolor si', 40, 'Q2E'),
('superioritas', 'Q2', 'superioritas. Lorem ipsum dolor si', 30, 'Q2F'),
('kebebasan', 'Q2', 'kebebasan. Lorem ipsum dolor si', 20, 'Q2G'),
('kenyamanan', 'Q3', 'kenyamanan. Lorem ipsum dolor si', 50, 'Q3A'),
('pengakuan', 'Q3', 'pengakuan. Lorem ipsum dolor si', 20, 'Q3B'),
('penerimaan', 'Q3', 'penerimaan. Lorem ipsum dolor si', 20, 'Q3C'),
('kontrol', 'Q3', 'kontrol. Lorem ipsum dolor si', 40, 'Q3D'),
('kuasa', 'Q3', 'kuasa. Lorem ipsum dolor si', 40, 'Q3E'),
('superioritas', 'Q3', 'superioritas. Lorem ipsum dolor si', 30, 'Q3F'),
('kebebasan', 'Q3', 'kebebasan. Lorem ipsum dolor si', 20, 'Q3G'),
('kenyamanan', 'Q4', 'kenyamanan. Lorem ipsum dolor si', 50, 'Q4A'),
('pengakuan', 'Q4', 'pengakuan. Lorem ipsum dolor si', 20, 'Q4B'),
('penerimaan', 'Q4', 'penerimaan. Lorem ipsum dolor si', 20, 'Q4C'),
('kontrol', 'Q4', 'kontrol. Lorem ipsum dolor si', 40, 'Q4D'),
('kuasa', 'Q4', 'kuasa. Lorem ipsum dolor si', 40, 'Q4E'),
('superioritas', 'Q4', 'superioritas. Lorem ipsum dolor si', 30, 'Q4F'),
('kebebasan', 'Q4', 'kebebasan. Lorem ipsum dolor si', 20, 'Q4G'),
('kenyamanan', 'Q5', 'kenyamanan. Lorem ipsum dolor si', 50, 'Q5A'),
('pengakuan', 'Q5', 'pengakuan. Lorem ipsum dolor si', 20, 'Q5B'),
('penerimaan', 'Q5', 'penerimaan. Lorem ipsum dolor si', 20, 'Q5C'),
('kontrol', 'Q5', 'kontrol. Lorem ipsum dolor si', 40, 'Q5D'),
('kuasa', 'Q5', 'kuasa. Lorem ipsum dolor si', 40, 'Q5E'),
('superioritas', 'Q5', 'superioritas. Lorem ipsum dolor si', 30, 'Q5F'),
('kebebasan', 'Q5', 'kebebasan. Lorem ipsum dolor si', 20, 'Q5G'),
('kenyamanan', 'Q6', 'kenyamanan. Lorem ipsum dolor si', 50, 'Q6A'),
('pengakuan', 'Q6', 'pengakuan. Lorem ipsum dolor si', 20, 'Q6B'),
('penerimaan', 'Q6', 'penerimaan. Lorem ipsum dolor si', 20, 'Q6C'),
('kontrol', 'Q6', 'kontrol. Lorem ipsum dolor si', 40, 'Q6D'),
('kuasa', 'Q6', 'kuasa. Lorem ipsum dolor si', 40, 'Q6E'),
('superioritas', 'Q6', 'superioritas. Lorem ipsum dolor si', 30, 'Q6F'),
('kebebasan', 'Q6', 'kebebasan. Lorem ipsum dolor si', 20, 'Q6G'),
('kenyamanan', 'Q7', 'kenyamanan. Lorem ipsum dolor si', 50, 'Q7A'),
('pengakuan', 'Q7', 'pengakuan. Lorem ipsum dolor si', 20, 'Q7B'),
('penerimaan', 'Q7', 'penerimaan. Lorem ipsum dolor si', 20, 'Q7C'),
('kontrol', 'Q7', 'kontrol. Lorem ipsum dolor si', 40, 'Q7D'),
('kuasa', 'Q7', 'kuasa. Lorem ipsum dolor si', 40, 'Q7E'),
('superioritas', 'Q7', 'superioritas. Lorem ipsum dolor si', 30, 'Q7F'),
('kebebasan', 'Q7', 'kebebasan. Lorem ipsum dolor si', 20, 'Q7G'),
('kenyamanan', 'Q8', 'kenyamanan. Lorem ipsum dolor si', 50, 'Q8A'),
('pengakuan', 'Q8', 'pengakuan. Lorem ipsum dolor si', 20, 'Q8B'),
('penerimaan', 'Q8', 'penerimaan. Lorem ipsum dolor si', 20, 'Q8C'),
('kontrol', 'Q8', 'kontrol. Lorem ipsum dolor si', 40, 'Q8D'),
('kuasa', 'Q8', 'kuasa. Lorem ipsum dolor si', 40, 'Q8E'),
('superioritas', 'Q8', 'superioritas. Lorem ipsum dolor si', 30, 'Q8F'),
('kebebasan', 'Q8', 'kebebasan. Lorem ipsum dolor si', 20, 'Q8G'),
('kenyamanan', 'Q9', 'kenyamanan. Lorem ipsum dolor si', 50, 'Q9A'),
('pengakuan', 'Q9', 'pengakuan. Lorem ipsum dolor si', 20, 'Q9B'),
('penerimaan', 'Q9', 'penerimaan. Lorem ipsum dolor si', 20, 'Q9C'),
('kontrol', 'Q9', 'kontrol. Lorem ipsum dolor si', 40, 'Q9D'),
('kuasa', 'Q9', 'kuasa. Lorem ipsum dolor si', 40, 'Q9E'),
('superioritas', 'Q9', 'superioritas. Lorem ipsum dolor si', 30, 'Q9F'),
('kebebasan', 'Q9', 'kebebasan. Lorem ipsum dolor si', 20, 'Q9G'),
('kenyamanan', 'Q10', 'kenyamanan. Lorem ipsum dolor si', 50, 'Q10'),
('pengakuan', 'Q10', 'pengakuan. Lorem ipsum dolor si', 20, 'Q10'),
('penerimaan', 'Q10', 'penerimaan. Lorem ipsum dolor si', 20, 'Q10'),
('kontrol', 'Q10', 'kontrol. Lorem ipsum dolor si', 40, 'Q10'),
('kuasa', 'Q10', 'kuasa. Lorem ipsum dolor si', 40, 'Q10'),
('superioritas', 'Q10', 'superioritas. Lorem ipsum dolor si', 30, 'Q10'),
('kebebasan', 'Q10', 'kebebasan. Lorem ipsum dolor si', 20, 'Q10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`category`) VALUES
('kenyamanan'),
('pengakuan'),
('penerimaan'),
('kontrol'),
('kuasa'),
('superioritas'),
('kebebasan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `questions`
--

CREATE TABLE `questions` (
  `id` varchar(3) NOT NULL,
  `question` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `questions`
--

INSERT INTO `questions` (`id`, `question`) VALUES
('Q1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Bonum liberi: misera orbitas. At hoc in eo M. Ea possunt paria non esse. Inde igitur, inquit, ordiendum est. Hunc vos beatum; Sumenda potius quam expetenda. \n\n'),
('Q10', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Bonum liberi: misera orbitas. At hoc in eo M. Ea possunt paria non esse. Inde igitur, inquit, ordiendum est. Hunc vos beatum; Sumenda potius quam expetenda. \n\n'),
('Q2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Bonum liberi: misera orbitas. At hoc in eo M. Ea possunt paria non esse. Inde igitur, inquit, ordiendum est. Hunc vos beatum; Sumenda potius quam expetenda. \n\n'),
('Q3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Bonum liberi: misera orbitas. At hoc in eo M. Ea possunt paria non esse. Inde igitur, inquit, ordiendum est. Hunc vos beatum; Sumenda potius quam expetenda. \n\n'),
('Q4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Bonum liberi: misera orbitas. At hoc in eo M. Ea possunt paria non esse. Inde igitur, inquit, ordiendum est. Hunc vos beatum; Sumenda potius quam expetenda. \n\n'),
('Q5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Bonum liberi: misera orbitas. At hoc in eo M. Ea possunt paria non esse. Inde igitur, inquit, ordiendum est. Hunc vos beatum; Sumenda potius quam expetenda. \n\n'),
('Q6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Bonum liberi: misera orbitas. At hoc in eo M. Ea possunt paria non esse. Inde igitur, inquit, ordiendum est. Hunc vos beatum; Sumenda potius quam expetenda. \n\n'),
('Q7', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Bonum liberi: misera orbitas. At hoc in eo M. Ea possunt paria non esse. Inde igitur, inquit, ordiendum est. Hunc vos beatum; Sumenda potius quam expetenda. \n\n'),
('Q8', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Bonum liberi: misera orbitas. At hoc in eo M. Ea possunt paria non esse. Inde igitur, inquit, ordiendum est. Hunc vos beatum; Sumenda potius quam expetenda. \n\n'),
('Q9', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Bonum liberi: misera orbitas. At hoc in eo M. Ea possunt paria non esse. Inde igitur, inquit, ordiendum est. Hunc vos beatum; Sumenda potius quam expetenda. \n\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `results`
--

CREATE TABLE `results` (
  `nrp` varchar(9) DEFAULT NULL,
  `kenyamanan` decimal(4,1) DEFAULT NULL,
  `pengakuan` decimal(4,1) DEFAULT NULL,
  `penerimaan` decimal(4,1) DEFAULT NULL,
  `kontrol` decimal(4,1) DEFAULT NULL,
  `kuasa` decimal(4,1) DEFAULT NULL,
  `superioritas` decimal(4,1) DEFAULT NULL,
  `kebebasan` decimal(4,1) DEFAULT NULL,
  `full_result` varchar(255) DEFAULT NULL,
  `tops` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `nrp` varchar(9) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`nrp`, `password`) VALUES
('demo1', 'demo1'),
('demo2', 'demo2'),
('demo3', 'demo3'),
('demo4', 'demo4'),
('demo5', 'demo5'),
('demo6', 'demo6');

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
  ADD KEY `nrp` (`nrp`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`nrp`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`q_id`) REFERENCES `questions` (`id`);

--
-- Ketidakleluasaan untuk tabel `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`nrp`) REFERENCES `users` (`nrp`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
