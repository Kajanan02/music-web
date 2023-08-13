-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 13, 2023 at 08:28 AM
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
  `album_name` varchar(128) NOT NULL,
  `release_date` date NOT NULL,
  `thumbnail_url` varchar(100) NOT NULL DEFAULT 'path_to_album_art',
  `artist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`album_id`, `album_name`, `release_date`, `thumbnail_url`, `artist_id`) VALUES
(1, 'Divide', '2017-03-03', 'assets/album-art/1.png', 1),
(2, 'Daddy K - The Mix 12', '2018-09-12', 'assets/album-art/2.jpg', 2),
(13, 'X', '2014-06-20', 'assets/album-art/13.png', 1),
(14, 'Origins', '2018-11-09', 'assets/album-art/14.png', 5),
(15, 'Mercury Act 2', '2022-03-11', 'assets/album-art/15.jpg', 5),
(16, 'Smoke + Mirrors', '2015-02-17', 'assets/album-art/16.png', 5),
(17, 'All the Way... A Decade of Song', '1999-11-12', 'assets/album-art/17.jpg', 16),
(18, '1989', '2014-10-27', 'assets/album-art/18.png', 15);

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
  `artist_id` int(11) NOT NULL,
  `artist_name` varchar(50) NOT NULL,
  `artist_description` varchar(1500) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `profile_pic_url` varchar(100) DEFAULT NULL,
  `cover_pic_url` varchar(100) DEFAULT NULL,
  `plan_id` char(2) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`artist_id`, `artist_name`, `artist_description`, `email`, `city`, `country`, `profile_pic_url`, `cover_pic_url`, `plan_id`, `username`, `password`) VALUES
(1, 'Ed Sheeran', 'Ed Sheeran is a highly acclaimed British singer-songwriter known for his heartfelt and relatable music. Born on February 17, 1991, in Halifax, West Yorkshire, England, Sheeran began his musical journey at a young age, honing his skills as a guitarist and vocalist. His style encompasses elements of pop, folk, and acoustic music, which blend seamlessly with his introspective and emotive songwriting.\r\nSheeran gained significant recognition with the release of his debut studio album \"+ (Plus)\" in 2011, featuring chart-topping hits like \"The A Team\" and \"Lego House.\" His soulful voice, coupled with his ability to weave poignant narratives into his songs, struck a chord with audiences worldwide. Since then, Sheeran has continued to produce critically acclaimed albums, including \"x (Multiply)\" in 2014 and \"÷ (Divide)\" in 2017.', 'edsheeran91@gmail.com', 'New England', 'United Kingdom', 'assets/artist-art/1.jpg', 'assets/cover-art/1.jpg', 'A2', 'ed_sheeran', '$2y$10$FHV4PEe3EbL8XNjOlTSmG.wTfqEv/BQa73.4WiO8jR16Secec3OTG'),
(2, 'Daddy Yankee', 'Daddy Yankee is a Puerto Rican singer, songwriter, and rapper who is widely recognized as one of the pioneers of reggaeton music. Born on February 3, 1977, in San Juan, Puerto Rico, his real name is Ramón Luis Ayala Rodríguez. Known for his charismatic style and energetic performances, Daddy Yankee has had a profound impact on the global popularity of reggaeton, blending urban beats with catchy melodies. With his breakthrough hit \"Gasolina\" in 2004, he achieved international fame and became a prominent figure in the Latin music industry. Throughout his career, Daddy Yankee has continued to produce hit songs, collaborate with renowned artists, and push the boundaries of reggaeton, solidifying his position as one of the genre\'s most influential and successful artists.', 'dyankee@gmail.com', 'San Juan', 'Puerto Rico', 'assets/artist-art/2.jpg', 'assets/cover-art/2.jpg', 'A2', 'daddy_yankee', '$2y$10$Wvi/z4qFa6.D1azaJwqx6OidyvmcaZDGl1ogMj.AhcpoL8/cZKZlG'),
(3, 'Coldplay', 'Coldplay is a globally renowned British rock band that has captivated audiences with their emotive melodies, introspective lyrics, and atmospheric soundscapes. Formed in London in 1996, the band consists of Chris Martin (vocals, piano, guitar), Jonny Buckland (guitar), Guy Berryman (bass), and Will Champion (drums, percussion).\r\n<br>\r\nColdplay\'s music is characterized by its fusion of rock, pop, and alternative influences, often accompanied by Martin\'s distinct vocals and heartfelt songwriting. Their early albums, such as \"Parachutes\" and \"A Rush of Blood to the Head,\" garnered critical acclaim for their melancholic yet uplifting tunes. The band\'s ability to create anthemic and emotionally charged songs, such as \"Yellow,\" \"Clocks,\" and \"Fix You,\" has solidified their status as a global phenomenon.\r\n<br>\r\nOver the years, Coldplay has evolved its sound, incorporating electronic and experimental elements into albums like \"Viva la Vida or Death and All His Friends\" and \"Mylo Xyloto.\" Their willingness to innovate and push artistic boundaries has kept their music fresh and relevant.\r\n<br>\r\nIn addition to their musical prowess, Coldplay is known for their captivating live performances that often feature dazzling visual effects and audience engagement.', 'info@coldplayband.com', 'Los Angeles', 'United States', 'assets/artist-art/3.jpeg', 'assets/cover-art/3.jpg', 'A2', 'coldplay', '$2y$10$e7VbNOVWNS7km.v35Ucb9uQCAn0IpI47Y7EiRFivRJ2aK1eROLJXS'),
(5, 'Imagine Dragons', 'Imagine Dragons is an American rock band that has made a significant impact on the music scene with their distinctive sound and anthemic songs. Formed in Las Vegas in 2008, the band consists of lead vocalist Dan Reynolds, guitarist Wayne Sermon, bassist Ben McKee, and drummer Daniel Platzman.\r\n<br>\r\nKnown for their blend of rock, pop, and electronic elements, Imagine Dragons has created a sound that is both energetic and introspective. Their breakout single \"Radioactive\" catapulted them to fame, showcasing their ability to craft catchy melodies and powerful choruses. The band\'s music often explores themes of empowerment, resilience, and personal struggles.\r\n<br>\r\nImagine Dragons\' albums, including \"Night Visions,\" \"Smoke + Mirrors,\" and \"Evolve,\" have produced chart-topping hits such as \"Demons,\" \"Believer,\" and \"Thunder.\" Their music is characterized by its emotive lyrics, dynamic instrumentation, and Dan Reynolds\' distinctive vocal delivery.\r\n<br>\r\nThe band\'s electrifying live performances have also become a trademark, drawing audiences with their high-energy stage presence and memorable shows. They have received multiple Grammy Awards nominations and have gained a massive global following.', 'hello@imaginedragons.com', 'San Fransisco', 'United States', 'assets/artist-art/5.jpeg', 'assets/cover-art/5.jpg', 'A2', 'imagine_dragons', '$2y$10$j2Aj7jtGkMj88ry1rcob5OTXtP2kQxWONHcsk5J54I85J39cW3oKu'),
(15, 'Taylor Swift', 'Taylor Swift is a renowned American singer-songwriter whose remarkable career has spanned multiple genres and earned her a dedicated global fan base. Born in 1989 in Reading, Pennsylvania, Swift\'s journey from country sensation to pop superstar has been marked by her exceptional songwriting talent and relatable storytelling.\r\n<br>\r\nSwift\'s early success came in the country music scene, with hits like \"Tim McGraw\" and \"Love Story\" showcasing her knack for weaving personal experiences into catchy tunes. She transitioned into pop music with her album \"1989,\" which included chart-toppers like \"Shake It Off\" and \"Blank Space,\" solidifying her status as a pop icon.\r\n<br>\r\nKnown for her honest and introspective lyrics, Swift often draws from her own life, relationships, and emotions. Her albums, including \"Red,\" \"Speak Now,\" and \"Fearless,\" have earned critical acclaim and numerous awards, including multiple Grammy wins.\r\n<br>\r\nBeyond her music, Swift is recognized for her advocacy on issues such as gender equality and artists\' rights. She has used her platform to champion causes close to her heart and has been an influential voice in the music industry.', 'taylor@taylorswiftmusic.com', 'Las Vegas', 'United States', 'assets/artist-art/15.jpeg', 'assets/cover-art/15.jpg', 'A2', 'taylorSwift', '$2y$10$NXNxZiLUbNxUiBahNz3lf.vFxC3mT08M2itq999jfuS8jphR3Vx5C'),
(16, 'Celine Dion', 'Celine Dion is a Canadian music icon renowned for her powerful and emotive voice that has touched hearts across the globe. Born in Charlemagne, Quebec, in 1968, Dion\'s extraordinary vocal range and heartfelt delivery have made her one of the best-selling artists of all time.\r\n<br>\r\nDion\'s rise to fame began at a young age, and she gained international recognition after winning the Eurovision Song Contest in 1988 with the song \"Ne partez pas sans moi.\" However, it was her contributions to the soundtrack of the blockbuster film \"Titanic\" with the iconic song \"My Heart Will Go On\" that catapulted her to international superstardom.\r\n<br>\r\nHer music spans various genres, from pop and ballads to adult contemporary, and her albums have consistently topped charts around the world. Dion\'s ability to convey raw emotions through her vocals has led to unforgettable hits like \"The Power of Love,\" \"Because You Loved Me,\" and \"It\'s All Coming Back to Me Now.\"\r\n<br>\r\nIn addition to her music career, Dion\'s residency at Caesars Palace in Las Vegas became one of the most successful and enduring shows in entertainment history. Her performances showcased not only her vocal prowess but also her engaging stage presence and charismatic personality.', 'celinedion@gmail.com', 'Toronto', 'Canada', 'assets/artist-art/16.jpeg', 'assets/cover-art/16.jpg', 'A2', 'celine_dion', '$2y$10$naoZshug8xYeCO.xyJfBjOEUMehl0.vPSS34LuBlv98S8/bM7nnEK'),
(17, 'CNCO', 'CNCO is a Latin American boy band that has taken the music world by storm with their infectious rhythms and charismatic presence. Formed in 2015 as the result of a singing competition called \"La Banda,\" CNCO comprises five talented members: Christopher Vélez, Richard Camacho, Zabdiel De Jesús, Joel Pimentel, and Erick Brian Colón.\r\n<br>\r\nHailing from different countries such as the Dominican Republic, Ecuador, Puerto Rico, Mexico, and Cuba, CNCO\'s diverse backgrounds contribute to their unique sound that seamlessly blends Latin pop, reggaeton, and R&B. The band\'s harmonious vocals and energetic performances have captured the hearts of fans across Latin America and beyond.\r\n<br>\r\nCNCO gained rapid recognition with their debut single \"Tan Fácil,\" and subsequent hits like \"Reggaetón Lento (Bailemos)\" and \"Hey DJ\" solidified their status as a rising force in the Latin music scene. Their music is marked by catchy melodies, danceable beats, and lyrics that often explore themes of love and youthful exuberance.\r\n<br>\r\nThe group\'s dedication to their craft and their passionate fan base, known as \"CNCOwners,\" have contributed to their widespread success. They have received numerous awards and accolades, including Latin Grammy nominations and Billboard Latin Music Awards.', 'cnco_band@cnco.com', 'Madrid', 'Spain', 'assets/artist-art/17.jpg', 'assets/cover-art/17.jpg', 'A2', 'cnco', '$2y$10$/xDMZoKnVXa1bjjid47fVO.b/YjG..WwSwfEMn7f8H8OyXOBLqQBK');

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
  `profile_pic` varchar(100) DEFAULT NULL,
  `subscription_status` tinyint(1) NOT NULL,
  `plan_id` char(2) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `card_number` varchar(20) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `listener`
--

INSERT INTO `listener` (`listener_id`, `first_name`, `last_name`, `email`, `profile_pic`, `subscription_status`, `plan_id`, `username`, `password`, `card_number`, `expiry_date`) VALUES
(1, 'Robert', 'Pattinson', 'robertp@gmail.com', NULL, 1, 'U2', 'robert89', '$2y$10$vlWYnQGoZCCkzWbPwFY3eeAMmSBjRtnCyYIxNIsiyizTEcUDsjTWe', '4567-234-12-11', '2025-07-01'),
(2, 'Hannah', 'Stine', 'hannahstine@gmail.com', NULL, 0, NULL, 'hannah02', '$2y$10$vlWYnQGoZCCkzWbPwFY3eeAMmSBjRtnCyYIxNIsiyizTEcUDsjTWe', NULL, NULL),
(3, 'Test', 'User', 'test@melomanic.com', NULL, 0, NULL, 'testuser', '$2y$10$4qoGy3SOQJFdMV.NVXqhJ.9YoSFBDI91lZkiPqVG3N3ep42EPwkTq', NULL, NULL),
(4, 'Admin', 'User', 'admin@melomaniac.com', NULL, 0, NULL, 'admin', '$2y$10$AaA4MWd15VEIcTZBITpdR.W9Y0B/l5QZmhig74sdcKg/fYPa8/aie', NULL, NULL),
(5, 'Mark', 'Jacob', 'mjacob@gmail.com', NULL, 0, NULL, 'markJ', '$2y$10$GKmjjAtiPLsndT/el7/CXeAnVlm2bqWu0.75POhBMHtOMTByd8NN6', NULL, NULL),
(6, 'Mark', 'Peterson', 'peterson@gmail.com', NULL, 0, NULL, '#peter', '$2y$10$Wvi/z4qFa6.D1azaJwqx6OidyvmcaZDGl1ogMj.AhcpoL8/cZKZlG', NULL, NULL),
(7, 'Robert', 'Gorden', 'robertgorden@foodnetwork.com', NULL, 0, NULL, 'r_gorden', '$2y$10$XE9d6fGC/I/cGD//s49.r.BSAk3gNYSozvCOQJgPIeObORc/l19Fu', NULL, NULL);

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
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `txn_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `plan_id` char(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `artist_id` int(11) NOT NULL,
  `currency_code` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `txn_id`, `plan_id`, `artist_id`, `currency_code`, `payment_status`) VALUES
