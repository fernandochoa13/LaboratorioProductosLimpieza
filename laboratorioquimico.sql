-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-04-2023 a las 23:20:01
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `laboratorioquimico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumo`
--

CREATE TABLE `insumo` (
  `idInsumo` int(11) NOT NULL,
  `nombreInsumo` varchar(45) NOT NULL,
  `precio` int(11) NOT NULL,
  `ventas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `insumo`
--

INSERT INTO `insumo` (`idInsumo`, `nombreInsumo`, `precio`, `ventas`) VALUES
(2, 'Agua 30ml', 10, 0),
(4, 'Alcohol etílico 20ml', 400, 7),
(5, 'Dioxido de Silicio 30gr', 10, 3),
(7, 'Dearomatized Alkanes', 300, 48),
(8, 'Polipropileno', 3000, 0),
(9, 'Surfactante aniónico lineal', 3000, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumo_has_orden`
--

CREATE TABLE `insumo_has_orden` (
  `orden_idorden` int(11) NOT NULL,
  `insumo_idinsumo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `insumo_has_orden`
--

INSERT INTO `insumo_has_orden` (`orden_idorden`, `insumo_idinsumo`, `cantidad`) VALUES
(20, 4, 3),
(20, 4, 3),
(20, 7, 10),
(22, 4, 2),
(22, 7, 3),
(22, 9, 10),
(22, 7, 30),
(30, 5, 3),
(30, 7, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_has_orden`
--

CREATE TABLE `inventario_has_orden` (
  `producto_idproducto` int(11) NOT NULL,
  `orden_idorden` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `inventario_has_orden`
--

INSERT INTO `inventario_has_orden` (`producto_idproducto`, `orden_idorden`, `cantidad`) VALUES
(12, 26, 0),
(13, 27, 2),
(12, 29, 20),
(15, 29, 23),
(16, 29, 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden`
--

CREATE TABLE `orden` (
  `idorden` int(11) NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `nombreOrden` varchar(45) NOT NULL,
  `presupuesto` double NOT NULL,
  `fechaCreacion` date NOT NULL DEFAULT current_timestamp(),
  `tipoOrden` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `orden`
--

INSERT INTO `orden` (`idorden`, `estatus`, `nombreOrden`, `presupuesto`, `fechaCreacion`, `tipoOrden`) VALUES
(20, 1, 'FFPLU', 3000, '2023-04-05', 0),
(22, 0, 'OrvillePeck', 40700, '2023-04-06', 0),
(26, 1, 'Reykon', 600, '2023-04-06', 1),
(27, 1, 'e2', 0, '2023-04-06', 1),
(29, 0, '3DEOJ3', 12600, '2023-04-06', 1),
(30, 0, 'Eds', 630, '2023-04-06', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL,
  `nombreProducto` varchar(45) NOT NULL,
  `precio` double DEFAULT NULL,
  `ventas` int(11) DEFAULT NULL,
  `estatusProduccion` tinyint(1) NOT NULL,
  `stock` int(11) NOT NULL,
  `Insumos` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `nombreProducto`, `precio`, `ventas`, `estatusProduccion`, `stock`, `Insumos`) VALUES
(11, 'Bactericida', 400, 344, 1, 30, '20 ml de alcohol etilico'),
(12, 'Antisarro', 300, 31, 1, 10, 'Agua, Dioxido de Silicio, Glicerina, Polietilenglicol, Lauril Sulfato de Sodio, Sabor, Goma de celulosa, Sacarina Sódica, Dióxido de Titanio'),
(13, 'Alcohol Multiuso', 400, 16, 0, 300, 'Alcohol Isopropilico, Tensioactivos, Emulsificantes, Preservantes y Agua'),
(14, 'Brilla muebles', 600, 5, 1, 300, 'Agua, LPG, Dearomatized Alkanes'),
(15, 'Toallas húmedas', 200, 24, 0, 10, 'Polipropileno, Celulosa regenerada, Agua purificada, Ácido Citrico'),
(16, 'Detergente en Polvo', 20, 110, 1, 300, 'Surfactante aniónico lineal, tripolifosfato, silicato, carbonato, sulfato, agente antirredepositante y perfume');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `correo` varchar(60) NOT NULL,
  `clave` varchar(60) NOT NULL,
  `rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `correo`, `clave`, `rol`) VALUES
(2, 'Susy Crabgras', 'SusyCrabgras@gmail.com', 'a830684d994ec653d591351d7ab4e875', 2),
(3, 'Gwen Stefani', 'Gwenstefani@gmail.com', '310dcbbf4cce62f762a2aaa148d556bd', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `insumo`
--
ALTER TABLE `insumo`
  ADD PRIMARY KEY (`idInsumo`);

--
-- Indices de la tabla `insumo_has_orden`
--
ALTER TABLE `insumo_has_orden`
  ADD KEY `pk_idorden` (`orden_idorden`),
  ADD KEY `pk_idinsumo` (`insumo_idinsumo`);

--
-- Indices de la tabla `inventario_has_orden`
--
ALTER TABLE `inventario_has_orden`
  ADD KEY `pk_orden` (`orden_idorden`),
  ADD KEY `pk_inventario` (`producto_idproducto`);

--
-- Indices de la tabla `orden`
--
ALTER TABLE `orden`
  ADD PRIMARY KEY (`idorden`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `insumo`
--
ALTER TABLE `insumo`
  MODIFY `idInsumo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `orden`
--
ALTER TABLE `orden`
  MODIFY `idorden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `insumo_has_orden`
--
ALTER TABLE `insumo_has_orden`
  ADD CONSTRAINT `pk_idinsumo` FOREIGN KEY (`insumo_idinsumo`) REFERENCES `insumo` (`idInsumo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pk_idorden` FOREIGN KEY (`orden_idorden`) REFERENCES `orden` (`idorden`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inventario_has_orden`
--
ALTER TABLE `inventario_has_orden`
  ADD CONSTRAINT `pk_inventario` FOREIGN KEY (`producto_idproducto`) REFERENCES `producto` (`idProducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pk_orden` FOREIGN KEY (`orden_idorden`) REFERENCES `orden` (`idorden`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
