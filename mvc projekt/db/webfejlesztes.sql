-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Ápr 23. 20:37
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
-- Adatbázis: `webfejlesztes`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vezeteknev` varchar(50) NOT NULL,
  `keresztnev` varchar(50) NOT NULL,
  `szuletesi_datum` date NOT NULL,
  `email` varchar(62) NOT NULL,
  `jelszo_hash` varchar(255) NOT NULL,
  `nem` tinyint(1) NOT NULL,
  `profilkep` varchar(255) DEFAULT NULL,
  `hirelevelezes` tinyint(1) NOT NULL,
  `gdpr_elfogadva` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`id`, `vezeteknev`, `keresztnev`, `szuletesi_datum`, `email`, `jelszo_hash`, `nem`, `profilkep`, `hirelevelezes`, `gdpr_elfogadva`, `created_at`, `updated_at`) VALUES
(1, 'Szanto', 'sdf', '1997-08-20', 'rzri@eye.hu', '$2y$10$ASvtKcCkzmhdl9nw6KvtuuZo9fRRhhFP8QsWAI.TExfVwhol780ZK', 0, 'WUWNPlyGiLf0Y1tBSeTtV3AkjVhsrtW9.jpg', 1, '2023-04-09 10:26:46', '2023-04-09 08:26:46', '2023-04-09 08:26:46'),
(2, 'Szanto', 'Benjamin', '1997-08-20', 'rzric@eye.hu', '$2y$10$RhnqZOp751ccjN7Yfz0JI.gezkYpp2SmIOFHhLPqAvPUTzd/dlVcu', 0, 'wfIItfu0ad0XptHjTHSIpPfpYRrcz8WF.jpg', 1, '2023-04-10 12:09:44', '2023-04-10 10:09:44', '2023-04-10 10:09:44'),
(3, 'Szanto', 'Benjamin', '1997-08-20', 'dfgh@eye.hu', '$2y$10$ZTlkQo7f2Hn5NHs/kcuv6eqW47AwlZ/fQmFrhYcC7KEPOdyStgR2O', 0, '5OaV4aBQ4KoiJ2wp8ykksXJr8MSNsJYv.jpg', 1, '2023-04-10 12:17:05', '2023-04-10 10:17:05', '2023-04-10 10:17:05');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jogi_dokumentumok`
--

CREATE TABLE `jogi_dokumentumok` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `utvonal` varchar(40) NOT NULL,
  `nev` varchar(40) NOT NULL,
  `leiras` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `jogi_dokumentumok`
--

INSERT INTO `jogi_dokumentumok` (`id`, `utvonal`, `nev`, `leiras`, `created_at`, `updated_at`) VALUES
(1, 'adatved', 'Adatvédelmi irányevek', 'Minta GDPR szöveg:\n\nA \"Private Privacy\" nevű szolgáltatás használata során bizonyos személyes adatokat kérünk Öntől, amelyeket a szolgáltatás teljesítése érdekében tárolunk. Az Ön által megadott adatokat bizalmasan kezeljük és nem adjuk ki harmadik félnek.\n\nAz Ön által megadott személyes adatok tárolásának időtartama a \"Private Privacy\" szolgáltatás használatával összefüggésben kerül meghatározásra. Az adatok tárolásának időtartama a szolgáltatás használatát követően a lehető legrövidebb idő alatt törlésre kerülnek.\n\nA \"Private Privacy\" szolgáltatás használata során cookie-kat használunk az Ön élményének javítása érdekében. A cookie-k elfogadására vonatkozó kérést külön meg kell erősítenie.\n\nHa hozzájárult a marketing e-mailek fogadásához, akkor időnként hírleveleket és promóciókat küldhetünk az Ön e-mail címére. Ha nem szeretné kapni ezeket az e-maileket, kérjük, hogy jelezze nekünk, és azonnal töröljük az Ön adatait a marketing e-mailek címzettlistájáról.\n\nHa bármilyen kérdése van a személyes adatokkal kapcsolatban, kérjük, hogy vegye fel velünk a kapcsolatot az info@privateprivacy.com e-mail címen.', '2023-04-09 08:44:33', '2023-04-09 08:01:52');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_04_03_170955_create_felhasznalos_table', 1),
(6, '2023_04_09_072140_create_jogi_dokumenta_table', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `jogi_dokumentumok`
--
ALTER TABLE `jogi_dokumentumok`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jogi_dokumentumok_utvonal_unique` (`utvonal`);

--
-- A tábla indexei `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- A tábla indexei `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `jogi_dokumentumok`
--
ALTER TABLE `jogi_dokumentumok`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
