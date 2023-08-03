-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 09, 2023 at 07:30 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `melomaniac`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `album_id` int(11) NOT NULL,
  `album_name` varchar(30) NOT NULL,
  `release_date` date NOT NULL,
  `thumbnail_url` varchar(100) NOT NULL,
  `artist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`album_id`, `album_name`, `release_date`, `thumbnail_url`, `artist_id`) VALUES
(1, 'Divide', '2017-03-03', 'assets/album-art/Divide.png', 1),
(2, 'Daddy K - The Mix 12', '2018-09-12', 'assets/album-art/Daddy-K-The-Mix-12.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
  `artist_id` int(11) NOT NULL,
  `artist_name` varchar(50) NOT NULL,
  `artist_description` varchar(1500) NOT NULL,
  `email` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `profile_pic_url` varchar(100) NOT NULL,
  `cover_pic_url` varchar(100) NOT NULL,
  `plan_id` char(2) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `card_number` varchar(20) NOT NULL,
  `expiry_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`artist_id`, `artist_name`, `artist_description`, `email`, `city`, `country`, `profile_pic_url`, `cover_pic_url`, `plan_id`, `username`, `password`, `card_number`, `expiry_date`) VALUES
(1, 'Ed Sheeran', 'Ed Sheeran is a highly acclaimed British singer-songwriter known for his heartfelt and relatable music. Born on February 17, 1991, in Halifax, West Yorkshire, England, Sheeran began his musical journey at a young age, honing his skills as a guitarist and vocalist. His style encompasses elements of pop, folk, and acoustic music, which blend seamlessly with his introspective and emotive songwriting.\r\nSheeran gained significant recognition with the release of his debut studio album \"+ (Plus)\" in 2011, featuring chart-topping hits like \"The A Team\" and \"Lego House.\" His soulful voice, coupled with his ability to weave poignant narratives into his songs, struck a chord with audiences worldwide. Since then, Sheeran has continued to produce critically acclaimed albums, including \"x (Multiply)\" in 2014 and \"÷ (Divide)\" in 2017.', 'edsheeran91@gmail.com', 'London', 'United Kingdom', 'assets/artist-art/Ed_Sheeran.jpg', 'assets/artist-art/Ed_Sheeran.jpg', 'A2', 'ed_sheeran', 'EdS1234', '2134-89-234-33', '2026-07-22'),
(2, 'Daddy Yankee', 'Daddy Yankee is a Puerto Rican singer, songwriter, and rapper who is widely recognized as one of the pioneers of reggaeton music. Born on February 3, 1977, in San Juan, Puerto Rico, his real name is Ramón Luis Ayala Rodríguez. Known for his charismatic style and energetic performances, Daddy Yankee has had a profound impact on the global popularity of reggaeton, blending urban beats with catchy melodies. With his breakthrough hit \"Gasolina\" in 2004, he achieved international fame and became a prominent figure in the Latin music industry. Throughout his career, Daddy Yankee has continued to produce hit songs, collaborate with renowned artists, and push the boundaries of reggaeton, solidifying his position as one of the genre\'s most influential and successful artists.', 'dyankee@gmail.com', 'San Juan', 'Puerto Rico', 'assets/artist-art/Daddy-Yankee.jpg', 'assets/artist-art/Daddy-Yankee.jpg', 'A2', 'daddy_yankee', 'dad1234', '345-7890-89-11', '2024-03-04');

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `listener_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `alerts` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`listener_id`, `artist_id`, `alerts`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `listener`
--

CREATE TABLE `listener` (
  `listener_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `profile_pic` varchar(100) DEFAULT NULL,
  `subscription_status` tinyint(1) NOT NULL,
  `plan_id` char(2) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `card_number` varchar(20) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `listener`
--

INSERT INTO `listener` (`listener_id`, `first_name`, `last_name`, `email`, `city`, `country`, `profile_pic`, `subscription_status`, `plan_id`, `username`, `password`, `card_number`, `expiry_date`) VALUES
(1, 'Robert', 'Pattinson', 'robertp@gmail.com', 'New York', 'United States of America', NULL, 1, 'U2', 'robert89', 'robert1234', '4567-234-12-11', '2025-07-01');