(1, 'FLSQVGRHBFBVA', 'A2', 4, 'USD', 'Complete'),
(2, 'FLSQVGRHBFBVA', 'A2', 5, 'USD', 'Complete'),
(4, 'FLSQVGRHBFBVA', 'A2', 15, 'USD', 'Complete'),
(5, 'FLSQVGRHBFBVA', 'A2', 16, 'USD', 'Complete'),
(6, 'FLSQVGRHBFBVA', 'A2', 17, 'USD', 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `playlist_id` int(11) NOT NULL,
  `listener_id` int(11) NOT NULL,
  `song_id` int(11) NOT NULL,
  `playlist_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`playlist_id`, `listener_id`, `song_id`, `playlist_name`) VALUES
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
  `audio` varchar(256) NOT NULL DEFAULT 'path_to_audio',
  `lyrics` varchar(128) NOT NULL DEFAULT 'path_to_lyrics_file',
  `collaborating_artists` varchar(100) NOT NULL,
  `play_count` int(11) NOT NULL DEFAULT 0,
  `album_id` int(11) NOT NULL,
  `download_count` int(11) NOT NULL DEFAULT 0,
  `artist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`song_id`, `song_name`, `genre`, `track_id`, `audio`, `lyrics`, `collaborating_artists`, `play_count`, `album_id`, `download_count`, `artist_id`) VALUES
