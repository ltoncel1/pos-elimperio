-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-06-2018 a las 00:15:07
-- Versión del servidor: 10.1.29-MariaDB
-- Versión de PHP: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pos_elimperio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `fecha`) VALUES
(2, 'Cerveza', '2018-05-01 17:27:59'),
(4, 'Aperitivo', '2018-05-01 17:30:26'),
(6, 'Whisky', '2018-05-01 17:25:14'),
(7, 'Vodka', '2018-05-01 17:26:54'),
(8, 'Ron', '2018-05-01 17:27:07'),
(9, 'Vino', '2018-05-01 17:27:45'),
(10, 'Brandy', '2018-05-01 17:28:52'),
(11, 'Champaña', '2018-05-01 17:29:09'),
(12, 'Ginebra', '2018-05-01 17:29:21'),
(13, 'Tequila', '2018-05-01 17:29:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `documento` int(11) NOT NULL,
  `email` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `compras` int(11) NOT NULL,
  `ultima_compra` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `documento`, `email`, `telefono`, `direccion`, `fecha_nacimiento`, `compras`, `ultima_compra`, `fecha`) VALUES
(1, 'Mesa 1', 1, '', '(300) 646-3189', '', '0000-00-00', 18, '2018-06-10 15:36:09', '2018-06-10 20:36:09'),
(2, 'Mesa 2', 2, '', '(300) 646-3189', '', '0000-00-00', 42, '2018-06-10 02:45:15', '2018-06-10 07:45:15'),
(3, 'Mesa 3', 3, '', '(300) 646-3189', '', '0000-00-00', 11, '2018-06-10 02:56:05', '2018-06-10 07:56:05'),
(4, 'Mesa 4', 4, '', '(300) 646-3189', '', '0000-00-00', 6, '2018-06-01 19:22:01', '2018-06-02 00:22:01'),
(5, 'Mesa 5', 5, '', '(300) 646-3189', '', '0000-00-00', 12, '2018-06-04 12:00:34', '2018-06-04 17:00:34'),
(6, 'Carlos Beltran', 2147483647, 'cbeltran@gmail.com', '(300) 159-7854', 'Carrera 10a No 25 -15', '1985-10-15', 6, '2018-05-31 13:48:32', '2018-05-31 18:48:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `codigo` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `imagen` text COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `barcode` text COLLATE utf8_spanish_ci NOT NULL,
  `precio_compra` float NOT NULL,
  `precio_venta` float NOT NULL,
  `ventas` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_categoria`, `codigo`, `descripcion`, `imagen`, `stock`, `barcode`, `precio_compra`, `precio_venta`, `ventas`, `fecha`) VALUES
(1, 2, '201', 'Cerveza Aguila', 'vistas/images/productos/201/237.png', 10, '7702532310321', 1100, 2500, 10, '2018-04-26 01:14:23'),
(2, 2, '202', 'Cerveza Aguila Light', 'vistas/images/productos/202/672.png', 6, '7702123008842', 1100, 2500, 14, '2018-06-02 19:32:05'),
(3, 2, '203', 'Cerveza Stella Artois', 'vistas/images/productos/203/795.png', 20, '5410228141266', 100, 140, 0, '2018-05-18 04:25:38'),
(5, 2, '205', 'Cerveza Club Colombia', 'vistas/images/productos/205/765.png', 20, '', 270, 378, 0, '2018-05-18 04:23:49'),
(6, 2, '206', 'Cerveza Costeña', 'vistas/images/productos/206/595.png', 20, '', 75, 105, 0, '2018-05-18 04:22:54'),
(7, 2, '207', 'Cerveza Pilsen', 'vistas/images/productos/207/673.png', 20, '', 168, 235, 0, '2018-05-18 04:22:14'),
(8, 2, '208', 'Cerveza Poker', 'vistas/images/productos/208/217.png', 20, '', 1750, 2450, 0, '2018-05-18 04:21:34'),
(9, 2, '209', 'Cerveza Aguila Cero', 'vistas/images/productos/209/331.png', 20, '', 175, 245, 0, '2018-05-18 04:20:51'),
(10, 2, '210', 'Cerveza Costeñita', 'vistas/images/productos/210/153.png', 20, '', 420, 588, 0, '2018-05-18 04:19:54'),
(11, 2, '211', 'Cerveza Redds', 'vistas/images/productos/211/458.png', 20, '7702004011046', 3500, 4900, 0, '2018-05-18 03:52:07'),
(12, 2, '212', 'Cerveza Miller', 'vistas/images/productos/212/571.jpg', 20, '7702007110244', 3550, 4970, 0, '2018-05-18 04:19:06'),
(13, 2, '213', 'Cerveza Duff', 'vistas/images/productos/213/949.jpg', 20, '', 3600, 5040, 0, '2018-05-18 04:11:11'),
(14, 2, '214', 'Cerveza Heineken', 'vistas/images/productos/214/915.png', 10, '8712000030599', 2500, 5000, 9, '2018-05-30 19:33:26'),
(16, 2, '216', 'Cerveza Corona Extra', 'vistas/images/productos/216/116.png', 42, '75032715', 2500, 5000, 25, '2018-06-08 03:57:01'),
(17, 2, '217', 'Cerveza Corona Ligh', 'vistas/images/productos/217/801.jpg', 20, '7700102040807', 2500, 5000, 0, '2018-05-18 04:06:23'),
(18, 2, '218', 'Cerveza Budweiser', 'vistas/images/productos/218/783.png', 5, '018200001680', 2500, 5000, 14, '2018-06-02 19:32:52'),
(19, 4, '401', 'Martini Vermouth', 'vistas/images/productos/default/anonymous.png', 20, '', 3850, 5390, 0, '2018-05-17 21:21:48'),
(20, 4, '402', 'Aperol', 'vistas/images/productos/default/anonymous.png', 20, '', 3850, 5390, 0, '2018-05-17 21:21:58'),
(21, 4, '403', 'Cinzano Vermouth', 'vistas/images/productos/default/anonymous.png', 20, '', 3850, 5390, 0, '2018-05-17 21:22:12'),
(22, 6, '601', 'Johnnie Walker Red Label 750ml', 'vistas/images/productos/601/188.png', 20, '7701245789630', 29940, 49900, 0, '2018-05-18 04:43:46'),
(23, 6, '602', 'Buchanans 12 años 750ml', 'vistas/images/productos/602/832.jpg', 16, '7701598753214', 65400, 109000, 4, '2018-06-02 19:34:03'),
(24, 6, '603', 'Chivas Regal 12 años 750ml', 'vistas/images/productos/603/254.jpg', 20, '7700125468754', 65400, 109000, 0, '2018-05-18 04:34:03'),
(25, 6, '604', 'Ballantines Deluxe 12 años 750ml', 'vistas/images/productos/604/648.jpg', 20, '7707244561689', 75200, 105280, 0, '2018-05-18 04:33:36'),
(26, 6, '605', 'Black and White 750ml', 'vistas/images/productos/605/659.png', 20, '7703322154697', 32940, 54900, 0, '2018-05-18 04:31:07'),
(27, 6, '606', 'Old Parr 12 años 750ml', 'vistas/images/productos/606/202.jpg', 20, '7701254789635', 62940, 104900, 0, '2018-05-18 04:30:17'),
(28, 6, '607', 'Old Parr 12 años 1L', 'vistas/images/productos/607/373.jpg', 12, '7701144558874', 82940, 116116, 8, '2018-06-08 03:57:01'),
(29, 6, '608', 'robbie burns Robertico', 'vistas/images/productos/608/447.jpg', 14, '7701012047851', 29400, 49900, 5, '2018-06-06 14:04:38'),
(30, 6, '609', 'Vat 69', 'vistas/images/productos/default/anonymous.png', 12, '7700012125458', 22400, 31360, 0, '2018-05-17 19:58:12'),
(31, 7, '701', 'Smirnoff Vodka 700ml', 'vistas/images/productos/default/anonymous.png', 8, '7701230654741', 37800, 63000, 0, '2018-05-17 19:58:12'),
(32, 7, '702', 'Absolut Vodka 750ml', 'vistas/images/productos/default/anonymous.png', 16, '7707418521245', 41400, 69000, 0, '2018-05-17 19:58:12'),
(33, 7, '703', 'Grey Goose', 'vistas/images/productos/default/anonymous.png', 16, '', 400, 560, 0, '2018-05-17 21:22:45'),
(34, 7, '704', 'Stolichnaya', 'vistas/images/productos/default/anonymous.png', 3, '', 450, 630, 0, '2018-05-17 21:22:57'),
(35, 7, '705', 'Svedka', 'vistas/images/productos/default/anonymous.png', 20, '', 580, 812, 0, '2018-05-17 21:23:11'),
(36, 8, '801', 'Bacardi', 'vistas/images/productos/default/anonymous.png', 17, '', 420, 588, 0, '2018-05-19 17:59:58'),
(37, 8, '802', 'Captain Morgan', 'vistas/images/productos/default/anonymous.png', 15, '', 140, 196, 0, '2018-05-19 17:59:58'),
(38, 8, '803', 'Havana Club', 'vistas/images/productos/default/anonymous.png', 13, '', 930, 1302, 0, '2018-05-19 17:59:58'),
(39, 8, '804', 'Brugal', 'vistas/images/productos/default/anonymous.png', 13, '', 930, 1302, 0, '2018-05-19 17:59:58'),
(40, 8, '805', 'Cacique', 'vistas/images/productos/default/anonymous.png', 13, '', 930, 1302, 0, '2018-05-19 17:59:58'),
(41, 9, '901', 'Concha y Toro', 'vistas/images/productos/default/anonymous.png', 13, '', 930, 1302, 0, '2018-05-19 17:59:58'),
(42, 9, '902', 'Barefoot Wine', 'vistas/images/productos/default/anonymous.png', 13, '', 930, 1302, 0, '2018-05-19 17:59:58'),
(43, 9, '903', 'Gallo', 'vistas/images/productos/default/anonymous.png', 13, '', 930, 1302, 0, '2018-05-19 17:59:58'),
(44, 9, '904', 'Robert Mondavi', 'vistas/images/productos/default/anonymous.png', 13, '', 930, 1302, 0, '2018-05-19 17:59:58'),
(45, 9, '905', 'Yellowtail', 'vistas/images/productos/default/anonymous.png', 13, '', 930, 1302, 0, '2018-05-19 17:59:58'),
(46, 10, '1001', 'Hennessy', 'vistas/images/productos/default/anonymous.png', 13, '', 930, 1302, 0, '2018-05-19 17:59:58'),
(47, 10, '1002', 'Martell', 'vistas/images/productos/default/anonymous.png', 13, '', 930, 1302, 0, '2018-05-19 17:59:58'),
(48, 10, '1003', 'Dreher', 'vistas/images/productos/default/anonymous.png', 13, '', 930, 1302, 0, '2018-05-19 17:59:58'),
(49, 10, '1004', 'Remy Martin', 'vistas/images/productos/default/anonymous.png', 13, '', 930, 1302, 0, '2018-05-19 17:59:58'),
(50, 10, '1005', 'E&J Brandy', 'vistas/images/productos/default/anonymous.png', 13, '', 930, 1302, 0, '2018-05-19 17:59:58'),
(51, 11, '1101', 'Mo?t et Chandon', 'vistas/images/productos/default/anonymous.png', 13, '', 930, 1302, 0, '2018-05-19 17:59:58'),
(52, 11, '1102', 'Veuve Clicquot', 'vistas/images/productos/default/anonymous.png', 13, '', 930, 1302, 0, '2018-05-19 17:59:58'),
(53, 11, '1103', 'Freixenet', 'vistas/images/productos/default/anonymous.png', 13, '', 930, 1302, 0, '2018-05-19 17:59:58'),
(54, 11, '1104', 'Dom P?rignon', 'vistas/images/productos/default/anonymous.png', 13, '', 930, 1302, 0, '2018-05-19 17:59:58'),
(55, 11, '1105', 'Mumm', 'vistas/images/productos/default/anonymous.png', 13, '', 930, 1302, 0, '2018-05-19 17:59:58'),
(56, 12, '1201', 'Gordons Gin', 'vistas/images/productos/default/anonymous.png', 13, '', 930, 1302, 0, '2018-05-19 17:59:58'),
(57, 12, '1202', 'Tanqueray 40', 'vistas/images/productos/default/anonymous.png', 13, '', 930, 1302, 0, '2018-05-19 17:59:58'),
(58, 12, '1203', 'Bombay Sapphire', 'vistas/images/productos/default/anonymous.png', 13, '', 930, 1302, 0, '2018-05-19 17:59:58'),
(59, 12, '1204', 'Beefeater', 'vistas/images/productos/default/anonymous.png', 13, '', 930, 1302, 0, '2018-05-19 17:59:58'),
(60, 12, '1205', 'Seagrams Gin', 'vistas/images/productos/default/anonymous.png', 13, '', 930, 1302, 0, '2018-05-19 17:59:58'),
(61, 13, '1301', 'Cuervo', 'vistas/images/productos/default/anonymous.png', 13, '', 930, 1302, 0, '2018-05-19 17:59:58'),
(62, 13, '1302', 'Patron', 'vistas/images/productos/default/anonymous.png', 13, '', 930, 1302, 0, '2018-05-19 17:59:58'),
(63, 13, '1303', 'Sauza', 'vistas/images/productos/default/anonymous.png', 13, '', 930, 1302, 0, '2018-05-24 19:32:12'),
(64, 13, '1304', 'El Jimador', 'vistas/images/productos/default/anonymous.png', 13, '', 930, 1302, 0, '2018-05-24 19:32:12'),
(66, 8, '806', 'Medellin 8 años', 'vistas/images/productos/806/408.png', 20, '7701598741238', 35940, 43128, 0, '2018-05-24 19:32:11'),
(67, 6, '610', 'Buchanas DELUXE 12 años 1L', 'vistas/images/productos/610/845.jpg', 11, '7703322154810', 80500, 112700, 4, '2018-06-10 20:36:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `perfil` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`) VALUES
(60, 'Luis Toncel', 'administrador', '$2a$07$asxx54ahjppf45sd87a5aunxs9bkpyGmGE/.vekdjFg83yRec789S', 'Administrador', 'vistas/images/usuarios/administrador/389.jpg', 1, '2018-06-10 14:48:24', '2018-06-10 20:45:12'),
(78, 'Juan Correa', 'jcorrea', '$2a$07$asxx54ahjppf45sd87a5au.U/M0caGNRi1j0bgxZqVwBDctNLt11O', 'Inventario', 'vistas/images/usuarios/default/anonymous.png', 0, '2018-04-30 01:26:30', '2018-06-08 19:35:53'),
(79, 'Manuel Cañas', 'mcanias', '$2a$07$asxx54ahjppf45sd87a5auT7mV/C7rKCnYpUcq/Df25TABidggsMa', 'Mesero', 'vistas/images/usuarios/default/anonymous.png', 0, '2018-04-30 01:30:09', '2018-06-08 19:18:13'),
(81, 'Juan Carbona', 'juan', '$2a$07$asxx54ahjppf45sd87a5au.U/M0caGNRi1j0bgxZqVwBDctNLt11O', 'Mesero', 'vistas/images/usuarios/jmcardona/679.png', 1, '2018-06-10 04:12:55', '2018-06-10 09:12:55'),
(83, 'Carlos Donado', 'carlos', '$2a$07$asxx54ahjppf45sd87a5auelrdZeBYZ4t33w118t1DE5bSBf9deF2', 'Inventario', 'vistas/images/usuarios/cdonado/587.jpg', 1, '2018-06-04 12:48:53', '2018-06-08 19:18:22'),
(85, 'Andres Lopez', 'alopez', '$2a$07$asxx54ahjppf45sd87a5aurhutf14whsJ49HRwO0J7J1ppLjjt.wy', 'Inventario', 'vistas/images/usuarios/default/anonymous.png', 0, '0000-00-00 00:00:00', '2018-06-08 19:18:25'),
(86, 'Administrador', 'admin', '$2a$07$asxx54ahjppf45sd87a5aunxs9bkpyGmGE/.vekdjFg83yRec789S', 'Administrador', 'vistas/images/usuarios/admin/760.png', 1, '2018-06-10 15:55:50', '2018-06-10 20:55:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `productos` text COLLATE utf8_spanish_ci NOT NULL,
  `barcode` int(11) NOT NULL,
  `impuesto` float NOT NULL,
  `neto` float NOT NULL,
  `total` float NOT NULL,
  `metodo_pago` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `codigo`, `id_cliente`, `id_vendedor`, `productos`, `barcode`, `impuesto`, `neto`, `total`, `metodo_pago`, `fecha`) VALUES
