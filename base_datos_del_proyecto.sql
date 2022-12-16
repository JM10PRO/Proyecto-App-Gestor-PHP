-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-12-2022 a las 01:39:16
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tareas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id` int(11) NOT NULL,
  `nif` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personacontacto` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` int(12) NOT NULL,
  `correo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poblacion` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codpostal` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provincia` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechacreacion` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operario` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecharealizacion` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anotacionanterior` varchar(140) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anotacionposterior` varchar(140) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ficheroresumen` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fotos` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id`, `nif`, `personacontacto`, `telefono`, `correo`, `poblacion`, `codpostal`, `provincia`, `direccion`, `estado`, `fechacreacion`, `operario`, `fecharealizacion`, `anotacionanterior`, `anotacionposterior`, `descripcion`, `ficheroresumen`, `fotos`) VALUES
(1, 'Tarea prim', 'pepe', 959555333, 'example@gmail.com', 'Roquetas de Mar', '04001', 'Almería', 'una direccion', 'B', '', '', '', '', '', '', '', ''),
(2, 'Tarea segu', '5', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, 'tarea terc', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4, 'otra tarea', '3', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, 'otrad', '4', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(6, 'una mas', '4', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(7, '2341234123', '3', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(8, 'asdfasdf', '2', 0, '', '', '', '', '', '', '', '', '', 'grtgt', 'greg', '', 'mysql2.png', 'wsgipython.png'),
(9, '21453658a', 'hfjf', 987654321, 'hola@gmial.com', 'rewrwe', '52548', 'Asturias', 'gregegre', 'B', '05-12-22', 'pepe', '2022-12-14', 'notas anteriores', 'd', '', '9_mysql2.png', '9_wsgipython.png'),
(12, '21016575A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'P', '11-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', '', '', ''),
(13, '21016575a', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'P', '11-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', '', '', ''),
(14, '21016575A', 'Juan', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'P', '11-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', '', '', ''),
(15, '21016575a', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'P', '11-12-2022', 'santi', '2022-12-12', 'gbrtegera', 'getrgertp', 'una descripción', '', ''),
(16, '21016575a', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'P', '11-12-2022', 'santi', '2022-12-12', 'gbrtegera', 'getrgertp', 'una descripción', '', ''),
(17, '21016575A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'P', '11-12-2022', 'santi', '2022-12-12', 'gbrtegera', 'getrgertp', 'una descripción', '', ''),
(18, '21016575a', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'P', '11-12-2022', 'santi', '2022-12-12', 'gbrtegera', 'getrgertp', 'una descripción', '', ''),
(19, '21016575A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'P', '11-12-2022', 'santi', '2022-12-12', 'gbrtegera', 'getrgertp', 'una descripción', '', ''),
(20, '21016575A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'P', '11-12-2022', 'santi', '2022-12-14', 'gbrtegera', 'getrgertp', 'una descripción', '', ''),
(21, '21016575A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'P', '11-12-2022', 'santi', '2022-12-15', 'gbrtegera', 'getrgertp', 'una descripción', '', ''),
(22, '21016575A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'P', '11-12-2022', 'santi', '2022-12-15', 'gbrtegera', 'getrgertp', 'una descripción', '', ''),
(23, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(24, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(25, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(26, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(27, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(28, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(29, '21016575a', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cáceres', 'Avenida de los pescadores', 'R', '10-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', '', ''),
(30, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(31, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(32, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(33, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(34, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(35, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(36, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(37, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(38, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(39, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(40, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(41, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(42, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(43, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(44, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(45, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(46, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(47, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(48, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', '', '', ''),
(49, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(50, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(51, '21016575A', '', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '07-12-22', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', '', '', ''),
(52, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(53, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(54, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(55, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(56, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(57, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(58, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(59, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(60, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(61, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(62, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(63, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(64, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(65, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(66, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(67, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(68, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(69, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(70, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(71, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(72, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(73, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(74, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(75, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(76, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(77, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(78, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(79, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(80, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(81, '123456789A', 'persona', 555444333, 'hola@gmail.com', 'Zahara de los Atunes', '32014', 'Cádiz', 'Avenida de los pescadores', 'R', '06-12-2022', 'santi', '07-12-2022', 'gbrtegera', 'getrgertp', 'una descripción', 'fichero.jpg', 'foto.jpg'),
(82, '21016575A', 'gre', 369852147, 'ff@vfr.com', 'htrht', '10258', 'Castellón', 'htrtr', 'P', '12-12-2022', 'pepe', '', 'tretre', 'rtet', 'gtrete', '', ''),
(83, '21016575A', 'josemaria', 963258741, 'ff@vfr.com', 'htrht', '10258', 'Ávila', 'htrtr', 'P', '12-12-2022', 'santi', '2022-12-29', 'josemaria', 'gyguy', '', 'mysql2.png', 'awstats2.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `rol` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `rol`) VALUES
(1, 'josemaria', 'passwd1234', 'admin'),
(2, 'pepe', '1234', 'operario'),
(5, 'juan', '2221', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