(1, 'Castle on the Hill', 'Pop', 13, 'assets/audio/1.mp3', 'assets/lrc/1.lrc', '', 0, 1, 0, 1),
(2, 'Dura', 'Latin Urbano', 3, 'assets/audio/2.mp3', 'assets/lrc/2.lrc', '', 0, 2, 0, 2),
(5, 'Perfect', 'Pop', 5, 'assets/audio/5.mp3', 'assets/lrc/5.lrc', 'N/A', 0, 1, 0, 1),
(14, 'Barcelona', 'Pop', 13, 'assets/audio/14.mp3', 'assets/lrc/14.lrc', 'N/A', 0, 1, 0, 1),
(18, 'Photograph', 'Pop', 6, 'assets/audio/18.mp3', 'assets/lrc/18.lrc', 'N/A', 0, 13, 0, 1),
(19, 'Bad Liar', 'Rock', 5, 'assets/audio/19.mp3', 'assets/lrc/19.lrc', 'N/A', 0, 14, 0, 5),
(20, 'Natural', 'Rock', 1, 'assets/audio/20.mp3', 'assets/lrc/20.lrc', 'N/A', 0, 14, 0, 5),
(21, 'Symphony', 'Soft Rock', 2, 'assets/audio/21.mp3', 'assets/lrc/21.lrc', 'N/A', 0, 15, 0, 5),
(22, 'I Bet My Life', 'Rock', 5, 'assets/audio/22.mp3', 'assets/lrc/22.lrc', 'N/A', 0, 16, 0, 5),
(23, 'Shots', 'Rock', 1, 'assets/audio/23.mp3', 'assets/lrc/23.lrc', 'N/A', 0, 16, 0, 5),
(24, 'That\'s the way it is', 'Pop', 10, 'assets/audio/24.mp3', 'assets/lrc/24.lrc', 'N/A', 0, 17, 0, 16),
(25, 'Blankspace', 'Pop', 2, 'assets/audio/25.mp3', 'assets/lrc/25.lrc', 'N/A', 0, 18, 0, 15),
(26, 'Wonderland', 'Pop', 14, 'assets/audio/26.mp3', 'assets/lrc/26.lrc', 'N/A', 0, 18, 0, 15);

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
('A1', 'Monthly', 10, 'Artist', 0),
('A2', 'Yearly', 110, 'Artist', 7),
('U1', 'Individual ', 5, 'User', 0),
('U2', 'Duo', 8, 'User', 1),
('U3', 'Family', 25, 'User', 0),
('U4', 'Student', 4, 'User', 0);

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
  ADD UNIQUE KEY `artist_name` (`artist_name`),
  ADD UNIQUE KEY `username` (`username`),
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
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `plan_id` (`plan_id`);

--
-- Indexes for table `listener_song`
--
ALTER TABLE `listener_song`
  ADD KEY `song_id` (`song_id`),
  ADD KEY `listener_id` (`listener_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`playlist_id`),
  ADD KEY `song_id` (`song_id`),
  ADD KEY `listener_id` (`listener_id`);

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
  MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
  MODIFY `artist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `listener`
--
ALTER TABLE `listener`
  MODIFY `listener_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `playlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `song`
--
ALTER TABLE `song`
  MODIFY `song_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
  ADD CONSTRAINT `listener_song_ibfk_2` FOREIGN KEY (`song_id`) REFERENCES `song` (`song_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `listener_song_ibfk_3` FOREIGN KEY (`listener_id`) REFERENCES `listener` (`listener_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist_ibfk_2` FOREIGN KEY (`song_id`) REFERENCES `song` (`song_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `playlist_ibfk_3` FOREIGN KEY (`listener_id`) REFERENCES `listener` (`listener_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