-- --------------------------------------------------------

--
-- Table structure for table `listener_song`
--

CREATE TABLE `listener_song` (
  `listener_id` int(11) NOT NULL,
  `song_id` int(11) NOT NULL,
  `play_count` int(11) NOT NULL,
  `download_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `listener_song`
--

INSERT INTO `listener_song` (`listener_id`, `song_id`, `play_count`, `download_status`) VALUES
(1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `playlist_id` int(11) NOT NULL,
  `listener_id` int(11) NOT NULL,
  `song_id` int(11) NOT NULL,
  `play_list_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`playlist_id`, `listener_id`, `song_id`, `play_list_name`) VALUES
(1, 1, 1, 'Favourites');

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

CREATE TABLE `song` (
  `song_id` int(11) NOT NULL,
  `song_name` varchar(50) NOT NULL,
  `genre` varchar(20) NOT NULL,
  `track_id` int(11) NOT NULL,
  `lyrics` varchar(5000) NOT NULL,
  `collaborating_artists` varchar(100) NOT NULL,
  `thumbnail_url` varchar(100) NOT NULL,
  `play_count` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `download_count` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`song_id`, `song_name`, `genre`, `track_id`, `lyrics`, `collaborating_artists`, `thumbnail_url`, `play_count`, `album_id`, `download_count`, `artist_id`) VALUES
