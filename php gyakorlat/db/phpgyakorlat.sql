-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Ápr 23. 11:35
-- Kiszolgáló verziója: 10.4.27-MariaDB
-- PHP verzió: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `phpgyakorlat`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `vezeteknev` varchar(128) DEFAULT NULL,
  `keresztnev` varchar(128) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `felhasznalonev` varchar(64) NOT NULL,
  `jelszo` varchar(128) NOT NULL,
  `neme` varchar(5) NOT NULL,
  `szuletesiev` year(4) NOT NULL,
  `hirlevel` tinyint(4) NOT NULL DEFAULT 0,
  `leiras` text DEFAULT NULL,
  `remember_me_token` varchar(128) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `vezeteknev`, `keresztnev`, `email`, `felhasznalonev`, `jelszo`, `neme`, `szuletesiev`, `hirlevel`, `leiras`, `remember_me_token`, `created_at`) VALUES
(1, 'xesona2@mailinator.com', 'siqi@mailinator.com', 'negy@nye.hu', 'vusy@mailinator.com', 'bd447c0bc1f47056adad1a84b3e95d06c713f12705d05b9a35c3b2e83fe9fce1', 'Nő', 1974, 0, 'xesona@mailinator.com', NULL, '2023-04-14 12:31:19');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
