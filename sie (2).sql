-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-10-2018 a las 05:42:54
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sie`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `idarea` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `idanulo` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bancos`
--

CREATE TABLE `bancos` (
  `id` bigint(20) NOT NULL,
  `valor_ingreso` bigint(20) DEFAULT '0',
  `valor_egreso` bigint(20) DEFAULT '0',
  `idcomprobante` int(11) DEFAULT NULL,
  `idcaja` int(11) DEFAULT NULL,
  `idanulo` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `bancos`
--

INSERT INTO `bancos` (`id`, `valor_ingreso`, `valor_egreso`, `idcomprobante`, `idcaja`, `idanulo`) VALUES
(1, 70000, 0, NULL, 2, 0),
(2, 0, 20000, 2, NULL, 0),
(3, 0, 100000, NULL, 3, 0),
(4, 30000, 0, 3, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `id` bigint(20) NOT NULL,
  `valor_ingreso` bigint(20) DEFAULT '0',
  `valor_egreso` bigint(20) DEFAULT '0',
  `fecha` date DEFAULT NULL,
  `idcomprobante` int(11) DEFAULT NULL,
  `idcaja` int(11) DEFAULT NULL,
  `idanulo` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id`, `valor_ingreso`, `valor_egreso`, `fecha`, `idcomprobante`, `idcaja`, `idanulo`) VALUES
(1, 30000, 0, NULL, NULL, 1, 0),
(3, 20000, 0, NULL, 2, NULL, 0),
(4, 100000, 0, NULL, NULL, 3, 0),
(5, 500000, 0, NULL, NULL, 4, 0),
(6, 0, 30000, NULL, 3, NULL, 0),
(7, 0, 30000, NULL, 1, NULL, 0),
(8, 0, 90000, NULL, 4, NULL, 0),
(9, 0, 4000, NULL, 5, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_conceptos_generales`
--

CREATE TABLE `caja_conceptos_generales` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `idanulo` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centro_area`
--

CREATE TABLE `centro_area` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `idarea` int(11) NOT NULL,
  `idanulo` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centro_costos`
--

CREATE TABLE `centro_costos` (
  `idcentrocostos` bigint(20) NOT NULL,
  `centrocostos` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `idanulo` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `centro_costos`
--

INSERT INTO `centro_costos` (`idcentrocostos`, `centrocostos`, `idanulo`) VALUES
(1, 'PRINCIPAL', 0),
(2, 'IGLESIA SANTA LUCIA', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `idciudad` int(11) NOT NULL,
  `ciudad` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `idanulo` int(11) DEFAULT '0',
  `iddepartamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`idciudad`, `ciudad`, `idanulo`, `iddepartamento`) VALUES
(1, 'BOGOTA', 0, 1),
(2, 'CALI', 1, 4),
(3, 'IBAGUE', 0, 2),
(4, 'BARRANQUILLA', 0, 3);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `comprobante_banco`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `comprobante_banco` (
`idcomprobante` int(10) unsigned
,`fecha_creacion` datetime
,`fecha` date
,`bloqueo` int(11)
,`valor` double
,`idcentrocostos` bigint(20)
,`adjunto` varchar(400)
,`idanulo` int(11)
,`codigo` varchar(5)
,`anulado` int(11)
,`alta` int(11)
,`idtercero` bigint(20)
,`valor_d` double
,`idconcepto` int(11)
,`subtotal` double
,`total` double
,`valor_egreso` bigint(20)
,`valor_ingreso` bigint(20)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `comprobante_caja`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `comprobante_caja` (
`idcomprobante` int(10) unsigned
,`fecha_creacion` datetime
,`fecha` date
,`bloqueo` int(11)
,`valor` double
,`idcentrocostos` bigint(20)
,`adjunto` varchar(400)
,`idanulo` int(11)
,`codigo` varchar(5)
,`anulado` int(11)
,`alta` int(11)
,`idtercero` bigint(20)
,`valor_d` double
,`idconcepto` int(11)
,`subtotal` double
,`total` double
,`valor_egreso` bigint(20)
,`valor_ingreso` bigint(20)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobante_egreso`
--

CREATE TABLE `comprobante_egreso` (
  `idcomprobante` int(10) UNSIGNED NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha` date NOT NULL,
  `bloqueo` int(11) NOT NULL DEFAULT '0',
  `valor` double NOT NULL,
  `idcentrocostos` bigint(20) NOT NULL,
  `adjunto` varchar(400) COLLATE utf8_spanish_ci NOT NULL,
  `idanulo` int(11) NOT NULL DEFAULT '0',
  `codigo` varchar(5) COLLATE utf8_spanish_ci DEFAULT 'CE',
  `anulado` int(11) DEFAULT '0',
  `alta` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `comprobante_egreso`
--

INSERT INTO `comprobante_egreso` (`idcomprobante`, `fecha_creacion`, `fecha`, `bloqueo`, `valor`, `idcentrocostos`, `adjunto`, `idanulo`, `codigo`, `anulado`, `alta`) VALUES
(111111, '2018-10-08 20:54:38', '2018-08-07', 0, 30000, 2, 'archivos/09035414.png', 0, 'CE', 0, 1),
(122345, '2018-10-14 15:05:02', '2018-10-30', 0, 90000, 2, 'archivos/14220596.pdf', 0, 'CE', 0, 1),
(234567, '2018-10-07 10:32:19', '2018-10-18', 0, 50000, 2, 'archivos/07173250.jpg', 0, 'CE', 0, 1),
(334567, '2018-10-14 15:06:56', '2018-10-30', 0, 4000, 2, 'archivos/14220682.pdf', 0, 'CE', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `concepto`
--

CREATE TABLE `concepto` (
  `idconcepto` int(11) NOT NULL,
  `concepto` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `piso` double NOT NULL DEFAULT '0',
  `porcentaje` double NOT NULL DEFAULT '0',
  `idanulo` int(11) DEFAULT '0',
  `doble` int(11) DEFAULT '0',
  `adjobligatorio` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `concepto`
--

INSERT INTO `concepto` (`idconcepto`, `concepto`, `piso`, `porcentaje`, `idanulo`, `doble`, `adjobligatorio`) VALUES
(1, 'COMPRA DE MUEBLES', 0, 0, 0, 0, 0),
(2, 'servicio de aseo templo', 11000, 6, 0, 0, 1),
(3, 'Retiro Bancario', 0, 0, 0, 1, 0),
(4, 'DIEZMO A LA MISION', 0, 0, 0, 0, 0),
(5, '4 % ENVIADO A LA MISION', 0, 0, 0, 0, 1),
(6, 'OFRENDAS (BONOS- OTROS)', 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `idanulo` int(11) DEFAULT '0',
  `idpais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id`, `nombre`, `idanulo`, `idpais`) VALUES
(1, 'CUNDINAMARCA', 0, 1),
(2, 'TOLIMA', 0, 1),
(3, 'ATLÁNTICO', 0, 1),
(4, 'VALLE DEL CAUCA', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_comprobante_egreso`
--

CREATE TABLE `detalles_comprobante_egreso` (
  `iddetalle` bigint(20) NOT NULL,
  `idtercero` bigint(20) NOT NULL,
  `valor` double NOT NULL,
  `idcomprobanteegreso` int(10) UNSIGNED NOT NULL,
  `idconcepto` int(11) NOT NULL,
  `fechacreacion` datetime NOT NULL,
  `adjunto` varchar(400) COLLATE utf8_spanish_ci NOT NULL,
  `subtotal` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalles_comprobante_egreso`
--

INSERT INTO `detalles_comprobante_egreso` (`iddetalle`, `idtercero`, `valor`, `idcomprobanteegreso`, `idconcepto`, `fechacreacion`, `adjunto`, `subtotal`, `total`) VALUES
(1, 2, 30000, 234567, 2, '2018-10-07 10:33:10', 'archivos/07173374.jpg', 1800, 28200),
(2, 3, 20000, 234567, 3, '2018-10-07 10:33:48', 'archivos/07173396.png', 0, 20000),
(3, 3, 30000, 111111, 3, '2018-10-08 20:55:13', 'archivos/09035559.pdf', 0, 30000),
(4, 101, 90000, 122345, 4, '2018-10-14 15:06:24', 'archivos/14220694.pdf', 0, 90000),
(5, 101, 4000, 334567, 5, '2018-10-14 15:07:19', 'archivos/sinarchivo.png', 0, 4000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_recibo_caja`
--

CREATE TABLE `detalle_recibo_caja` (
  `iddetalle_recibo` bigint(20) NOT NULL,
  `idtercero` bigint(20) NOT NULL,
  `valor` double NOT NULL,
  `idtipoingreso` int(11) NOT NULL,
  `idrecibocaja` bigint(20) NOT NULL,
  `fechacreacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_recibo_caja`
--

INSERT INTO `detalle_recibo_caja` (`iddetalle_recibo`, `idtercero`, `valor`, `idtipoingreso`, `idrecibocaja`, `fechacreacion`) VALUES
(1, 3, 30000, 1, 1234, '2018-10-07 10:30:59'),
(2, 2, 70000, 2, 1234, '2018-10-07 10:31:29'),
(3, 3, 100000, 3, 1233, '2018-10-07 20:33:28'),
(4, 3, 500000, 1, 3403, '2018-10-08 20:53:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diezmo_pastores`
--

CREATE TABLE `diezmo_pastores` (
  `id` bigint(20) NOT NULL,
  `valor` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idpastor` bigint(11) NOT NULL,
  `idnulo` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `diezmo_pastores`
--

INSERT INTO `diezmo_pastores` (`id`, `valor`, `fecha`, `idpastor`, `idnulo`) VALUES
(1, 100000, '2018-10-23', 10245009, 0),
(3, 30000, '2018-10-01', 1024500910, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `codigo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `idanulo` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id`, `nombre`, `codigo`, `idanulo`) VALUES
(1, 'COLOMBIA', 'COP', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pastores`
--

CREATE TABLE `pastores` (
  `cedula` bigint(20) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `correo` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idanulo` int(11) DEFAULT '0',
  `tipoid` int(11) NOT NULL,
  `centro_costo` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pastores`
--

INSERT INTO `pastores` (`cedula`, `nombre`, `direccion`, `telefono`, `correo`, `idanulo`, `tipoid`, `centro_costo`) VALUES
(10245009, 'PASTOR LOPEZ', 'craera', '', 'ley1234@hotmail.com', 0, 1, 2),
(1024500910, 'LEYDI VARGAS', 'tv 5v# 45n- 56 sur', '2345678', 'ley@hotmail.com', 0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibo_caja`
--

CREATE TABLE `recibo_caja` (
  `idrecibo` bigint(20) NOT NULL,
  `fecha` date NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `concepto` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `valor` double NOT NULL,
  `bloqueo` int(11) NOT NULL DEFAULT '0',
  `idcentrocostos` bigint(11) NOT NULL,
  `adjunto` varchar(400) COLLATE utf8_spanish_ci NOT NULL,
  `idanulo` int(11) NOT NULL DEFAULT '0',
  `codigo` varchar(5) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'rc',
  `alta` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `recibo_caja`
--

INSERT INTO `recibo_caja` (`idrecibo`, `fecha`, `fecha_creacion`, `concepto`, `valor`, `bloqueo`, `idcentrocostos`, `adjunto`, `idanulo`, `codigo`, `alta`) VALUES
(1233, '2018-10-24', '2018-10-07 20:32:57', 'DEVOLUCIONES', 100000, 0, 2, 'archivos/08033298.pdf', 0, 'rc', 1),
(1234, '2018-10-01', '2018-10-07 10:30:30', 'DIEZMOS Y OFRENDAS DE SEMPTIEMBRE', 100000, 0, 2, 'archivos/07173022.jpg', 0, 'rc', 1),
(3403, '2018-09-03', '2018-09-03 20:49:05', 'DEVOLUCIONES', 500000, 0, 2, 'archivos/09034970.png', 0, 'rc', 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `recibo_caja_banco`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `recibo_caja_banco` (
`idrecibo` bigint(20)
,`fecha` date
,`fecha_creacion` datetime
,`concepto` varchar(50)
,`valor` double
,`bloqueo` int(11)
,`idcentrocostos` bigint(11)
,`adjunto` varchar(400)
,`idanulo` int(11)
,`codigo` varchar(5)
,`alta` int(11)
,`idtercero` bigint(20)
,`valor_d` double
,`idtipoingreso` int(11)
,`valor_egreso` bigint(20)
,`valor_ingreso` bigint(20)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `recibo_caja_caja`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `recibo_caja_caja` (
`idrecibo` bigint(20)
,`fecha` date
,`fecha_creacion` datetime
,`concepto` varchar(50)
,`valor` double
,`bloqueo` int(11)
,`idcentrocostos` bigint(11)
,`adjunto` varchar(400)
,`idanulo` int(11)
,`codigo` varchar(5)
,`alta` int(11)
,`idtercero` bigint(20)
,`valor_d` double
,`idtipoingreso` int(11)
,`valor_egreso` bigint(20)
,`valor_ingreso` bigint(20)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `terceros`
--

CREATE TABLE `terceros` (
  `idtercero` bigint(20) NOT NULL,
  `identificacion` double NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellido` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `idciudad` int(11) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `razon_social` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuariocreacion` int(20) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_actualizacion` datetime NOT NULL,
  `anotaciones` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `digitoverificacion` int(11) DEFAULT NULL,
  `idanulo` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `terceros`
--

INSERT INTO `terceros` (`idtercero`, `identificacion`, `nombre`, `apellido`, `telefono`, `direccion`, `idciudad`, `tipo_id`, `razon_social`, `usuariocreacion`, `fecha_creacion`, `fecha_actualizacion`, `anotaciones`, `digitoverificacion`, `idanulo`) VALUES
(2, 80006789, '', '', '3030952', 'FGHJ', 1, 3, 'PANDERIA LA CAROLINA', 7, '2018-08-07 14:12:33', '2018-08-07 20:56:34', '', 3, 0),
(3, 1023893931, 'JORGE LEONARDO', 'CORREA MUÑOZ', '3114473719', 'CARRERA 3A # 48X 44 SUR ', 1, 1, '', 7, '2018-08-07 20:23:24', '2018-08-07 20:23:24', '', NULL, 0),
(4, 1021600910, 'LEYDEI', 'VARGAS', '311202', 'CARRERA 3A # 48X 44 SUR ', 1, 1, '', 7, '2018-09-16 17:04:55', '2018-09-16 17:11:09', '', NULL, 1),
(97, 345, 'THE MOTHER', 'FUCKER', '4', 'CARRERA 3A # 48X 44 SUR ', 1, 1, '', 7, '2018-09-22 14:58:03', '2018-09-22 14:58:03', '', NULL, 0),
(98, 102377654, 'JOTGRE', 'VGASRD', '7712051', 'CAREA', 1, 1, '', 7, '2018-09-22 14:58:49', '2018-09-22 20:35:08', '', NULL, 1),
(99, 102430090, '', '', '998664 ext 114', 'CRA F 65-99 SUR', 3, 3, 'LAVASECO', 7, '2018-09-22 19:46:30', '2018-09-22 19:46:30', '', 6, 0),
(100, 800788872, '', '', '3114473719', 'CALLE 45B # 45-44NORTE', 4, 3, 'RESTAURANTE', 9, '2018-09-30 13:58:19', '2018-09-30 13:58:19', 'prueba de creacion de tercero', 5, 0),
(101, 8000678900, '', '', '7712051', 'FGHJ', 1, 3, 'MISION', 7, '2018-10-14 15:05:59', '2018-10-14 15:05:59', '', 6, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_id`
--

CREATE TABLE `tipo_id` (
  `id` int(11) NOT NULL,
  `tipoidentificacion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `codigo` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `idanulo` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_id`
--

INSERT INTO `tipo_id` (`id`, `tipoidentificacion`, `codigo`, `idanulo`) VALUES
(1, 'CEDULA DE CIUDADNIA', 'CC', 0),
(2, 'TARJETA DE IDENTIDAD', 'TI', 0),
(3, 'NúMERO DE IDENTIFICACIóN TRIBUTARIA', 'NIT', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_ingreso`
--

CREATE TABLE `tipo_ingreso` (
  `idtipo_ingreso` int(11) NOT NULL,
  `ingreso` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `idanulo` int(11) NOT NULL DEFAULT '0',
  `doble` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_ingreso`
--

INSERT INTO `tipo_ingreso` (`idtipo_ingreso`, `ingreso`, `idanulo`, `doble`) VALUES
(1, 'DIEZMOS', 0, 0),
(2, 'OFRENDAS', 0, 0),
(3, 'COLECTAS DE OCTUBRE', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `nombrecompleto` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `centrocosto` bigint(20) NOT NULL,
  `idanulo` int(11) DEFAULT '0',
  `role` int(11) DEFAULT '0',
  `authKey` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `verification_code` varchar(250) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `email`, `nombrecompleto`, `centrocosto`, `idanulo`, `role`, `authKey`, `verification_code`) VALUES
(7, 'administrador', '$2y$13$JGhjRSt8Z1o3G0BpHH67zO49HMZLhRo4hx.SJxT2R/SDme2XBZ8lO', 'leo77@hotmail.com', 'JORGE LEONARDO CORREA MUñOZ', 1, 0, 1, '', ''),
(9, 'invitado', '$2y$13$/Kjwfo1ROyTkihMCQwSWJOX6aLpxIhKgNfc.4S.BEAJgt.SgvPbiK', 'jorge7712051@hotmail.com', 'IGLESIA DE SANTA LUCIA', 2, 0, 0, 'f3eb2dbddc07bb5d2f06d5c6dfc93d9faef1101e2aa0b490e4e40c07a4d7b3186631c875df3ffc08ea5f02d26240c8c1da6cbce772d8c3379662c2dd74427bb52a3234f69cc0246fe808faff5783a75f700feecacf2ef378ba7366fc0b31ab825b69373a', ''),
(10, 'invitado2', '$2y$13$M0xExBpBRugomEbQImq/nO74y.XKFuyP2uI1t/nK9WeZKlhk8tFVG', 'prueba@hotmail.co', 'USUARIO DE PRUEBA', 2, 0, 0, '7a37d712078765a444205291d1bd7b796d466355f7ba74cf0f7ab5466b48c7933720c230aa63f12471d80ac8c6f286cd8e6a7d3621a350570ff41312132a6f1ba751f1f69018f0f66f339f5ada6552f89017bdb8a8ba7e6d671c9ea9290ba89a93ab46e3', ''),
(11, 'jorge77120512', '$2y$13$tcoFp7XEJwymexpCJejQL.pSB6PK7B1lskr7.H8rG6geH13F3CqWa', 'jorg7712051@hotmail.com', 'IGELSUIA SANTA', 1, 0, 1, '537f00e540623d73f66717ef642e404ca52440dd0615f29fa991a51767115518cb318a4fe046bbb08c70c985878d98b07fc9f3e2a9489c19e296abcf311a7b41575bb4f8e73ef69aa3d0f574b6f4e074bbbd007a3d14a93d73f4244a2552f61da50ac767', '');

-- --------------------------------------------------------

--
-- Estructura para la vista `comprobante_banco`
--
DROP TABLE IF EXISTS `comprobante_banco`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `comprobante_banco`  AS  select `ce`.`idcomprobante` AS `idcomprobante`,`ce`.`fecha_creacion` AS `fecha_creacion`,`ce`.`fecha` AS `fecha`,`ce`.`bloqueo` AS `bloqueo`,`ce`.`valor` AS `valor`,`ce`.`idcentrocostos` AS `idcentrocostos`,`ce`.`adjunto` AS `adjunto`,`ce`.`idanulo` AS `idanulo`,`ce`.`codigo` AS `codigo`,`ce`.`anulado` AS `anulado`,`ce`.`alta` AS `alta`,`dc`.`idtercero` AS `idtercero`,`dc`.`valor` AS `valor_d`,`dc`.`idconcepto` AS `idconcepto`,`dc`.`subtotal` AS `subtotal`,`dc`.`total` AS `total`,`b`.`valor_egreso` AS `valor_egreso`,`b`.`valor_ingreso` AS `valor_ingreso` from ((`comprobante_egreso` `ce` join `detalles_comprobante_egreso` `dc` on((`ce`.`idcomprobante` = `dc`.`idcomprobanteegreso`))) join `bancos` `b` on((`dc`.`iddetalle` = `b`.`idcomprobante`))) where (`ce`.`alta` = 1) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `comprobante_caja`
--
DROP TABLE IF EXISTS `comprobante_caja`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `comprobante_caja`  AS  select `ce`.`idcomprobante` AS `idcomprobante`,`ce`.`fecha_creacion` AS `fecha_creacion`,`ce`.`fecha` AS `fecha`,`ce`.`bloqueo` AS `bloqueo`,`ce`.`valor` AS `valor`,`ce`.`idcentrocostos` AS `idcentrocostos`,`ce`.`adjunto` AS `adjunto`,`ce`.`idanulo` AS `idanulo`,`ce`.`codigo` AS `codigo`,`ce`.`anulado` AS `anulado`,`ce`.`alta` AS `alta`,`dc`.`idtercero` AS `idtercero`,`dc`.`valor` AS `valor_d`,`dc`.`idconcepto` AS `idconcepto`,`dc`.`subtotal` AS `subtotal`,`dc`.`total` AS `total`,`c`.`valor_egreso` AS `valor_egreso`,`c`.`valor_ingreso` AS `valor_ingreso` from ((`comprobante_egreso` `ce` join `detalles_comprobante_egreso` `dc` on((`ce`.`idcomprobante` = `dc`.`idcomprobanteegreso`))) join `caja` `c` on((`dc`.`iddetalle` = `c`.`idcomprobante`))) where (`ce`.`alta` = 1) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `recibo_caja_banco`
--
DROP TABLE IF EXISTS `recibo_caja_banco`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `recibo_caja_banco`  AS  select `rc`.`idrecibo` AS `idrecibo`,`rc`.`fecha` AS `fecha`,`rc`.`fecha_creacion` AS `fecha_creacion`,`rc`.`concepto` AS `concepto`,`rc`.`valor` AS `valor`,`rc`.`bloqueo` AS `bloqueo`,`rc`.`idcentrocostos` AS `idcentrocostos`,`rc`.`adjunto` AS `adjunto`,`rc`.`idanulo` AS `idanulo`,`rc`.`codigo` AS `codigo`,`rc`.`alta` AS `alta`,`dr`.`idtercero` AS `idtercero`,`dr`.`valor` AS `valor_d`,`dr`.`idtipoingreso` AS `idtipoingreso`,`b`.`valor_egreso` AS `valor_egreso`,`b`.`valor_ingreso` AS `valor_ingreso` from ((`recibo_caja` `rc` join `detalle_recibo_caja` `dr` on((`rc`.`idrecibo` = `dr`.`idrecibocaja`))) join `bancos` `b` on((`dr`.`iddetalle_recibo` = `b`.`idcaja`))) where (`rc`.`alta` = 1) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `recibo_caja_caja`
--
DROP TABLE IF EXISTS `recibo_caja_caja`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `recibo_caja_caja`  AS  select `rc`.`idrecibo` AS `idrecibo`,`rc`.`fecha` AS `fecha`,`rc`.`fecha_creacion` AS `fecha_creacion`,`rc`.`concepto` AS `concepto`,`rc`.`valor` AS `valor`,`rc`.`bloqueo` AS `bloqueo`,`rc`.`idcentrocostos` AS `idcentrocostos`,`rc`.`adjunto` AS `adjunto`,`rc`.`idanulo` AS `idanulo`,`rc`.`codigo` AS `codigo`,`rc`.`alta` AS `alta`,`dr`.`idtercero` AS `idtercero`,`dr`.`valor` AS `valor_d`,`dr`.`idtipoingreso` AS `idtipoingreso`,`c`.`valor_egreso` AS `valor_egreso`,`c`.`valor_ingreso` AS `valor_ingreso` from ((`recibo_caja` `rc` join `detalle_recibo_caja` `dr` on((`rc`.`idrecibo` = `dr`.`idrecibocaja`))) join `caja` `c` on((`dr`.`iddetalle_recibo` = `c`.`idcaja`))) where (`rc`.`alta` = 1) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`idarea`);

--
-- Indices de la tabla `bancos`
--
ALTER TABLE `bancos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_idcomprobante` (`idcomprobante`) USING BTREE,
  ADD KEY `index_idcaja` (`idcaja`) USING BTREE;

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_idcomprobante` (`idcomprobante`) USING BTREE,
  ADD KEY `index_idcaja` (`idcaja`) USING BTREE;

--
-- Indices de la tabla `caja_conceptos_generales`
--
ALTER TABLE `caja_conceptos_generales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nombre` (`nombre`);

--
-- Indices de la tabla `centro_area`
--
ALTER TABLE `centro_area`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_area_centro_costos` (`idarea`);

--
-- Indices de la tabla `centro_costos`
--
ALTER TABLE `centro_costos`
  ADD PRIMARY KEY (`idcentrocostos`);

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`idciudad`),
  ADD KEY `FK_deptarmento_ciudad` (`iddepartamento`);

--
-- Indices de la tabla `comprobante_egreso`
--
ALTER TABLE `comprobante_egreso`
  ADD PRIMARY KEY (`idcomprobante`),
  ADD KEY `Fk_comprobante_egreso_centro_costos` (`idcentrocostos`),
  ADD KEY `fecha_creacion` (`fecha_creacion`);

--
-- Indices de la tabla `concepto`
--
ALTER TABLE `concepto`
  ADD PRIMARY KEY (`idconcepto`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pais_dep` (`idpais`);

--
-- Indices de la tabla `detalles_comprobante_egreso`
--
ALTER TABLE `detalles_comprobante_egreso`
  ADD PRIMARY KEY (`iddetalle`),
  ADD KEY `index_idtercero` (`idtercero`),
  ADD KEY `index_idconcepto` (`idconcepto`),
  ADD KEY `index_idcomprobanteegreso` (`idcomprobanteegreso`) USING BTREE;

--
-- Indices de la tabla `detalle_recibo_caja`
--
ALTER TABLE `detalle_recibo_caja`
  ADD PRIMARY KEY (`iddetalle_recibo`),
  ADD KEY `index_idtercero` (`idtercero`),
  ADD KEY `index_tipo_ingreso` (`idtipoingreso`),
  ADD KEY `fk_recibocajadetalle_rc` (`idrecibocaja`);

--
-- Indices de la tabla `diezmo_pastores`
--
ALTER TABLE `diezmo_pastores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_diezmo_pastor` (`idpastor`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pastores`
--
ALTER TABLE `pastores`
  ADD PRIMARY KEY (`cedula`),
  ADD KEY `fk_tipoid` (`tipoid`),
  ADD KEY `fk_pastor_centro_costos` (`centro_costo`);

--
-- Indices de la tabla `recibo_caja`
--
ALTER TABLE `recibo_caja`
  ADD PRIMARY KEY (`idrecibo`),
  ADD KEY `indexcentrocostos` (`idcentrocostos`);

--
-- Indices de la tabla `terceros`
--
ALTER TABLE `terceros`
  ADD PRIMARY KEY (`idtercero`),
  ADD UNIQUE KEY `identificacion` (`identificacion`),
  ADD KEY `fk_terceros_ciudad` (`idciudad`),
  ADD KEY `fk_usuarios_creacion` (`usuariocreacion`),
  ADD KEY `fk_terceros_tipodi` (`tipo_id`);

--
-- Indices de la tabla `tipo_id`
--
ALTER TABLE `tipo_id`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_ingreso`
--
ALTER TABLE `tipo_ingreso`
  ADD PRIMARY KEY (`idtipo_ingreso`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `indice_usuarios` (`id`),
  ADD KEY `index_centrocostos` (`centrocosto`),
  ADD KEY `username_2` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bancos`
--
ALTER TABLE `bancos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `caja_conceptos_generales`
--
ALTER TABLE `caja_conceptos_generales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `centro_area`
--
ALTER TABLE `centro_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `centro_costos`
--
ALTER TABLE `centro_costos`
  MODIFY `idcentrocostos` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `idciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `concepto`
--
ALTER TABLE `concepto`
  MODIFY `idconcepto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `detalles_comprobante_egreso`
--
ALTER TABLE `detalles_comprobante_egreso`
  MODIFY `iddetalle` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detalle_recibo_caja`
--
ALTER TABLE `detalle_recibo_caja`
  MODIFY `iddetalle_recibo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `diezmo_pastores`
--
ALTER TABLE `diezmo_pastores`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `terceros`
--
ALTER TABLE `terceros`
  MODIFY `idtercero` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT de la tabla `tipo_id`
--
ALTER TABLE `tipo_id`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_ingreso`
--
ALTER TABLE `tipo_ingreso`
  MODIFY `idtipo_ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `centro_area`
--
ALTER TABLE `centro_area`
  ADD CONSTRAINT `fk_area_centro_costos` FOREIGN KEY (`idarea`) REFERENCES `area` (`idarea`);

--
-- Filtros para la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD CONSTRAINT `FK_deptarmento_ciudad` FOREIGN KEY (`iddepartamento`) REFERENCES `departamento` (`id`);

--
-- Filtros para la tabla `comprobante_egreso`
--
ALTER TABLE `comprobante_egreso`
  ADD CONSTRAINT `Fk_comprobante_egreso_centro_costos` FOREIGN KEY (`idcentrocostos`) REFERENCES `centro_costos` (`idcentrocostos`);

--
-- Filtros para la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD CONSTRAINT `fk_pais_dep` FOREIGN KEY (`idpais`) REFERENCES `pais` (`id`);

--
-- Filtros para la tabla `detalles_comprobante_egreso`
--
ALTER TABLE `detalles_comprobante_egreso`
  ADD CONSTRAINT `fk_detallecoprobante_tercero` FOREIGN KEY (`idtercero`) REFERENCES `terceros` (`idtercero`),
  ADD CONSTRAINT `fk_detalleegreso_comprobanteegreso` FOREIGN KEY (`idcomprobanteegreso`) REFERENCES `comprobante_egreso` (`idcomprobante`),
  ADD CONSTRAINT `fk_detalleegreso_concepto` FOREIGN KEY (`idconcepto`) REFERENCES `concepto` (`idconcepto`);

--
-- Filtros para la tabla `detalle_recibo_caja`
--
ALTER TABLE `detalle_recibo_caja`
  ADD CONSTRAINT `fk_recibocajadetalle_rc` FOREIGN KEY (`idrecibocaja`) REFERENCES `recibo_caja` (`idrecibo`),
  ADD CONSTRAINT `fk_recibocajadetalle_tercero` FOREIGN KEY (`idtercero`) REFERENCES `terceros` (`idtercero`),
  ADD CONSTRAINT `fk_recibocajadetalle_tipoingreso` FOREIGN KEY (`idtipoingreso`) REFERENCES `tipo_ingreso` (`idtipo_ingreso`);

--
-- Filtros para la tabla `diezmo_pastores`
--
ALTER TABLE `diezmo_pastores`
  ADD CONSTRAINT `fk_diezmo_pastor` FOREIGN KEY (`idpastor`) REFERENCES `pastores` (`cedula`);

--
-- Filtros para la tabla `pastores`
--
ALTER TABLE `pastores`
  ADD CONSTRAINT `fk_pastor_centro_costos` FOREIGN KEY (`centro_costo`) REFERENCES `centro_costos` (`idcentrocostos`),
  ADD CONSTRAINT `fk_tipoid` FOREIGN KEY (`tipoid`) REFERENCES `tipo_id` (`id`);

--
-- Filtros para la tabla `recibo_caja`
--
ALTER TABLE `recibo_caja`
  ADD CONSTRAINT `fk_recibocaja_cc` FOREIGN KEY (`idcentrocostos`) REFERENCES `centro_costos` (`idcentrocostos`);

--
-- Filtros para la tabla `terceros`
--
ALTER TABLE `terceros`
  ADD CONSTRAINT `fk_terceros_ciudad` FOREIGN KEY (`idciudad`) REFERENCES `ciudades` (`idciudad`),
  ADD CONSTRAINT `fk_terceros_tipodi` FOREIGN KEY (`tipo_id`) REFERENCES `tipo_id` (`id`),
  ADD CONSTRAINT `fk_usuarios_creacion` FOREIGN KEY (`usuariocreacion`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_centrocostos` FOREIGN KEY (`centrocosto`) REFERENCES `centro_costos` (`idcentrocostos`);

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `cerrar_comprobantes` ON SCHEDULE EVERY 30 DAY STARTS '2018-10-02 21:00:00' ON COMPLETION NOT PRESERVE ENABLE DO update comprobante_egreso
set bloqueo = 1$$

CREATE DEFINER=`root`@`localhost` EVENT `cerrar_recibocaja` ON SCHEDULE EVERY 30 DAY STARTS '2018-01-30 23:00:01' ON COMPLETION NOT PRESERVE ENABLE DO update recibo_caja
set bloqueo = 1$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