(1, 'Castle on the Hill', 'Pop1', 13, '[00:02.00]Castle on the Hill by Ed Sheeran\r\n[00:07.81]When I was six years old I broke my leg        \r\n[00:14.82]I was running from my brother and his friends \r\n[00:21.82]And tasted the sweet perfume of the mountain grass I rolled down\r\n[00:29.32]I was younger then, take me back to when I \r\n[00:36.14]Found my heart and broke it here \r\n[00:39.36]Made friends and lost them through the years \r\n[00:43.38]And I\'ve not seen the roaring fields in so long, I know I\'ve grown \r\n[00:50.62]But I can\'t wait to go home \r\n[00:53.13]I\'m on my way \r\n[00:56.88]Driving at ninety down those country lanes \r\n[01:03.88]Singing to \'Tiny Dancer\' \r\n[01:07.37]And I miss the way you make me feel, and it\'s real \r\n[01:14.61]We watched the sunset over the castle on the hill \r\n[01:26.13]Fifteen years old and smoking hand-rolled cigarettes \r\n[01:33.12]Running from the law through the backfields and getting drunk with my friends \r\n[01:40.14]Had my first kiss on a Friday night, I don\'t reckon that I did it right \r\n[01:47.37]But I was younger then, take me back to when \r\n[01:52.89]We found weekend jobs, when we got paid \r\n[01:57.61]We\'d buy cheap spirits and drink them straight \r\n[02:01.62]Me and my friends have not thrown up in so long, oh how we\'ve grown \r\n[02:08.61]But I can\'t wait to go home \r\n[02:11.36]I\'m on my way \r\n[02:15.11]Driving at ninety down those country lanes \r\n[02:22.11]Singing to \'Tiny Dancer\' \r\n[02:25.60]And I miss the way you make me feel, and it\'s real\r\n[02:32.88]We watched the sunset over the castle on the hill \r\n[02:43.36]Over the castle on the hill \r\n[02:50.36]Over the castle on the hill \r\n[03:02.12]One friend left to sell clothes \r\n[03:05.35]One works down by the coast \r\n[03:09.10]One had two kids but lives alone \r\n[03:12.86]One\'s brother overdosed \r\n[03:16.35]One\'s already on his second wife \r\n[03:20.12]One\'s just barely getting by \r\n[03:22.89]But these people raised me and I can\'t wait to go home \r\n[03:29.60]And I\'m on my way, I still remember \r\n[03:36.61]This old country lanes \r\n[03:40.11]When we did not know the answers \r\n[03:43.86]And I miss the way you make me feel, it\'s real \r\n[03:51.85]We watched the sunset over the castle on the hill \r\n[03:54.86]Over the castle on the hill \r\n[04:08.60]Over the castle on the hill', '', 'assets/album-art/Divide.png', 0, 1, 0, 1),
(2, 'Dura', 'Latin Urbano', 3, '[00:02.00]Dura by Daddy Yankee\r\n[00:09.92]Me gusta mi reggae \r\n[00:14.90]Tiritiritiririti-Daddy \r\n[00:19.41]Evo Jedis \r\n[00:20.66]Cuando yo la vi \r\n[00:23.15]Dije \'si esa mujer fuera para mi\' \r\n[00:26.91]Perdoname, te lo tenia que decir \r\n[00:30.40]Estas dura, dura \r\n[00:33.15]dura, dura, dura \r\n[00:35.17]Que estas dura, mano arriba porque tu te ves bien \r\n[00:38.18]Estas dura mamacita, te fuiste de nivel \r\n[00:40.67]Dura, mira como brilla tu piel \r\n[00:43.41]Estas dura, dimelo dimelo como es que es? \r\n[00:45.66]Estas dura, yo te doy un veinte de diez \r\n[00:48.15]Estas dura, dura, dura \r\n[00:50.40]Tu eres la maquina, la maquina de baile \r\n[00:52.92]Si no tiene a nadie vente pa\' mi\' brazos, caile \r\n[00:55.42]Ese perfume se siente en el aire \r\n[00:58.16]Algo como Argentina, tu me traes los Buenos Aires \r\n[01:00.65]Esta poderosa, media escandalosa \r\n[01:03.15]Habran muchas mujeres pero tu eres otra cosa \r\n[01:06.16]Si fuera un delito eso de que estas hermosa \r\n[01:08.15]Te arresto en mi cama y te pongo las esposas \r\n[01:11.15]Tienes el toque, toque, toque \r\n[01:13.17]Miren el material, edicion especial \r\n[01:15.67]Tienes el toque, toque, toque \r\n[01:18.17]Perdoname, te lo tenia que decir \r\n[01:21.15]Estas dura, dura \r\n[01:23.65]dura, dura, dura \r\n[01:25.90]Que estas dura, mano arriba porque tu te ves bien \r\n[01:28.66]Estas dura mamacita, te fuiste de nivel \r\n[01:31.40]Dura, mira como brilla tu piel \r\n[01:33.66]Estas dura, dimelo dimelo como es que es? \r\n[01:36.65]Estas dura, yo te doy un veinte de diez \r\n[01:38.92]Estas dura, dura, dura \r\n[01:40.90]Me gusta como mueve ese ram pam pam \r\n[01:43.40]Mi mente maquineando en un plan plan plan \r\n[01:45.91]Si me deja, en esa curva le doy pam pam \r\n[01:48.64]Cual es tu receta no se, esta pa\' comerte bien \r\n[01:51.16]Me gusta como mueve ese ram pam pam \r\n[01:53.65]Mi mente maquineando en un plan plan plan \r\n[01:56.15]Si me deja, en esa curva le doy pam pam \r\n[01:58.40]Tu belleza retumba, las otras pa\' la tumba \r\n[02:01.15]Uno, dos y tres vamo\' a darle \r\n[02:03.04]La envidia que se calle \r\n[02:04.33]Saludos a todas las nenas que paralizan la calle \r\n[02:06.80]¿Como tu te llamas? ¿de donde tu eres? \r\n[02:09.30]Dame el numero pare entrar contigo en detalles \r\n[02:11.44]Y tienes el toque, toque, toque \r\n[02:13.94]Pareces una estrella formando el alboroto \r\n[02:16.17]Tienes el toque, toque, toque \r\n[02:18.90]Se cae el internet cuando subes una foto \r\n[02:21.40]Cuando yo la vi \r\n[02:24.39]Dije: \'si esa mujer fuera para mi\' \r\n[02:27.40]Perdoname, te lo tenia que decir \r\n[02:31.89]Estas dura, dura, \r\n[02:34.64]dura, dura, dura \r\n[02:36.41]Que estas dura, mano arriba porque tu te ves bien \r\n[02:39.39]Estas dura mamacita, te fuiste de nivel \r\n[02:42.14]Dura, mira como brilla tu piel \r\n[02:44.40]Estas dura, dimelo dimelo ¿como es que es? \r\n[02:47.15]Estas dura, yo te doy un veinte de diez \r\n[02:49.64]Estas dura, dura, dura \r\n[02:52.15]Tu tienes el size, otra como tu mami no hay \r\n[02:54.90]Pegate, dale boom bye bye \r\n[02:56.64]Que tu tienes el size, otra como tu mami no hay \r\n[02:59.90]Pegate, dale boom bye bye \r\n[03:01.92]Que tu tienes el size, otra como tu mami no hay \r\n[03:04.64]Pegate, dale boom bye bye \r\n[03:06.90]Que tu tienes el size, otra como tu mami no hay \r\n[03:09.40]Pegate, dale boom bye bye, yep, yeah \r\n[03:12.40]Retumbando las bocinas de seguro \r\n[03:15.15]Da-da-da-Daddy Yankee y el Disco Duro \r\n[03:18.14]Urba y Rome \r\n[03:19.14]Que pa\' esta liga no se asomen \r\n[03:20.39]Dura, dura, dura (DY) \r\n[03:22.16]Blaze (Los Evo Jedis)', '', 'assets/album-art/Daddy-K-The-Mix-12.jpg', 0, 2, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `plan_id` char(2) NOT NULL,
  `plan_name` varchar(30) NOT NULL,
  `price` float NOT NULL,
  `plan_type` varchar(10) NOT NULL,
  `purchase_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`plan_id`, `plan_name`, `price`, `plan_type`, `purchase_count`) VALUES
('A1', 'Monthly', 300, 'Artist', 0),
('A2', 'Yearly', 3000, 'Artist', 0),
('U1', 'Individual ', 529, 'User', 0),
('U2', 'Duo', 679, 'User', 1),
('U3', 'Family', 849, 'User', 0),
('U4', 'Student', 265, 'User', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`album_id`),
  ADD KEY `artist_id` (`artist_id`);

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`artist_id`),
  ADD KEY `plan_id` (`plan_id`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`listener_id`),
  ADD KEY `artist_id` (`artist_id`);

--
-- Indexes for table `listener`
--
ALTER TABLE `listener`
  ADD PRIMARY KEY (`listener_id`),
  ADD KEY `plan_id` (`plan_id`);

--
-- Indexes for table `listener_song`
--
ALTER TABLE `listener_song`
  ADD KEY `listener_id` (`listener_id`),
  ADD KEY `song_id` (`song_id`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`playlist_id`),
  ADD KEY `listener_id` (`listener_id`),
  ADD KEY `song_id` (`song_id`);

--
-- Indexes for table `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`song_id`),
  ADD KEY `album_id` (`album_id`),
  ADD KEY `artist_id` (`artist_id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`plan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
  MODIFY `artist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `listener`
--
ALTER TABLE `listener`
  MODIFY `listener_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `playlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `song`
--
ALTER TABLE `song`
  MODIFY `song_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`artist_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `artist`
--
ALTER TABLE `artist`
  ADD CONSTRAINT `artist_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `subscription` (`plan_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`artist_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `follow_ibfk_2` FOREIGN KEY (`listener_id`) REFERENCES `listener` (`listener_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `listener`
--
ALTER TABLE `listener`
  ADD CONSTRAINT `listener_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `subscription` (`plan_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `listener_song`
--
ALTER TABLE `listener_song`
  ADD CONSTRAINT `listener_song_ibfk_1` FOREIGN KEY (`listener_id`) REFERENCES `listener` (`listener_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `listener_song_ibfk_2` FOREIGN KEY (`song_id`) REFERENCES `song` (`song_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist_ibfk_1` FOREIGN KEY (`listener_id`) REFERENCES `listener` (`listener_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `playlist_ibfk_2` FOREIGN KEY (`song_id`) REFERENCES `song` (`song_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `song`
--
ALTER TABLE `song`
  ADD CONSTRAINT `song_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `album` (`album_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `song_ibfk_2` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`artist_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
