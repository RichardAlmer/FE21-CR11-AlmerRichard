-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 30. Apr 2021 um 22:47
-- Server-Version: 10.4.18-MariaDB
-- PHP-Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `cr11_petadoption_almerrichard`
--
CREATE DATABASE IF NOT EXISTS `cr11_petadoption_almerrichard` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cr11_petadoption_almerrichard`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `adoption`
--

CREATE TABLE `adoption` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `fk_user_id` int(11) DEFAULT NULL,
  `fk_pet_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `adoption`
--

INSERT INTO `adoption` (`id`, `date`, `fk_user_id`, `fk_pet_id`) VALUES
(9, '2021-05-09', 4, 5),
(10, '2021-05-12', 4, 1),
(11, '2021-05-18', 4, 11),
(15, '2021-05-05', 4, 13);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `animals`
--

CREATE TABLE `animals` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `size` varchar(255) NOT NULL,
  `species` varchar(255) NOT NULL,
  `breed` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `hobbies` varchar(255) NOT NULL,
  `zip` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '<font color=green>available</font>'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `animals`
--

INSERT INTO `animals` (`id`, `name`, `picture`, `size`, `species`, `breed`, `age`, `description`, `hobbies`, `zip`, `city`, `address`, `status`) VALUES
(1, 'Lucy', 'https://www.deine-tierwelt.de/magazin/wp-content/uploads/sites/7/2018/07/Border-Collie.jpg', 'Large', 'Dog', 'Border Collie', 3, 'Lucy is young Border Collie, she is full of energy and a she loves children.', 'Agility', 1160, 'Wien', 'Rankgasse 16', '<font color=red>reserved</font>'),
(4, 'Donatello', 'https://i.pinimg.com/564x/65/58/5b/65585bcc0f951d7355b9690b1b86332b.jpg', 'Senior', 'Turtle', 'Greek Tortoise', 27, 'Donatello is a lovable and eaten Turtle.', 'walks on the beach, playing hide and seek', 3021, 'Pressbaum', 'Hauptstraße 17', '<font color=green>available</font>'),
(5, 'Milka', 'https://www.heumilch.com/wp-content/uploads/2014/04/Galloway_Stier.jpg', 'Large', 'Cow', 'Galloway', 6, 'Liebe Kuh die gerne und viel Milch gibt.', 'Eating gras and eating again and again...', 3032, 'Eichgraben', 'Hauptstraße 165', '<font color=red>reserved</font>'),
(6, 'Linda', 'https://www.zooroyal.de/magazin/wp-content/uploads/2018/06/haflinger-760x560.jpg', 'Senior', 'Horse', 'Haflinger', 9, 'Bestes Pferd wo gibt!', 'Running', 1220, 'Vienna', 'Brunnerstraße 184', '<font color=green>available</font>'),
(7, 'Luke', 'https://www.zooplus.de/magazin/wp-content/uploads/2017/03/fotolia_95274898-1024x683.jpg', 'Large', 'Dog', 'Rhodesian Ridgeback', 5, 'Luke is a lovely dog.', 'sleeping', 1180, 'Wien', 'Irgendeinestraße 64', '<font color=green>available</font>'),
(8, 'Kaa', 'https://reptale.de/wp-content/uploads/2018/02/Dunkler_Tigerpython_Ricktap_Patrick_R%C3%B6sler_Facebook.jpg', 'Large', 'Snake', 'Tigerpython', 6, 'Beautify big Kaa is very long', 'hunting', 1110, 'Vienna', 'Anderestraße 546', '<font color=green>available</font>'),
(9, 'Charly', 'https://www.zooroyal.de/magazin/wp-content/uploads/2017/01/chihuahua-760x570.jpg', 'Small', 'Dog', 'Chihuahua', 4, 'Charly loves Children', 'playing Chess', 1090, 'Vieanna', 'Nocheinestraße 86', '<font color=green>available</font>'),
(10, 'Franz', 'https://www.schlappohr.de/app/uploads/2019/08/die-perserkatze-eine-eigenwillige-schoenheit_i753.png', 'Small', 'Cat', 'Perserkatze', 5, 'Franz is a happy Cat', 'sleeping', 1140, 'Vienna', 'Linzerstraße 651', '<font color=green>available</font>'),
(11, 'Hans', 'https://www.zooplus.de/magazin/wp-content/uploads/2017/03/siamkatze-1-1024x683.jpeg', 'Small', 'Cat', 'Siamkatze', 4, 'Hans is a blue eyed siamkatze', 'hunting birds', 1150, 'Vienna', 'Hütteldorferstraße 64', '<font color=red>reserved</font>'),
(12, 'Michey', 'https://i0.wp.com/happy-pet-club.net/wp-content/uploads/2020/04/AdobeStock_303652112_1200x750.jpeg?resize=1080%2C675&ssl=1', 'Small', 'Mouse', 'Rennmaus', 3, 'Mickey is a little Rennmaus which loves cucumber', 'digging holes', 3001, 'Purkersdorf', 'Hauptplatz 2', '<font color=green>available</font>'),
(13, 'Captain', 'https://www.stuttgarter-nachrichten.de/media.media.22ed15be-da8f-4d3e-9af6-34c5f5cbebef.original1024.jpg', 'Senior', 'Parrot', 'Ara', 12, 'Captain is a cute Ara and he can speak', 'flying around', 1200, 'Vienna', 'Handelskai 54', '<font color=red>reserved</font>'),
(14, 'Fridolin', 'https://www.kindernetz.de/wissen/tierlexikon/1605540396985,steckbrief-kakadu-102~_v-16x9@2dL_-6c42aff4e68b43c7868c3240d3ebfa29867457da.jpg', 'Senior', 'Parrot', 'Kakadu', 10, 'Fridolin is a very good singer', 'singing', 1180, 'Vienna', 'Irgendwostraße 16', '<font color=green>available</font>');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` varchar(5) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `password`, `date_of_birth`, `email`, `picture`, `status`) VALUES
(3, 'Richard', 'Almer', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1990-10-14', 'richard@mail.com', 'avatar.png', 'adm'),
(4, 'Max', 'Test', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2005-10-10', 'test@mail.com', 'avatar.png', 'user');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `adoption`
--
ALTER TABLE `adoption`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`fk_user_id`),
  ADD KEY `fk_pet_id` (`fk_pet_id`);

--
-- Indizes für die Tabelle `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `adoption`
--
ALTER TABLE `adoption`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT für Tabelle `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `adoption`
--
ALTER TABLE `adoption`
  ADD CONSTRAINT `adoption_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `adoption_ibfk_2` FOREIGN KEY (`fk_pet_id`) REFERENCES `animals` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
