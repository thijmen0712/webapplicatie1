-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Gegenereerd op: 10 apr 2025 om 08:43
-- Serverversie: 5.7.44
-- PHP-versie: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ladolcevita`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `emailadres` varchar(255) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `adres` text NOT NULL,
  `rol` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `account`
--

INSERT INTO `account` (`id`, `emailadres`, `wachtwoord`, `naam`, `adres`, `rol`) VALUES
(1, 't@t.nl', 'test123', 'thijmen', 'Teststraat 1', 'admin'),
(2, 'j@j.nl', 'ww123', 'jan', 'Hoofdstraat 10', 'user'),
(3, 'lisa@mail.com', 'wachtwoord123', 'Lisa', 'Dorpsstraat 5', 'user'),
(4, 'peter@mail.com', 'wachtwoord123', 'Peter', 'Kerklaan 12', 'user'),
(5, 'sophie@mail.com', 'wachtwoord123', 'Sophie', 'Markt 22', 'user'),
(6, 'daan@mail.com', 'wachtwoord123', 'Daan', 'Stationsweg 7', 'user'),
(7, 'emma@mail.com', 'wachtwoord123', 'Emma', 'Schoolstraat 9', 'user'),
(8, 'hugo@mail.com', 'wachtwoord123', 'Hugo', 'Zijweg 3', 'user'),
(9, 'noor@mail.com', 'wachtwoord123', 'Noor', 'Parklaan 14', 'user'),
(10, 'bram@mail.com', 'wachtwoord123', 'Bram', 'Lindelaan 2', 'user'),
(11, 'isa@mail.com', 'wachtwoord123', 'Isa', 'Molenweg 6', 'user'),
(12, 'thomas@mail.com', 'wachtwoord123', 'Thomas', 'Eikenlaan 11', 'user'),
(13, 'test@test.nl', '$2y$10$HdV.2hkMiJxjV7KyvOcAPOnPI2sZYvWGP1NhG8WoYB/ie1Sg/uIoG', 'test', '', 'user');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestelling`
--

CREATE TABLE `bestelling` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `totaal` decimal(10,2) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `adres` text NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('te bereiden','in oven','toekomstig','afgerond') NOT NULL DEFAULT 'te bereiden'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `bestelling`
--

INSERT INTO `bestelling` (`id`, `account_id`, `totaal`, `naam`, `email`, `adres`, `datum`, `status`) VALUES
(1, 1, 35.99, 'Thijmen', 't@t.nl', 'Teststraat 1', '2025-02-28 12:00:00', 'in oven'),
(2, 2, 42.47, 'Jan', 'j@j.nl', 'Hoofdstraat 10', '2025-02-28 12:15:00', 'te bereiden'),
(13, 3, 28.50, 'Lisa', 'lisa@mail.com', 'Dorpsstraat 5', '2025-02-28 12:30:00', 'in oven'),
(14, 4, 18.75, 'Peter', 'peter@mail.com', 'Kerklaan 12', '2025-02-28 12:45:00', 'afgerond'),
(15, 5, 55.90, 'Sophie', 'sophie@mail.com', 'Markt 22', '2025-02-28 13:00:00', 'in oven'),
(16, 6, 32.10, 'Daan', 'daan@mail.com', 'Stationsweg 7', '2025-02-28 13:15:00', 'te bereiden'),
(17, 7, 47.30, 'Emma', 'emma@mail.com', 'Schoolstraat 9', '2025-02-28 13:30:00', 'afgerond'),
(18, 8, 22.80, 'Hugo', 'hugo@mail.com', 'Zijweg 3', '2025-02-28 13:45:00', 'te bereiden'),
(19, 9, 64.25, 'Noor', 'noor@mail.com', 'Parklaan 14', '2025-02-28 14:00:00', 'in oven'),
(20, 10, 39.60, 'Bram', 'bram@mail.com', 'Lindelaan 2', '2025-02-28 14:15:00', 'toekomstig'),
(21, 11, 29.90, 'Isa', 'isa@mail.com', 'Molenweg 6', '2025-02-28 14:30:00', 'afgerond'),
(22, 12, 50.40, 'Thomas', 'thomas@mail.com', 'Eikenlaan 11', '2025-02-28 14:45:00', 'te bereiden');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestelling_producten`
--

CREATE TABLE `bestelling_producten` (
  `id` int(11) NOT NULL,
  `bestelling_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `aantal` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `bestelling_producten`
--

