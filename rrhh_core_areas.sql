-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-05-2016 a las 23:30:18
-- Versión del servidor: 5.7.9
-- Versión de PHP: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rrhh`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rrhh_core_areas`
--

DROP TABLE IF EXISTS `rrhh_core_areas`;
CREATE TABLE IF NOT EXISTS `rrhh_core_areas` (
  `id_area` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `columnas` int(11) NOT NULL,
  `disabled` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id_area`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rrhh_core_areas`
--

INSERT INTO `rrhh_core_areas` (`id_area`, `nombre`, `parent_id`, `lft`, `rgt`, `level`, `id_cargo`, `columnas`, `disabled`, `created_by`, `created`, `modified_by`, `modified`) VALUES
(1, 'root', 0, 0, 17, 0, 0, 0, 0, 0, '2016-05-08 00:00:00', 0, '2016-05-08 00:00:00'),
(2, 'Dirección Ejecutiva', 1, 1, 2, 1, 1, 0, 0, 0, '2016-05-08 00:00:00', 0, '2016-05-08 00:00:00'),
(3, 'Dirección Comercial\r\n', 2, 3, 4, 1, 2, 0, 0, 0, '2016-05-08 00:00:00', 0, '2016-05-08 00:00:00'),
(4, 'Dirección Financiera\r\n\r\n', 2, 5, 6, 1, 5, 0, 0, 0, '2016-05-08 00:00:00', 0, '2016-05-08 00:00:00'),
(5, 'Dirección Asuntos Corporativos y RRHH', 2, 7, 8, 1, 4, 0, 0, 0, '2016-05-08 00:00:00', 0, '2016-05-08 00:00:00'),
(6, 'Dirección de Planta', 2, 9, 10, 1, 3, 0, 0, 0, '2016-05-08 00:00:00', 0, '2016-05-08 00:00:00'),
(7, 'Gerencia de Producción', 6, 11, 12, 2, 33, 0, 0, 0, '2016-05-08 00:00:00', 0, '2016-05-08 00:00:00'),
(8, 'Gerencia de Mantenimiento', 6, 13, 14, 2, 34, 0, 0, 0, '2016-05-08 00:00:00', 0, '2016-05-08 00:00:00'),
(9, 'Gerencia Materias Primas\r\n', 6, 15, 16, 2, 35, 0, 0, 0, '2016-05-08 00:00:00', 0, '2016-05-08 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
