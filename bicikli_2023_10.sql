-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Nov 03. 13:24
-- Kiszolgáló verziója: 10.4.28-MariaDB
-- PHP verzió: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `bicikli_2023_10`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `biciklivetel`
--

CREATE TABLE `biciklivetel` (
  `bicikli_id` int(10) UNSIGNED NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL,
  `megvetel` date NOT NULL DEFAULT current_timestamp(),
  `allapot` enum('elindult','lezárult') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `bicikli_1`
--

CREATE TABLE `bicikli_1` (
  `bicikli_id` int(10) UNSIGNED NOT NULL,
  `markaneve` varchar(255) NOT NULL,
  `tipus` varchar(255) NOT NULL,
  `gyartasiev` date NOT NULL,
  `megjegyzes` varchar(255) NOT NULL,
  `nyilvantartasban` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- A tábla adatainak kiíratása `bicikli_1`
--

INSERT INTO `bicikli_1` (`bicikli_id`, `markaneve`, `tipus`, `gyartasiev`, `megjegyzes`, `nyilvantartasban`) VALUES
(2, 'MTB', 'MTB', '2021-10-10', '?jszer?', '2022-12-24'),
(3, 'fatbike', 'fatbike', '2020-11-10', 'kival?;2021.11.0', '0000-00-00'),
(4, 'elektromos', 'elektromos', '2017-11-21', 'nagyonj?;2019.01', '0000-00-00'),
(5, 'kemping', 'kemping', '2018-01-07', 'j?;2021.03.12', '0000-00-00'),
(6, 'orszaguti', 'orszaguti', '2020-12-24', 'kival?;2021.12.1', '0000-00-00'),
(7, 'varosi', 'varosi', '1999-01-02', 'nagyonj?;2019.10', '0000-00-00');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `userid` int(10) UNSIGNED NOT NULL,
  `igazolvanyszam` varchar(8) NOT NULL,
  `felhaszanlo_neve` varchar(50) NOT NULL,
  `emailcim` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`userid`, `igazolvanyszam`, `felhaszanlo_neve`, `emailcim`, `username`, `password`) VALUES
(1, '123456AB', '', 'asdf@gamil.com', 'Lajos', '1234'),
(2, '123456AC', 'llllll', 'majom34@gmail.com', 'qwe', '1234'),
(3, '234567BC', 'szabomarcell', 'szabomarcell34@gmail.com', 'Majom', '1234');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `biciklivetel`
--
ALTER TABLE `biciklivetel`
  ADD UNIQUE KEY `bicikli_id` (`bicikli_id`,`userid`),
  ADD KEY `userid` (`userid`);

--
-- A tábla indexei `bicikli_1`
--
ALTER TABLE `bicikli_1`
  ADD PRIMARY KEY (`bicikli_id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `igazolvanyszam` (`igazolvanyszam`,`emailcim`,`username`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `bicikli_1`
--
ALTER TABLE `bicikli_1`
  MODIFY `bicikli_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `biciklivetel`
--
ALTER TABLE `biciklivetel`
  ADD CONSTRAINT `biciklivetel_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`),
  ADD CONSTRAINT `biciklivetel_ibfk_2` FOREIGN KEY (`bicikli_id`) REFERENCES `bicikli_1` (`bicikli_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