INSERT INTO `bestelling_producten` (`id`, `bestelling_id`, `product_id`, `aantal`) VALUES
(71, 13, 4, 2),
(72, 13, 5, 1),
(73, 13, 6, 1),
(74, 14, 7, 3),
(75, 14, 8, 2),
(76, 15, 9, 1),
(77, 15, 10, 2),
(78, 16, 11, 1),
(79, 16, 12, 3),
(80, 17, 13, 2),
(81, 17, 14, 2),
(82, 18, 4, 1),
(83, 18, 7, 3),
(84, 19, 6, 2),
(85, 19, 9, 2),
(86, 20, 12, 1),
(87, 20, 13, 2),
(88, 21, 5, 3),
(89, 21, 14, 1),
(90, 22, 10, 2),
(91, 22, 11, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `titel` varchar(255) NOT NULL,
  `beschrijving` text,
  `prijs` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `product`
--

INSERT INTO `product` (`id`, `foto`, `titel`, `beschrijving`, `prijs`) VALUES
(4, 'dipapa.png', 'Pepperoni di Papa', 'Tomatensaus, gesmolten mozzarella, pittige pepperoni, salami, gehakt, rode ui en knoflookolie op de rand.', 11.99),
(5, 'chickenpesto.png', 'Pollo Italiano al Pesto', 'Tomatensaus, mozzarella, kip, spinazie, cherrytomaatjes, knoflook, rode ui en knoflookolie op de rand.', 14.49),
(6, 'formagi.png', 'Cinque Formaggi', 'Tomatensaus, mozzarella, cheddar, Goudse kaas, raclette kaas en Parmezaanse kaas.', 16.49),
(7, 'peperoni.png', 'Pepperoni Extra', 'Extra veel pepperoni, mozzarella en crispy cupped pepperoni.', 14.49),
(8, 'peperonispicy.png', 'Pepperoni Miele Piccante', 'Tomatensaus, mozzarella, cupped pepperoni en een swirl van hot honey.', 12.49),
(9, 'parmesan.png', 'Pollo Parmigiano', 'Tomatensaus, mozzarella, kip, paprika, rode ui, knoflook, cherrytomaat en Parmezaanse kaas.', 11.99),
(10, 'caprese.png', 'Caprese Classica', 'Tomatensaus, mozzarella, cherrytomaat, buffelmozzarella en een swirl van pesto.', 11.99),
(11, 'cheese.jpg', 'Margherita Tradizionale', 'Tomatensaus, mozzarella en knoflookolie.', 7.99),
(12, 'meatlovers.jpg', 'BBQ Amanti di Carne', 'BBQ-saus, chorizo, kalkoenham, pepperoni, mozzarella en peterselie.', 12.99),
(13, 'shoarma.jpg', 'Shoarma della Casa', 'Tomatensaus, mozzarella, kipshoarma, extra mozzarella en knoflooksaus.', 11.99),
(14, 'mexicanhot.jpg', 'Messicana Piccante', 'Tomatensaus, mozzarella, jalapeño, pepperoni, rode ui en paprika.', 11.99),
(15, 'tonno.jpg', 'Tonno Speciale', 'Tomatensaus, mozzarella, tonijn, groene olijven en rode ui.', 10.99);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `winkelwagen`
--

CREATE TABLE `winkelwagen` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `totaal` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `winkelwagen`
--

INSERT INTO `winkelwagen` (`id`, `account_id`, `totaal`) VALUES
(1, 1, 0.00),
(2, 2, 0.00);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `winkelwagen_producten`
--

CREATE TABLE `winkelwagen_producten` (
  `id` int(11) NOT NULL,
  `winkelwagen_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `aantal` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `winkelwagen_producten`
--

INSERT INTO `winkelwagen_producten` (`id`, `winkelwagen_id`, `product_id`, `aantal`) VALUES
(1, 1, 5, 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emailadres` (`emailadres`);

--
-- Indexen voor tabel `bestelling`
--
ALTER TABLE `bestelling`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexen voor tabel `bestelling_producten`
--
ALTER TABLE `bestelling_producten`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bestelling_id` (`bestelling_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexen voor tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `winkelwagen`
--
ALTER TABLE `winkelwagen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexen voor tabel `winkelwagen_producten`
--
ALTER TABLE `winkelwagen_producten`
  ADD PRIMARY KEY (`id`),
  ADD KEY `winkelwagen_id` (`winkelwagen_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT voor een tabel `bestelling`
--
ALTER TABLE `bestelling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT voor een tabel `bestelling_producten`
--
ALTER TABLE `bestelling_producten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT voor een tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT voor een tabel `winkelwagen`
--
ALTER TABLE `winkelwagen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `winkelwagen_producten`
--
ALTER TABLE `winkelwagen_producten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `bestelling`
--
ALTER TABLE `bestelling`
  ADD CONSTRAINT `bestelling_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `bestelling_producten`
--
ALTER TABLE `bestelling_producten`
  ADD CONSTRAINT `bestelling_producten_ibfk_1` FOREIGN KEY (`bestelling_id`) REFERENCES `bestelling` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bestelling_producten_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `winkelwagen`
--
ALTER TABLE `winkelwagen`
  ADD CONSTRAINT `winkelwagen_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `winkelwagen_producten`
--
ALTER TABLE `winkelwagen_producten`
  ADD CONSTRAINT `winkelwagen_producten_ibfk_1` FOREIGN KEY (`winkelwagen_id`) REFERENCES `winkelwagen` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `winkelwagen_producten_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