(4, 10001, 5, 60, '[{\"id\":\"14\",\"descripcion\":\"Cerveza Heineken\",\"cantidad\":\"9\",\"stock\":\"10\",\"precio\":\"5000\",\"total\":\"45000\"},{\"id\":\"28\",\"descripcion\":\"Old Parr 12 años 1L\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"116116\",\"total\":\"116116\"}]', 0, 0, 161116, 161116, 'Efectivo', '2018-05-30 19:33:27'),
(6, 10002, 6, 60, '[{\"id\":\"28\",\"descripcion\":\"Old Parr 12 años 1L\",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"116116\",\"total\":\"116116\"},{\"id\":\"18\",\"descripcion\":\"Cerveza Budweiser\",\"cantidad\":\"5\",\"stock\":\"14\",\"precio\":\"5000\",\"total\":\"25000\"}]', 0, 0, 141116, 141116, 'Efectivo', '2018-05-31 18:48:32'),
(7, 10003, 1, 60, '[{\"id\":\"16\",\"descripcion\":\"Cerveza Corona Extra\",\"cantidad\":\"5\",\"stock\":\"12\",\"precio\":\"5000\",\"total\":\"25000\"},{\"id\":\"2\",\"descripcion\":\"Cerveza Aguila Light\",\"cantidad\":\"10\",\"stock\":\"10\",\"precio\":\"2500\",\"total\":\"25000\"}]', 0, 9500, 50000, 59500, 'Efectivo', '2018-06-01 21:57:32'),
(8, 10004, 2, 60, '[{\"id\":\"28\",\"descripcion\":\"Old Parr 12 años 1L\",\"cantidad\":\"2\",\"stock\":\"16\",\"precio\":\"116116\",\"total\":\"232232\"}]', 0, 44124.1, 232232, 276356, 'Efectivo', '2018-06-02 00:15:50'),
(9, 10005, 2, 60, '[{\"id\":\"18\",\"descripcion\":\"Cerveza Budweiser\",\"cantidad\":\"6\",\"stock\":\"8\",\"precio\":\"5000\",\"total\":\"30000\"},{\"id\":\"23\",\"descripcion\":\"Buchanans 12 años 750ml\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"109000\",\"total\":\"109000\"}]', 0, 0, 139000, 139000, 'Efectivo', '2018-06-02 00:16:40'),
(10, 10006, 4, 60, '[{\"id\":\"16\",\"descripcion\":\"Cerveza Corona Extra\",\"cantidad\":\"5\",\"stock\":\"7\",\"precio\":\"5000\",\"total\":\"25000\"},{\"id\":\"28\",\"descripcion\":\"Old Parr 12 años 1L\",\"cantidad\":\"1\",\"stock\":\"15\",\"precio\":\"116116\",\"total\":\"116116\"}]', 0, 26812, 141116, 167928, 'TC-987456321', '2018-06-02 00:22:01'),
(11, 10007, 2, 60, '[{\"id\":\"16\",\"descripcion\":\"Cerveza Corona Extra\",\"cantidad\":\"7\",\"stock\":\"0\",\"precio\":\"5000\",\"total\":\"35000\"}]', 0, 6650, 35000, 41650, 'Efectivo', '2018-06-02 00:28:22'),
(12, 10008, 2, 81, '[{\"id\":\"28\",\"descripcion\":\"Old Parr 12 años 1L\",\"cantidad\":\"1\",\"stock\":\"14\",\"precio\":\"116116\",\"total\":\"116116\"},{\"id\":\"2\",\"descripcion\":\"Cerveza Aguila Light\",\"cantidad\":\"4\",\"stock\":\"6\",\"precio\":\"2500\",\"total\":\"10000\"}]', 0, 0, 126116, 126116, 'Efectivo', '2018-06-02 19:32:06'),
(13, 10009, 2, 81, '[{\"id\":\"23\",\"descripcion\":\"Buchanans 12 años 750ml\",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"109000\",\"total\":\"109000\"},{\"id\":\"18\",\"descripcion\":\"Cerveza Budweiser\",\"cantidad\":\"3\",\"stock\":\"5\",\"precio\":\"5000\",\"total\":\"15000\"}]', 0, 0, 124000, 124000, 'Efectivo', '2018-06-02 19:32:52'),
(14, 10010, 1, 81, '[{\"id\":\"23\",\"descripcion\":\"Buchanans 12 años 750ml\",\"cantidad\":\"2\",\"stock\":\"16\",\"precio\":\"109000\",\"total\":\"218000\"}]', 0, 0, 218000, 218000, 'Efectivo', '2018-06-02 19:34:03'),
(15, 10011, 5, 81, '[{\"id\":\"29\",\"descripcion\":\"robbie burns Robertico\",\"cantidad\":\"2\",\"stock\":\"17\",\"precio\":\"49900\",\"total\":\"99800\"}]', 0, 0, 99800, 99800, 'Efectivo', '2018-06-04 17:00:34'),
(16, 10012, 3, 81, '[{\"id\":\"29\",\"descripcion\":\"robbie burns Robertico\",\"cantidad\":\"1\",\"stock\":\"16\",\"precio\":\"49900\",\"total\":\"49900\"}]', 0, 0, 49900, 49900, 'Efectivo', '2018-06-04 17:01:55'),
(17, 10013, 2, 81, '[{\"id\":\"29\",\"descripcion\":\"robbie burns Robertico\",\"cantidad\":\"1\",\"stock\":\"15\",\"precio\":\"49900\",\"total\":\"49900\"},{\"id\":\"1\",\"descripcion\":\"Cerveza Aguila\",\"cantidad\":\"10\",\"stock\":\"10\",\"precio\":\"2500\",\"total\":\"25000\"}]', 0, 0, 74900, 74900, 'Efectivo', '2018-04-26 01:14:23'),
(18, 10014, 3, 81, '[{\"id\":\"28\",\"descripcion\":\"Old Parr 12 años 1L\",\"cantidad\":\"1\",\"stock\":\"13\",\"precio\":\"116116\",\"total\":\"116116\"}]', 0, 0, 116116, 116116, 'Efectivo', '2018-04-26 01:17:55'),
(19, 10015, 2, 60, '[{\"id\":\"29\",\"descripcion\":\"robbie burns Robertico\",\"cantidad\":\"1\",\"stock\":\"14\",\"precio\":\"49900\",\"total\":\"49900\"},{\"id\":\"16\",\"descripcion\":\"Cerveza Corona Extra\",\"cantidad\":\"3\",\"stock\":\"47\",\"precio\":\"5000\",\"total\":\"15000\"}]', 0, 0, 64900, 64900, 'Efectivo', '2018-06-06 14:04:39'),
(21, 10016, 3, 60, '[{\"id\":\"28\",\"descripcion\":\"Old Parr 12 años 1L\",\"cantidad\":\"1\",\"stock\":\"12\",\"precio\":\"116116\",\"total\":\"116116\"},{\"id\":\"16\",\"descripcion\":\"Cerveza Corona Extra\",\"cantidad\":\"5\",\"stock\":\"42\",\"precio\":\"5000\",\"total\":\"25000\"}]', 0, 0, 141116, 141116, 'Efectivo', '2018-06-08 03:57:02'),
(22, 10017, 3, 81, '[{\"id\":\"67\",\"descripcion\":\"Buchanas DELUXE 12 años 1L\",\"cantidad\":\"2\",\"stock\":\"13\",\"precio\":\"112700\",\"total\":\"225400\"}]', 0, 0, 225400, 225400, 'Efectivo', '2018-06-09 02:23:12'),
(23, 10018, 2, 60, '[{\"id\":\"67\",\"descripcion\":\"Buchanas DELUXE 12 años 1L\",\"cantidad\":\"1\",\"stock\":\"12\",\"precio\":\"112700\",\"total\":\"112700\"}]', 0, 0, 112700, 112700, 'Efectivo', '2018-06-10 07:57:07'),
(24, 10019, 2, 60, '[{\"id\":\"67\",\"descripcion\":\"Buchanas DELUXE 12 años 1L\",\"cantidad\":\"1\",\"stock\":\"12\",\"precio\":\"112700\",\"total\":\"112700\"}]', 0, 0, 112700, 112700, 'TC-2155879310', '2018-06-10 07:45:15'),
(25, 10020, 3, 60, '[{\"id\":\"67\",\"descripcion\":\"Buchanas DELUXE 12 años 1L\",\"cantidad\":\"1\",\"stock\":\"11\",\"precio\":\"112700\",\"total\":\"112700\"}]', 0, 0, 112700, 112700, 'TC-7896541025', '2018-06-10 07:56:56'),
(26, 10021, 1, 60, '[{\"id\":\"67\",\"descripcion\":\"Buchanas DELUXE 12 años 1L\",\"cantidad\":\"1\",\"stock\":\"11\",\"precio\":\"112700\",\"total\":\"112700\"}]', 0, 0, 112700, 112700, 'Efectivo', '2018-06-10 20:36:09');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
