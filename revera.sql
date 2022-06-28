-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 10 jun 2022 om 10:57
-- Serverversie: 10.4.22-MariaDB
-- PHP-versie: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `revera`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `boekingen`
--

CREATE TABLE `boekingen` (
  `recensieID` int(6) NOT NULL,
  `gebruikerID` int(6) NOT NULL,
  `reisID` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contact`
--

CREATE TABLE `contact` (
  `contactID` int(6) NOT NULL,
  `naam` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `bericht` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikers`
--

CREATE TABLE `gebruikers` (
  `gebruikerID` int(6) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `gebruikers`
--

INSERT INTO `gebruikers` (`gebruikerID`, `username`, `password`, `admin`) VALUES
(1, 'admin', '$2y$10$oWGco2uXguxWPuc/GzGvuuepK0SOfEN8X5hitt8ykWsx0p8UQagua', 0),
(2, 'nazilijer', '$2y$10$SMn9W/tugXNkqsXUTMRPR.XOKEPWzakj0EVKEVSVp/mxXkOxfNfmG', 0),
(3, 'kaasbroodje', '$2y$10$fxFHz7AXZFHbQZJc3La7YeUh1h0oj8seJkuDDH1ptbflkrtOSIEPu', 0),
(4, 'Stijn', '$2y$10$fOvaWS5Sbks/6Oag230v5uNlJb5KY6vKTw23kQKJqCHwaI/f.SCCO', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `recensies`
--

CREATE TABLE `recensies` (
  `recensieID` int(6) NOT NULL,
  `gebruikerID` int(6) NOT NULL,
  `reisID` int(6) NOT NULL,
  `validatie` tinyint(4) NOT NULL,
  `titel` varchar(100) NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reizen`
--

CREATE TABLE `reizen` (
  `reisID` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `startDatum` date NOT NULL,
  `eindDatum` date NOT NULL,
  `kosten` double NOT NULL,
  `hotel` varchar(50) NOT NULL,
  `locatie` varchar(100) NOT NULL,
  `retour` tinyint(1) NOT NULL,
  `beginplek` varchar(50) NOT NULL,
  `eindplek` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `reizen`
--

INSERT INTO `reizen` (`reisID`, `foto`, `startDatum`, `eindDatum`, `kosten`, `hotel`, `locatie`, `retour`, `beginplek`, `eindplek`) VALUES
(1, 'https://www.esl-taalreizen.com/sites/default/files/styles/image_gallery/public/city/esl-languages-usa-los-angeles-hero.jpg?itok=GNFHWcI7', '2022-06-23', '2022-06-30', 309.23, '', 'Los Angeles', 1, 'Düsseldorf Airport, Duitsland', 'Los Angeles Airport, Amerika'),
(2, 'https://theorangebackpack.nl/wp-content/uploads/2022/01/Sevilla-Metropol-Parasol-Skyline-scaled.jpg', '2022-06-30', '2022-06-30', 90.23, '', 'Madrid, Spanje', 0, 'Düsseldorf Airport, Duitsland', 'Madrid Airport, Spanje');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `boekingen`
--
ALTER TABLE `boekingen`
  ADD PRIMARY KEY (`recensieID`);

--
-- Indexen voor tabel `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contactID`);

--
-- Indexen voor tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  ADD PRIMARY KEY (`gebruikerID`),
  ADD UNIQUE KEY `wachtwoord` (`password`);

--
-- Indexen voor tabel `recensies`
--
ALTER TABLE `recensies`
  ADD PRIMARY KEY (`recensieID`);

--
-- Indexen voor tabel `reizen`
--
ALTER TABLE `reizen`
  ADD PRIMARY KEY (`reisID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `boekingen`
--
ALTER TABLE `boekingen`
  MODIFY `recensieID` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `contact`
--
ALTER TABLE `contact`
  MODIFY `contactID` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  MODIFY `gebruikerID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `recensies`
--
ALTER TABLE `recensies`
  MODIFY `recensieID` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `reizen`
--
ALTER TABLE `reizen`
  MODIFY `reisID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
