-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-01-2017 a las 00:27:38
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdomni`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `address`
--

CREATE TABLE `address` (
  `idAddress` int(10) UNSIGNED NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `reference` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registerDate` datetime NOT NULL,
  `latitude` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idClient` int(10) UNSIGNED NOT NULL,
  `idZone` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client`
--

CREATE TABLE `client` (
  `idClient` int(10) UNSIGNED NOT NULL,
  `names` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fatherLastName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `motherLastName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `birthdate` datetime DEFAULT NULL,
  `documentNumber` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registerDate` datetime NOT NULL,
  `idDocumentType` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `client`
--

INSERT INTO `client` (`idClient`, `names`, `fatherLastName`, `motherLastName`, `birthdate`, `documentNumber`, `email`, `gender`, `phone`, `registerDate`, `idDocumentType`) VALUES
(1, 'Genérico', 'Pt', 'Mt', '1990-12-20 00:00:00', '0', NULL, 'Masculino', NULL, '2016-12-24 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documenttype`
--

CREATE TABLE `documenttype` (
  `idDocumentType` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `documenttype`
--

INSERT INTO `documenttype` (`idDocumentType`, `name`, `description`) VALUES
(1, 'DNI', 'Documento de identidad del ciudadano peruano.'),
(2, 'Pasaporte', 'Documento de identidad de los extrajeros.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `driverlicense`
--

CREATE TABLE `driverlicense` (
  `idDriverLicense` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `driverlicense`
--

INSERT INTO `driverlicense` (`idDriverLicense`, `name`, `description`) VALUES
(1, 'A-I', 'Vehículos pequeños.'),
(2, 'A-II', 'Vehículos medianos.'),
(3, 'A-III', 'Vehículos pesados.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employee`
--

CREATE TABLE `employee` (
  `idEmployee` int(10) UNSIGNED NOT NULL,
  `names` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fatherLastName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `motherLastName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `birthdate` datetime NOT NULL,
  `documentNumber` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entryDate` datetime NOT NULL,
  `endDate` datetime DEFAULT NULL,
  `idDocumentType` int(10) UNSIGNED NOT NULL,
  `idDriverLicense` int(10) UNSIGNED DEFAULT NULL,
  `idPosition` int(10) UNSIGNED NOT NULL,
  `idUser` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `employee`
--

INSERT INTO `employee` (`idEmployee`, `names`, `fatherLastName`, `motherLastName`, `birthdate`, `documentNumber`, `email`, `state`, `gender`, `phone`, `entryDate`, `endDate`, `idDocumentType`, `idDriverLicense`, `idPosition`, `idUser`) VALUES
(1, 'Henry Antonio', 'Espinoza', 'Torres', '1990-12-20 00:00:00', '46618582', 'henryespinozat@gmail.com', 'Activo', 'Masculino', '930414373', '2016-01-01 00:00:00', NULL, 1, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item`
--

CREATE TABLE `item` (
  `idItem` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `price` double(15,2) NOT NULL,
  `state` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `realStock` double(15,2) NOT NULL,
  `availableStock` double(15,2) NOT NULL,
  `idUnit` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `item`
--

INSERT INTO `item` (`idItem`, `name`, `price`, `state`, `realStock`, `availableStock`, `idUnit`) VALUES
(1, 'Acido muriatico 1L', 5.00, 'Activo', 0.00, 0.00, 7),
(2, 'Adaptador de agua 1/2"', 1.00, 'Activo', 0.00, 0.00, 3),
(3, 'Adaptador de agua 3/4"', 2.50, 'Activo', 0.00, 0.00, 3),
(4, 'Adaptador de agua caliente 1/2"', 1.00, 'Activo', 0.00, 0.00, 3),
(5, 'Alambre N° 16', 4.00, 'Activo', 0.00, 0.00, 6),
(6, 'Alambre N° 8', 4.00, 'Activo', 0.00, 0.00, 6),
(7, 'Arena fina', 60.00, 'Activo', 0.00, 0.00, 2),
(8, 'Arena gruesa', 50.00, 'Activo', 0.00, 0.00, 2),
(9, 'Cable de luz N° 12', 145.00, 'Activo', 0.00, 0.00, 10),
(10, 'Cable de luz N° 14', 80.00, 'Activo', 0.00, 0.00, 10),
(11, 'Calamina de 3.0 m', 12.00, 'Activo', 0.00, 0.00, 3),
(12, 'Calamina de 3.6 m', 14.00, 'Activo', 0.00, 0.00, 3),
(13, 'Cemento andino tipo 1', 24.00, 'Activo', 0.00, 0.00, 1),
(14, 'Cemento andino tipo 5', 27.00, 'Activo', 0.00, 0.00, 1),
(15, 'Cemento apu tipo 1', 19.50, 'Activo', 0.00, 0.00, 1),
(16, 'Cemento inka azul', 22.50, 'Activo', 0.00, 0.00, 1),
(17, 'Cemento inka rojo', 20.00, 'Activo', 0.00, 0.00, 1),
(18, 'Cemento sol tipo 1', 22.00, 'Activo', 0.00, 0.00, 1),
(19, 'Clavo de 1 y 1/2"', 8.00, 'Activo', 0.00, 0.00, 6),
(20, 'Clavo de 1"', 8.00, 'Activo', 0.00, 0.00, 6),
(21, 'Clavo de 2"', 4.50, 'Activo', 0.00, 0.00, 6),
(22, 'Clavo de 3"', 4.50, 'Activo', 0.00, 0.00, 6),
(23, 'Clavo de 4"', 4.50, 'Activo', 0.00, 0.00, 6),
(24, 'Clavo de acero 2"', 9.00, 'Activo', 0.00, 0.00, 11),
(25, 'Clavo de acero 3"', 9.00, 'Activo', 0.00, 0.00, 11),
(26, 'Clavo de acero 4"', 9.00, 'Activo', 0.00, 0.00, 11),
(27, 'Clavo de calamina', 8.00, 'Activo', 0.00, 0.00, 6),
(28, 'Codo bronce de 1/2', 4.50, 'Activo', 0.00, 0.00, 3),
(29, 'Codo de agua 1/2"', 1.00, 'Activo', 0.00, 0.00, 3),
(30, 'Codo de agua 3/4" 45°', 2.50, 'Activo', 0.00, 0.00, 3),
(31, 'Codo de agua 3/4" 90°', 2.50, 'Activo', 0.00, 0.00, 3),
(32, 'Codo de agua caliente 1/2"', 1.00, 'Activo', 0.00, 0.00, 3),
(33, 'Codo de desague 2" 45°', 1.50, 'Activo', 0.00, 0.00, 3),
(34, 'Codo de desague 2" 90°', 1.50, 'Activo', 0.00, 0.00, 3),
(35, 'Codo de desague 4" 45°', 5.00, 'Activo', 0.00, 0.00, 3),
(36, 'Codo de desague 4" 90°', 5.00, 'Activo', 0.00, 0.00, 3),
(37, 'Codo de desague 4" a 2"', 7.00, 'Activo', 0.00, 0.00, 3),
(38, 'Codo de luz 1"', 1.00, 'Activo', 0.00, 0.00, 3),
(39, 'Codo de luz 3/4"', 0.50, 'Activo', 0.00, 0.00, 3),
(40, 'Codo galvanizado de 1/2"', 1.50, 'Activo', 0.00, 0.00, 3),
(41, 'Disco corte fierro de 14"', 20.00, 'Activo', 0.00, 0.00, 3),
(42, 'Disco corte fierro de 4"', 5.00, 'Activo', 0.00, 0.00, 3),
(43, 'Disco corte fierro de 7"', 8.00, 'Activo', 0.00, 0.00, 3),
(44, 'Disco corte fierro de 9"', 12.00, 'Activo', 0.00, 0.00, 3),
(45, 'Disco para concreto de 15" - dinamo', 15.00, 'Activo', 0.00, 0.00, 3),
(46, 'Disco para concreto de 15" - kamasa', 22.00, 'Activo', 0.00, 0.00, 3),
(47, 'Disco para concreto de 30" - dinamo', 30.00, 'Activo', 0.00, 0.00, 3),
(48, 'Disco para concreto de 4" - dinamo', 8.00, 'Activo', 0.00, 0.00, 3),
(49, 'Disco para concreto de 4" - kamasa', 9.00, 'Activo', 0.00, 0.00, 3),
(50, 'Fibraforte rojo', 4.00, 'Activo', 0.00, 0.00, 3),
(51, 'Fibraforte rojo economico', 16.00, 'Activo', 0.00, 0.00, 3),
(52, 'Fibraforte translucida', 32.00, 'Activo', 0.00, 0.00, 3),
(53, 'Fierro de 1/2" - siderperu', 25.50, 'Activo', 0.00, 0.00, 4),
(54, 'Fierro de 1/4" 6mm - siderperu', 6.50, 'Activo', 0.00, 0.00, 4),
(55, 'Fierro de 3/4" - siderperu', 58.00, 'Activo', 0.00, 0.00, 4),
(56, 'Fierro de 3/8" - siderperu', 15.00, 'Activo', 0.00, 0.00, 4),
(57, 'Fierro de 5/8" - siderperu', 39.50, 'Activo', 0.00, 0.00, 4),
(58, 'Fierro de 8mm - siderperu', 11.00, 'Activo', 0.00, 0.00, 4),
(59, 'Foco de 27 W', 5.00, 'Activo', 0.00, 0.00, 3),
(60, 'Foco de 32 W', 6.50, 'Activo', 0.00, 0.00, 3),
(61, 'Foco de 42 W', 7.00, 'Activo', 0.00, 0.00, 3),
(62, 'Foco de 85 W', 14.00, 'Activo', 0.00, 0.00, 3),
(63, 'Foco LED de 7 W', 13.00, 'Activo', 0.00, 0.00, 3),
(64, 'Ladrillo de 18 huecos limpio (millar)', 670.00, 'Activo', 0.00, 0.00, 12),
(65, 'Ladrillo de 18 huecos semi limpio (millar)', 560.00, 'Activo', 0.00, 0.00, 12),
(66, 'Ladrillo de techo 12 x 30 (millar)', 2100.00, 'Activo', 0.00, 0.00, 12),
(67, 'Ladrillo de techo 15 x 30 (millar)', 2100.00, 'Activo', 0.00, 0.00, 12),
(68, 'Ladrillo de techo 8 x 30 (millar)', 2000.00, 'Activo', 0.00, 0.00, 12),
(69, 'Ladrillo pandereta (millar)', 410.00, 'Activo', 0.00, 0.00, 12),
(70, 'Ladrillo pastelero (unidad)', 2.00, 'Activo', 0.00, 0.00, 3),
(71, 'Llave termica bticino 16', 38.00, 'Activo', 0.00, 0.00, 3),
(72, 'Llave termica bticino 20', 38.00, 'Activo', 0.00, 0.00, 3),
(73, 'Llave termica bticino 32', 38.00, 'Activo', 0.00, 0.00, 3),
(74, 'Llave termica bticino 60', 50.00, 'Activo', 0.00, 0.00, 3),
(75, 'Llave termica stronger 60', 18.00, 'Activo', 0.00, 0.00, 3),
(76, 'Malla (x metro)', 7.00, 'Activo', 0.00, 0.00, 8),
(77, 'Niple bronce de 1/2"', 4.00, 'Activo', 0.00, 0.00, 3),
(78, 'Niple de 1/2"', 1.00, 'Activo', 0.00, 0.00, 3),
(79, 'Pegamento de PVC 1/16" azul', 11.00, 'Activo', 0.00, 0.00, 7),
(80, 'Pegamento de PVC 1/16" dorado', 10.00, 'Activo', 0.00, 0.00, 7),
(81, 'Pegamento de PVC 1/32" azul', 8.00, 'Activo', 0.00, 0.00, 7),
(82, 'Pegamento de PVC 1/32" dorado', 7.00, 'Activo', 0.00, 0.00, 7),
(83, 'Pegamento de PVC 1/4" dorado', 28.00, 'Activo', 0.00, 0.00, 7),
(84, 'Pegamento de PVC 1/8" azul', 25.00, 'Activo', 0.00, 0.00, 7),
(85, 'Pegamento de PVC 1/8" dorado', 15.00, 'Activo', 0.00, 0.00, 7),
(86, 'Pegamento de PVC agua caliente', 6.50, 'Activo', 0.00, 0.00, 7),
(87, 'Pegamento en polvo - celima', 14.00, 'Activo', 0.00, 0.00, 7),
(88, 'Piedra chancada', 50.00, 'Activo', 0.00, 0.00, 2),
(89, 'Piedra confitillo', 50.00, 'Activo', 0.00, 0.00, 2),
(90, 'Piedra zanja', 50.00, 'Activo', 0.00, 0.00, 2),
(91, 'Reduccion de desague 4" a 2"', 3.50, 'Activo', 0.00, 0.00, 3),
(92, 'Rodillo de 12" - toro', 14.00, 'Activo', 0.00, 0.00, 3),
(93, 'Rodillo de 9" - toro', 12.00, 'Activo', 0.00, 0.00, 3),
(94, 'Tee bronce de 1/2"', 5.00, 'Activo', 0.00, 0.00, 3),
(95, 'Tee de agua 1/2"', 1.50, 'Activo', 0.00, 0.00, 3),
(96, 'Tee de agua 3/4"', 3.00, 'Activo', 0.00, 0.00, 3),
(97, 'Tee de agua caliente 1/2"', 1.50, 'Activo', 0.00, 0.00, 3),
(98, 'Tee de desague 4" x 2"', 6.00, 'Activo', 0.00, 0.00, 3),
(99, 'Tee de desague 4" x 4"', 7.00, 'Activo', 0.00, 0.00, 3),
(100, 'Tee de desague sanitaria 2"', 3.50, 'Activo', 0.00, 0.00, 3),
(101, 'Triplay', 24.00, 'Activo', 0.00, 0.00, 3),
(102, 'Tubo de agua 1/2"', 10.00, 'Activo', 0.00, 0.00, 3),
(103, 'Tubo de agua 3/4"', 18.00, 'Activo', 0.00, 0.00, 3),
(104, 'Tubo de agua caliente 1/2"', 18.00, 'Activo', 0.00, 0.00, 3),
(105, 'Tubo de agua desague 2"', 10.00, 'Activo', 0.00, 0.00, 3),
(106, 'Tubo de agua desague 3"', 17.00, 'Activo', 0.00, 0.00, 3),
(107, 'Tubo de agua desague 4"', 20.00, 'Activo', 0.00, 0.00, 3),
(108, 'Tubo de luz 1"', 6.00, 'Activo', 0.00, 0.00, 3),
(109, 'Tubo de luz 3/4"', 3.00, 'Activo', 0.00, 0.00, 3),
(110, 'Union bronce de 1/2"', 4.00, 'Activo', 0.00, 0.00, 3),
(111, 'Union de agua 1/2"', 1.00, 'Activo', 0.00, 0.00, 3),
(112, 'Union de agua 3/4"', 2.50, 'Activo', 0.00, 0.00, 3),
(113, 'Visagra de 3" (par)', 3.00, 'Activo', 0.00, 0.00, 9),
(114, 'Visagra de 3" capuchino (par)', 3.50, 'Activo', 0.00, 0.00, 9),
(115, 'Yee de desague 2"', 3.00, 'Activo', 0.00, 0.00, 3),
(116, 'Yee de desague 4" x 2"', 6.00, 'Activo', 0.00, 0.00, 3),
(117, 'Yee de desague 4" x 4"', 10.00, 'Activo', 0.00, 0.00, 3),
(118, 'Yee sanitario de 2"', 3.50, 'Activo', 0.00, 0.00, 3),
(119, 'Yee sanitario de 4"', 12.00, 'Activo', 0.00, 0.00, 3),
(120, 'Yee sanitario de 4" x 2"', 7.00, 'Activo', 0.00, 0.00, 3),
(121, 'Rectangular', 1.00, 'Activo', 0.00, 0.00, 3),
(122, 'Octogonal', 1.20, 'Activo', 0.00, 0.00, 3),
(123, 'Ladrillo pandereta (unidad)', 0.00, 'Activo', 0.00, 0.00, 12),
(124, 'Ladrillo de techo 12 x 30 (unidad)', 2.10, 'Activo', 0.00, 0.00, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itemxorder`
--

CREATE TABLE `itemxorder` (
  `idOrder` int(10) UNSIGNED NOT NULL,
  `idItem` int(10) UNSIGNED NOT NULL,
  `quantity` double(15,2) NOT NULL,
  `unitPrice` double(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `itemxorder`
--

INSERT INTO `itemxorder` (`idOrder`, `idItem`, `quantity`, `unitPrice`) VALUES
(1, 18, 5.00, 21.00),
(2, 13, 10.00, 23.00),
(3, 8, 4.00, 50.00),
(3, 15, 15.00, 19.50),
(3, 88, 1.00, 50.00),
(4, 8, 4.00, 50.00),
(4, 88, 3.00, 50.00),
(5, 5, 1.00, 4.00),
(5, 8, 2.00, 70.00),
(5, 18, 8.00, 21.00),
(5, 34, 1.00, 1.50),
(5, 36, 4.00, 5.00),
(5, 39, 6.00, 0.50),
(5, 54, 3.00, 6.50),
(5, 58, 2.00, 11.00),
(5, 105, 3.00, 10.00),
(5, 107, 2.00, 20.00),
(5, 109, 4.00, 3.00),
(6, 5, 60.00, 4.00),
(6, 6, 30.00, 4.00),
(6, 8, 30.00, 50.00),
(6, 13, 120.00, 23.00),
(6, 21, 44.00, 4.50),
(6, 44, 4.00, 12.00),
(6, 53, 40.00, 25.50),
(6, 54, 15.00, 6.50),
(6, 56, 100.00, 15.00),
(6, 57, 115.00, 39.50),
(6, 88, 20.00, 50.00),
(7, 7, 14.00, 60.00),
(7, 13, 13.00, 23.00),
(7, 18, 10.00, 21.00),
(7, 23, 10.00, 4.50),
(8, 13, 5.00, 23.00),
(8, 18, 13.00, 21.00),
(8, 53, 25.00, 25.50),
(8, 55, 15.00, 58.00),
(9, 8, 0.50, 50.00),
(9, 18, 3.00, 21.00),
(10, 7, 0.50, 60.00),
(10, 18, 4.00, 21.00),
(11, 124, 450.00, 2.10),
(12, 34, 8.00, 1.50),
(12, 37, 1.00, 7.00),
(12, 39, 30.00, 0.50),
(12, 83, 1.00, 28.00),
(12, 100, 4.00, 3.50),
(12, 105, 1.00, 10.00),
(12, 107, 1.00, 20.00),
(12, 109, 14.00, 3.00),
(12, 115, 4.00, 3.00),
(12, 122, 10.00, 1.20),
(13, 5, 50.00, 4.00),
(13, 8, 16.00, 50.00),
(13, 18, 150.00, 21.00),
(13, 53, 90.00, 25.50),
(13, 54, 100.00, 6.50),
(13, 56, 30.00, 15.00),
(13, 57, 18.00, 39.50),
(13, 58, 30.00, 11.00),
(13, 67, 0.70, 2100.00),
(13, 88, 14.00, 50.00),
(14, 5, 8.00, 4.00),
(14, 8, 12.00, 50.00),
(14, 14, 75.00, 27.00),
(14, 21, 5.00, 4.50),
(14, 53, 10.00, 25.50),
(14, 56, 24.00, 15.00),
(14, 57, 16.00, 39.50),
(14, 65, 1.50, 560.00),
(14, 88, 5.00, 50.00),
(15, 8, 10.00, 45.00),
(15, 14, 56.00, 28.00),
(15, 18, 70.00, 22.00),
(15, 53, 54.00, 25.50),
(15, 54, 40.00, 6.50),
(15, 57, 12.00, 39.50),
(15, 58, 20.00, 11.00),
(15, 67, 0.45, 2100.00),
(15, 88, 6.00, 50.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itemxzone`
--

CREATE TABLE `itemxzone` (
  `idItem` int(10) UNSIGNED NOT NULL,
  `idZone` int(10) UNSIGNED NOT NULL,
  `price` double(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `itemxzone`
--

INSERT INTO `itemxzone` (`idItem`, `idZone`, `price`) VALUES
(7, 2, 80.00),
(8, 2, 70.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(148, '2014_10_12_000000_create_users_table', 1),
(149, '2016_12_17_172211_create_position_table', 1),
(150, '2016_12_17_172439_create_driverLicense_table', 1),
(151, '2016_12_17_183311_create_documentType_table', 1),
(152, '2016_12_17_183411_create_employee_table', 1),
(153, '2016_12_20_194013_create_unit_table', 1),
(154, '2016_12_20_194213_create_item_table', 1),
(155, '2016_12_21_083440_create_zone_table', 1),
(156, '2016_12_21_083848_create_itemXZone_table', 1),
(157, '2016_12_24_105151_create_client_table', 1),
(158, '2016_12_24_110935_create_address_table', 1),
(159, '2016_12_25_201254_create_order_table', 1),
(160, '2016_12_25_201305_create_itemXOrder_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order`
--

CREATE TABLE `order` (
  `idOrder` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registerDate` datetime NOT NULL,
  `totalAmount` double(15,2) NOT NULL,
  `receivedAmount` double(15,2) NOT NULL,
  `state` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `idClient` int(10) UNSIGNED DEFAULT NULL,
  `idZone` int(10) UNSIGNED NOT NULL,
  `idEmployee` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `order`
--

INSERT INTO `order` (`idOrder`, `name`, `address`, `phone`, `registerDate`, `totalAmount`, `receivedAmount`, `state`, `idClient`, `idZone`, `idEmployee`) VALUES
(1, NULL, 'A1 LT1', NULL, '2017-01-02 09:56:35', 105.00, 110.00, 'Confirmado', NULL, 1, 1),
(2, NULL, 'H13 LT 37', NULL, '2017-01-02 10:51:10', 230.00, 0.00, 'Confirmado', NULL, 7, 1),
(3, 'los angeles', 'los angeles', NULL, '2017-01-02 10:52:42', 542.50, 550.00, 'Confirmado', NULL, 7, 1),
(4, NULL, 'LOS ANGELES', NULL, '2017-01-02 10:57:27', 350.00, 300.00, 'Confirmado', NULL, 7, 1),
(5, NULL, NULL, NULL, '2017-01-02 12:48:11', 460.00, 0.00, 'Confirmado', NULL, 7, 1),
(6, NULL, NULL, NULL, '2017-01-02 15:05:22', 13026.00, 0.00, 'Confirmado', NULL, 1, 1),
(7, NULL, NULL, NULL, '2017-01-09 16:02:36', 1394.00, 1300.00, 'Anulado', NULL, 4, 1),
(8, NULL, NULL, NULL, '2017-01-09 16:03:51', 1895.50, 2000.00, 'Anulado', NULL, 1, 1),
(9, NULL, 'MZ D4 LT 12', NULL, '2017-01-09 16:05:49', 88.00, 88.00, 'Pagado', NULL, 1, 1),
(10, NULL, 'MZ C2 LT 21', NULL, '2017-01-09 16:07:09', 114.00, 114.00, 'Pagado', NULL, 1, 1),
(11, NULL, 'MZ C LT I - VILLA VIRGEN', NULL, '2017-01-09 16:17:27', 945.00, 0.00, 'Deuda', NULL, 7, 1),
(12, NULL, 'PROFORMA', NULL, '2017-01-09 16:30:47', 172.00, 0.00, 'Deuda', NULL, 7, 1),
(13, NULL, NULL, NULL, '2017-01-12 16:06:08', 10756.00, 0.00, 'Anulado', NULL, 1, 1),
(14, NULL, NULL, NULL, '2017-01-12 16:08:36', 5016.50, 0.00, 'Anulado', NULL, 1, 1),
(15, NULL, NULL, NULL, '2017-01-16 18:25:30', 7134.00, 0.00, 'Deuda', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `position`
--

CREATE TABLE `position` (
  `idPosition` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `position`
--

INSERT INTO `position` (`idPosition`, `name`, `description`) VALUES
(1, 'Administrador del sistema', 'Responsable del sistema de información.'),
(2, 'Administrador', 'Resposable del personal de la empresa.'),
(3, 'Chofer', 'Encargado de enviar los pedidos.'),
(4, 'Cajero', 'Encargado de recibir los pedidos.'),
(5, 'Almacenero', 'Encargado del almacen.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unit`
--

CREATE TABLE `unit` (
  `idUnit` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `unit`
--

INSERT INTO `unit` (`idUnit`, `name`) VALUES
(1, 'bolsa'),
(2, 'm3'),
(3, 'unidad'),
(4, 'varilla'),
(5, 'otro'),
(6, 'kg'),
(7, 'envase'),
(8, 'm'),
(9, 'par'),
(10, 'rollo'),
(11, 'caja'),
(12, 'millar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '46618582', '$2y$10$R0996vXHPAQ9aYOKEMDV9ewnwsSnOMSxuZ7BnLIK/1GDyZokl3lIK', 'wUqgIYeKnDNtybJIouLeBX9fFqkaiqdRfGKFZ3e3RpCmvpiP1SS05PLoUJ0o', '2017-01-02 14:42:51', '2017-01-12 21:23:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zone`
--

CREATE TABLE `zone` (
  `idZone` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `shipping` double(15,2) NOT NULL,
  `state` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `zone`
--

INSERT INTO `zone` (`idZone`, `name`, `shipping`, `state`) VALUES
(1, '10 de octubre', 0.00, 'Activo'),
(2, 'Maria jesus', 0.00, 'Activo'),
(3, 'Nueva luz', 0.00, 'Activo'),
(4, 'Balcones verdes', 0.00, 'Activo'),
(5, 'Santa rosita sector 5', 0.00, 'Activo'),
(6, 'Planicie', 0.00, 'Activo'),
(7, 'Otro', 0.00, 'Activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`idAddress`),
  ADD KEY `address_idclient_foreign` (`idClient`),
  ADD KEY `address_idzone_foreign` (`idZone`);

--
-- Indices de la tabla `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idClient`),
  ADD UNIQUE KEY `client_documentnumber_unique` (`documentNumber`),
  ADD UNIQUE KEY `client_email_unique` (`email`),
  ADD KEY `client_iddocumenttype_foreign` (`idDocumentType`);

--
-- Indices de la tabla `documenttype`
--
ALTER TABLE `documenttype`
  ADD PRIMARY KEY (`idDocumentType`);

--
-- Indices de la tabla `driverlicense`
--
ALTER TABLE `driverlicense`
  ADD PRIMARY KEY (`idDriverLicense`);

--
-- Indices de la tabla `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`idEmployee`),
  ADD UNIQUE KEY `employee_documentnumber_unique` (`documentNumber`),
  ADD UNIQUE KEY `employee_email_unique` (`email`),
  ADD KEY `employee_iddocumenttype_foreign` (`idDocumentType`),
  ADD KEY `employee_iddriverlicense_foreign` (`idDriverLicense`),
  ADD KEY `employee_idposition_foreign` (`idPosition`),
  ADD KEY `employee_iduser_foreign` (`idUser`);

--
-- Indices de la tabla `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`idItem`),
  ADD KEY `item_idunit_foreign` (`idUnit`);

--
-- Indices de la tabla `itemxorder`
--
ALTER TABLE `itemxorder`
  ADD PRIMARY KEY (`idOrder`,`idItem`),
  ADD KEY `itemxorder_iditem_foreign` (`idItem`);

--
-- Indices de la tabla `itemxzone`
--
ALTER TABLE `itemxzone`
  ADD PRIMARY KEY (`idItem`,`idZone`),
  ADD KEY `itemxzone_idzone_foreign` (`idZone`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`idOrder`),
  ADD KEY `order_idclient_foreign` (`idClient`),
  ADD KEY `order_idzone_foreign` (`idZone`),
  ADD KEY `order_idemployee_foreign` (`idEmployee`);

--
-- Indices de la tabla `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`idPosition`);

--
-- Indices de la tabla `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`idUnit`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_name_unique` (`name`);

--
-- Indices de la tabla `zone`
--
ALTER TABLE `zone`
  ADD PRIMARY KEY (`idZone`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `address`
--
ALTER TABLE `address`
  MODIFY `idAddress` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `client`
--
ALTER TABLE `client`
  MODIFY `idClient` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `documenttype`
--
ALTER TABLE `documenttype`
  MODIFY `idDocumentType` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `driverlicense`
--
ALTER TABLE `driverlicense`
  MODIFY `idDriverLicense` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `employee`
--
ALTER TABLE `employee`
  MODIFY `idEmployee` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `item`
--
ALTER TABLE `item`
  MODIFY `idItem` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;
--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;
--
-- AUTO_INCREMENT de la tabla `order`
--
ALTER TABLE `order`
  MODIFY `idOrder` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `position`
--
ALTER TABLE `position`
  MODIFY `idPosition` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `unit`
--
ALTER TABLE `unit`
  MODIFY `idUnit` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `zone`
--
ALTER TABLE `zone`
  MODIFY `idZone` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_idclient_foreign` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`),
  ADD CONSTRAINT `address_idzone_foreign` FOREIGN KEY (`idZone`) REFERENCES `zone` (`idZone`);

--
-- Filtros para la tabla `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_iddocumenttype_foreign` FOREIGN KEY (`idDocumentType`) REFERENCES `documenttype` (`idDocumentType`);

--
-- Filtros para la tabla `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_iddocumenttype_foreign` FOREIGN KEY (`idDocumentType`) REFERENCES `documenttype` (`idDocumentType`),
  ADD CONSTRAINT `employee_iddriverlicense_foreign` FOREIGN KEY (`idDriverLicense`) REFERENCES `driverlicense` (`idDriverLicense`),
  ADD CONSTRAINT `employee_idposition_foreign` FOREIGN KEY (`idPosition`) REFERENCES `position` (`idPosition`),
  ADD CONSTRAINT `employee_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_idunit_foreign` FOREIGN KEY (`idUnit`) REFERENCES `unit` (`idUnit`);

--
-- Filtros para la tabla `itemxorder`
--
ALTER TABLE `itemxorder`
  ADD CONSTRAINT `itemxorder_iditem_foreign` FOREIGN KEY (`idItem`) REFERENCES `item` (`idItem`),
  ADD CONSTRAINT `itemxorder_idorder_foreign` FOREIGN KEY (`idOrder`) REFERENCES `order` (`idOrder`);

--
-- Filtros para la tabla `itemxzone`
--
ALTER TABLE `itemxzone`
  ADD CONSTRAINT `itemxzone_iditem_foreign` FOREIGN KEY (`idItem`) REFERENCES `item` (`idItem`),
  ADD CONSTRAINT `itemxzone_idzone_foreign` FOREIGN KEY (`idZone`) REFERENCES `zone` (`idZone`);

--
-- Filtros para la tabla `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_idclient_foreign` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`),
  ADD CONSTRAINT `order_idemployee_foreign` FOREIGN KEY (`idEmployee`) REFERENCES `employee` (`idEmployee`),
  ADD CONSTRAINT `order_idzone_foreign` FOREIGN KEY (`idZone`) REFERENCES `zone` (`idZone`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
