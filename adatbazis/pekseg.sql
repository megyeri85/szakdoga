
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Hoszt: localhost
-- Létrehozás ideje: 2015. nov. 25. 12:59
-- Szerver verzió: 10.0.20-MariaDB
-- PHP verzió: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Adatbázis: `u461554259_pek2`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet: `felhasznalok`
--

CREATE TABLE IF NOT EXISTS `felhasznalok` (
  `felhasznalo_id` int(8) NOT NULL AUTO_INCREMENT,
  `fk_vasarlo_id` int(8) NOT NULL,
  `nev` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `jelszo` varchar(40) COLLATE utf8_hungarian_ci NOT NULL,
  `jog_szint` int(1) NOT NULL,
  PRIMARY KEY (`felhasznalo_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=49 ;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`felhasznalo_id`, `fk_vasarlo_id`, `nev`, `jelszo`, `jog_szint`) VALUES
(2, 2, 'bbb', '5cb138284d431abd6a053a56625ec088bfb88912', 1),
(3, 0, 'ccc', 'f36b4825e5db2cf7dd2d2593b3f5c24c0311d8b2', 2),
(4, 0, 'ddd', '9c969ddf454079e3d439973bbab63ea6233e4087', 3),
(33, 17, 'vasarlo11', '7579e3a1347cd43a3babc35512e39cb208155356', 1),
(34, 17, 'vasarlo12', 'e33441b17cfb8cd982795d4b0a35b1b24ac53057', 1),
(35, 18, 'vasarlo21', '124ef926544282e554c7b82674135921d805a753', 1),
(36, 18, 'vasarlo22', '14f4b59e821bf23619393854a07dde39444a6573', 1),
(37, 19, 'vasarlo31', 'f9f57968156df7e2f46f044be814d83769af9e54', 1),
(38, 19, 'vasarlo32', '8e734133979254e017a8bb0dd5fa03cbddc9a23b', 1),
(39, 20, 'vasarlo41', 'ec2e4fdd3aed0a3340f38cb0a1bf4be0d267b5b5', 1),
(40, 21, 'vasarlo51', 'ea7f3054262913985668927c78a9e21b1c7c8b5c', 1),
(41, 0, 'admin1', '6c7ca345f63f835cb353ff15bd6c5e052ec08e7a', 3),
(42, 0, 'admin2', '315f166c5aca63a157f7d41007675cb44a948b33', 3),
(43, 0, 'admin3', '33aab3c7f01620cade108f488cfd285c0e62c1ec', 3),
(44, 0, 'diszpecser1', 'eaa430663142de34a8bbfad9676d8ffb7de388bd', 2),
(45, 0, 'diszpecser2', '91b324908f19b67c83f1a567ba525d18c7f90af7', 2),
(46, 0, 'diszpecser3', '9142f1dc24c112d23943024a88334c7e24a38ab6', 2);

-- --------------------------------------------------------

--
-- Tábla szerkezet: `hirek`
--

CREATE TABLE IF NOT EXISTS `hirek` (
  `hir_id` int(11) NOT NULL AUTO_INCREMENT,
  `hir_szoveg` text COLLATE utf8_hungarian_ci NOT NULL,
  PRIMARY KEY (`hir_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=4 ;

--
-- A tábla adatainak kiíratása `hirek`
--

INSERT INTO `hirek` (`hir_id`, `hir_szoveg`) VALUES
(1, 'Cégünk továbbra is keresi viszonteladói partnereit. Amennyiben felkeltettük az érdeklődését kérem hívja az alábbi telefonszámot: +36/90-900-9000 '),
(2, 'Pékségünk termékei egy újabb mintaboltban is megtekinthetőek melynek címe: 1102 Budapest Valami utca 10.'),
(3, 'Amennyiben a weboldallal kapcsolatos kérdése lenne kérem írjon email-t a www@wwww.hu címre.');

-- --------------------------------------------------------

--
-- Tábla szerkezet: `rendeles`
--

CREATE TABLE IF NOT EXISTS `rendeles` (
  `rendeles_id` int(10) NOT NULL AUTO_INCREMENT,
  `fk_felhasznalo_id` int(8) NOT NULL,
  `fk_vasarlo_id` int(8) NOT NULL,
  `datum` date NOT NULL,
  PRIMARY KEY (`rendeles_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=68 ;

--
-- A tábla adatainak kiíratása `rendeles`
--

INSERT INTO `rendeles` (`rendeles_id`, `fk_felhasznalo_id`, `fk_vasarlo_id`, `datum`) VALUES
(60, 4, 17, '2015-11-30'),
(61, 4, 19, '2015-11-30'),
(62, 41, 18, '0000-00-00'),
(63, 41, 17, '2015-11-29'),
(64, 41, 18, '2015-11-29'),
(65, 41, 19, '2015-11-28'),
(66, 41, 20, '2015-11-30'),
(67, 41, 21, '2015-11-30');

-- --------------------------------------------------------

--
-- Tábla szerkezet: `rendelt_termek`
--

CREATE TABLE IF NOT EXISTS `rendelt_termek` (
  `rendelt_id` int(10) NOT NULL AUTO_INCREMENT,
  `fk_rendeles_id` int(10) NOT NULL,
  `db` int(5) NOT NULL,
  `fk_termek_id` int(5) NOT NULL,
  PRIMARY KEY (`rendelt_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=369 ;

--
-- A tábla adatainak kiíratása `rendelt_termek`
--

INSERT INTO `rendelt_termek` (`rendelt_id`, `fk_rendeles_id`, `db`, `fk_termek_id`) VALUES
(332, 60, 3, 16),
(333, 60, 4, 15),
(334, 60, 1, 18),
(335, 60, 1, 19),
(336, 60, 1, 20),
(337, 60, 1, 4),
(338, 60, 1, 3),
(339, 60, 1, 5),
(340, 60, 1, 6),
(341, 60, 1, 7),
(342, 60, 1, 8),
(343, 60, 1, 2),
(344, 60, 1, 17),
(345, 60, 1, 10),
(346, 60, 1, 11),
(347, 60, 1, 12),
(348, 60, 1, 13),
(349, 61, 4, 16),
(350, 61, 5, 15),
(351, 62, 1, 16),
(352, 62, 3, 11),
(353, 62, 4, 12),
(354, 63, 1, 16),
(355, 63, 1, 15),
(356, 63, 1, 4),
(357, 64, 1, 16),
(358, 64, 1, 15),
(359, 65, 6, 15),
(360, 65, 4, 16),
(361, 65, 1, 4),
(362, 65, 5, 3),
(363, 66, 1, 16),
(364, 66, 2, 15),
(365, 66, 2, 11),
(366, 66, 3, 17),
(367, 67, 1, 16),
(368, 67, 12, 15);

-- --------------------------------------------------------

--
-- Tábla szerkezet: `termekek`
--

CREATE TABLE IF NOT EXISTS `termekek` (
  `termek_id` int(5) NOT NULL AUTO_INCREMENT,
  `termek_nev` varchar(30) CHARACTER SET utf8 COLLATE utf8_lithuanian_ci NOT NULL,
  `termek_suly` float NOT NULL,
  `termek_ar` int(5) NOT NULL,
  `fk_kateg_id` int(5) NOT NULL,
  `termek_leiras` text COLLATE utf8_hungarian_ci NOT NULL,
  PRIMARY KEY (`termek_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=27 ;

--
-- A tábla adatainak kiíratása `termekek`
--

INSERT INTO `termekek` (`termek_id`, `termek_nev`, `termek_suly`, `termek_ar`, `fk_kateg_id`, `termek_leiras`) VALUES
(2, 'kifli', 0.1, 25, 3, 'hgfjhgf'),
(3, 'Fehér kenyér', 0.75, 230, 1, ''),
(4, 'Fehér kenyér', 0.5, 180, 1, ''),
(5, 'Fehér kenyér', 1, 280, 1, ''),
(6, 'Félbarna kenyér', 0.5, 180, 1, ''),
(7, 'Félbarna kenyér', 0.75, 230, 1, ''),
(8, 'Félbarna kenyér', 1, 280, 1, ''),
(9, 'Kis zsömle', 0.07, 20, 2, 'zsömle'),
(10, 'Nagy zsömle', 0, 35, 2, 'nagy zsömle\r\n'),
(11, 'Nagy zsömle', 0.1, 35, 2, 'nagy zsömle\r\n'),
(12, 'Rozsos zsömle', 0.1, 40, 2, 'rozs zsömle'),
(13, 'Teljes kiőrlésű zsöm', 0.1, 50, 2, 'tk zsömle'),
(14, 'Teljes kiőrlésű zsömle', 0.1, 50, 2, 'tk zsömle'),
(15, 'Fontott kalács', 0.5, 230, 4, 'kalács'),
(16, 'Fonott kalács', 0.25, 180, 4, 'kis kalacs'),
(17, 'magos zsömle', 0.1, 56, 2, 'magos zsömle'),
(18, 'erzsébet kenyér', 1, 230, 1, 'erzsébet kenyér'),
(19, 'erzsébet kenyér', 1, 230, 1, 'e2'),
(20, 'erzsébet kenyér', 1, 230, 1, 'e2');

-- --------------------------------------------------------

--
-- Tábla szerkezet: `termek_ketegoriak`
--

CREATE TABLE IF NOT EXISTS `termek_ketegoriak` (
  `kategoria_id` int(5) NOT NULL AUTO_INCREMENT,
  `kategoria_nev` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  PRIMARY KEY (`kategoria_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=5 ;

--
-- A tábla adatainak kiíratása `termek_ketegoriak`
--

INSERT INTO `termek_ketegoriak` (`kategoria_id`, `kategoria_nev`) VALUES
(1, 'kenyér'),
(2, 'zsömle'),
(3, 'kifli'),
(4, 'kalács');

-- --------------------------------------------------------

--
-- Tábla szerkezet: `vasarlok`
--

CREATE TABLE IF NOT EXISTS `vasarlok` (
  `vasarlo_id` int(8) NOT NULL AUTO_INCREMENT,
  `ceg_nev` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `ceg_cim` varchar(40) COLLATE utf8_hungarian_ci NOT NULL,
  `ceg_cegjegyzekszam` bigint(20) NOT NULL,
  `ceg_adoszam` bigint(20) NOT NULL,
  `ceg_telefonszam` int(9) NOT NULL,
  `ceg_email` varchar(40) COLLATE utf8_hungarian_ci NOT NULL,
  PRIMARY KEY (`vasarlo_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=22 ;

--
-- A tábla adatainak kiíratása `vasarlok`
--

INSERT INTO `vasarlok` (`vasarlo_id`, `ceg_nev`, `ceg_cim`, `ceg_cegjegyzekszam`, `ceg_adoszam`, `ceg_telefonszam`, `ceg_email`) VALUES
(17, 'Cég_1 Kft', 'Budapest 1111 1.utca 1', 1111111111, 11111111111, 111111111, 'megyeri85szakdolg@gmail.com'),
(18, 'Cég_2 Kft', 'Budapest 2222 2.utca 2', 2222222222, 22222222222, 222222222, 'megyeri85szakdolg@gmail.com'),
(19, 'Cég_3 Kft', 'Budapest 3333 3.utca 3', 3333333333, 33333333333, 333333333, 'megyeri85szakdolg@gmail.com'),
(20, 'Cég_4 Kft', 'Budapest 4444 4.utca 4', 4444444444, 44444444444, 444444444, 'megyeri85szakdolg@gmail.com'),
(21, 'Cég_5 Kft', 'Budapest 5555 5.utca 5', 5555555555, 55555555555, 555555555, 'megyeri85szakdolg@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
