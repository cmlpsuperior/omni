-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-01-2017 a las 15:41:47
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
-- Estructura de tabla para la tabla `order`
--

CREATE TABLE `order` (
  `idOrder` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
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

INSERT INTO `order` (`idOrder`, `name`, `address`, `registerDate`, `totalAmount`, `receivedAmount`, `state`, `idClient`, `idZone`, `idEmployee`) VALUES
(2, NULL, NULL, '2016-12-27 16:54:42', 454.90, 500.00, 'Confirmado', NULL, 4, 1),
(3, NULL, NULL, '2016-12-27 16:57:25', 749.70, 800.00, 'Confirmado', NULL, 4, 1),
(4, NULL, NULL, '2016-12-27 17:13:32', 741.00, 800.00, 'Confirmado', NULL, 2, 1),
(5, NULL, NULL, '2016-12-27 17:37:39', 745.90, 800.00, 'Confirmado', NULL, 3, 1),
(6, NULL, NULL, '2016-12-27 17:39:21', 1384.25, 1300.00, 'Confirmado', NULL, 3, 1),
(8, NULL, NULL, '2016-12-27 18:03:32', 270.00, 300.00, 'Confirmado', NULL, 2, 1),
(9, NULL, NULL, '2016-12-27 18:04:44', 1120.00, 2000.00, 'Confirmado', NULL, 3, 1),
(10, NULL, NULL, '2016-12-27 18:05:47', 1064.50, 1100.00, 'Confirmado', NULL, 3, 1),
(11, NULL, NULL, '2016-12-27 18:07:46', 1105.00, 1200.00, 'Confirmado', NULL, 3, 1),
(12, NULL, NULL, '2016-12-27 18:08:20', 296.40, 200.00, 'Confirmado', NULL, 4, 1),
(13, 'edward', 'd1 lt5', '2016-12-27 20:07:50', 2696.35, 3000.00, 'Anulado', NULL, 3, 1),
(14, NULL, NULL, '2016-12-27 21:19:15', 612.40, 640.00, 'Anulado', NULL, 2, 1),
(15, 'henry', 'f4 lt11', '2016-12-28 00:08:38', 595.50, 550.00, 'Confirmado', NULL, 2, 1),
(16, NULL, NULL, '2016-12-28 00:12:19', 350.00, 400.00, 'Confirmado', NULL, 4, 1),
(17, NULL, NULL, '2016-12-28 00:20:33', 250.00, 300.00, 'Confirmado', NULL, 1, 1),
(18, 'henry', 'D1 LT 5', '2016-12-28 10:09:08', 1453.50, 1500.00, 'Confirmado', NULL, 2, 1),
(19, 'henry', 'MZ D1 LT 5', '2016-12-28 10:17:21', 1739.00, 1500.00, 'Confirmado', NULL, 2, 1),
(21, NULL, NULL, '2016-12-28 10:42:21', 251.85, 270.00, 'Confirmado', NULL, 4, 1),
(22, NULL, 'MZ D5 LT 6', '2016-12-28 10:44:24', 800.00, 1000.00, 'Confirmado', NULL, 3, 1),
(23, NULL, NULL, '2016-12-28 11:26:05', 1062.80, 1500.00, 'Confirmado', NULL, 3, 1),
(24, NULL, NULL, '2016-12-28 14:04:22', 800.00, 1000.00, 'Confirmado', NULL, 3, 1),
(25, 'melendes', 'MZ C10 LT 22', '2016-12-30 16:17:29', 1433.00, 1500.00, 'Confirmado', NULL, 1, 1),
(26, '995884339', 'TIENDA LURDES', '2016-12-30 16:39:09', 210.00, 0.00, 'Confirmado', NULL, 1, 1),
(27, NULL, 'MZ A1 LT33', '2016-12-30 16:49:28', 165.00, 0.00, 'Confirmado', NULL, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`idOrder`),
  ADD KEY `order_idclient_foreign` (`idClient`),
  ADD KEY `order_idzone_foreign` (`idZone`),
  ADD KEY `order_idemployee_foreign` (`idEmployee`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `order`
--
ALTER TABLE `order`
  MODIFY `idOrder` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- Restricciones para tablas volcadas
--

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
