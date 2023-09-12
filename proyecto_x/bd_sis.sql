-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-09-2023 a las 00:42:48
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
-- Base de datos: `bd_sis`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `ID_Cliente` int(11) NOT NULL,
  `Correo` varchar(30) NOT NULL,
  `Pass` varchar(30) NOT NULL,
  `Direccion` varchar(50) NOT NULL,
  `Cel` int(15) NOT NULL,
  `Autorizado` int(1) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comida`
--

CREATE TABLE `comida` (
  `ID_Comida` int(11) NOT NULL,
  `Imagen` varchar(200) NOT NULL,
  `Tipo` int(1) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `Costo_U` decimal(6,0) NOT NULL,
  `Tiempo` time NOT NULL,
  `Nombre` varchar(15) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contiene`
--

CREATE TABLE `contiene` (
  `ID_Menu` int(11) NOT NULL,
  `ID_Orden` int(11) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dispara`
--

CREATE TABLE `dispara` (
  `ID_Orden` int(11) NOT NULL,
  `ID_Pedido` int(11) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `Login` varchar(11) NOT NULL,
  `Pass` varchar(30) NOT NULL,
  `Rol` int(1) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `RUT` int(12) NOT NULL,
  `Nombre` varchar(25) NOT NULL,
  `CI_Enca` int(8) NOT NULL,
  `ID_Cliente` int(11) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `en`
--

CREATE TABLE `en` (
  `ID_Sucu` int(11) NOT NULL,
  `ID_Pedido` int(11) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envasa`
--

CREATE TABLE `envasa` (
  `ID_Vianda` int(11) NOT NULL,
  `ID_Orden` int(11) NOT NULL,
  `ID_Menu` int(11) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_m`
--

CREATE TABLE `estado_m` (
  `ID_Estado` int(1) NOT NULL,
  `N_Estado` varchar(10) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_p`
--

CREATE TABLE `estado_p` (
  `ID_Estado` int(1) NOT NULL,
  `N_Estado` varchar(10) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hace`
--

CREATE TABLE `hace` (
  `Fecha` int(11) NOT NULL,
  `ID_Pedido` int(11) NOT NULL,
  `ID_Cliente` int(11) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imprime`
--

CREATE TABLE `imprime` (
  `ID_Vianda` int(11) NOT NULL,
  `ID_Compra` int(11) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `integran`
--

CREATE TABLE `integran` (
  `ID_Menu` int(11) NOT NULL,
  `ID_Comida` int(11) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `ID_Menu` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `Stock` int(3) NOT NULL,
  `Stock_Max` int(3) NOT NULL,
  `Stock_Min` int(3) NOT NULL,
  `Costo` decimal(6,0) NOT NULL,
  `Tiempo_Pro` time NOT NULL,
  `Imagen` varchar(255) NOT NULL
)  ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `normal`
--

CREATE TABLE `normal` (
  `CI` int(8) NOT NULL,
  `Nombre` int(25) NOT NULL,
  `ID_Cliente` int(11) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden`
--

CREATE TABLE `orden` (
  `ID_Orden` int(11) NOT NULL,
  `Compra` varchar(100) NOT NULL,
  `Estado` varchar(10) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `ID_Pedido` int(11) NOT NULL,
  `Nota` varchar(100) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `ID_Sucu` int(11) NOT NULL,
  `Cant_Cocina` int(2) NOT NULL,
  `Turno` int(1) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `ID_Compra` int(11) NOT NULL,
  `Precio` decimal(7,0) NOT NULL,
  `Direccion` varchar(20) NOT NULL,
  `Detalle` varchar(100) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiene_m`
--

CREATE TABLE `tiene_m` (
  `Fecha_Actual` datetime NOT NULL,
  `Fecha_Anterior` datetime NOT NULL,
  `ID_Estado` int(11) NOT NULL,
  `ID_Menu` int(11) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiene_p`
--

CREATE TABLE `tiene_p` (
  `Fecha_Actual` datetime NOT NULL,
  `Fecha_Anterior` datetime NOT NULL,
  `ID_Estado` int(11) NOT NULL,
  `ID_Pedido` int(11) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vianda`
--

CREATE TABLE `vianda` (
  `Fecha` date NOT NULL,
  `ID_Vianda` int(11) NOT NULL,
  `Fecha_V` date NOT NULL
);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID_Cliente`);

--
-- Indices de la tabla `comida`
--
ALTER TABLE `comida`
  ADD PRIMARY KEY (`ID_Comida`);

--
-- Indices de la tabla `contiene`
--
ALTER TABLE `contiene`
  ADD KEY `ID_Menu` (`ID_Menu`),
  ADD KEY `ID_Orden` (`ID_Orden`);

--
-- Indices de la tabla `dispara`
--
ALTER TABLE `dispara`
  ADD KEY `ID_Orden` (`ID_Orden`),
  ADD KEY `ID_Pedido` (`ID_Pedido`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`Login`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`ID_Cliente`);

--
-- Indices de la tabla `en`
--
ALTER TABLE `en`
  ADD KEY `ID_Pedido` (`ID_Pedido`),
  ADD KEY `ID_Sucu` (`ID_Sucu`);

--
-- Indices de la tabla `envasa`
--
ALTER TABLE `envasa`
  ADD KEY `ID_Menu` (`ID_Menu`),
  ADD KEY `ID_Orden` (`ID_Orden`),
  ADD KEY `ID_Vianda` (`ID_Vianda`);

--
-- Indices de la tabla `estado_m`
--
ALTER TABLE `estado_m`
  ADD PRIMARY KEY (`ID_Estado`);

--
-- Indices de la tabla `estado_p`
--
ALTER TABLE `estado_p`
  ADD PRIMARY KEY (`ID_Estado`);

--
-- Indices de la tabla `hace`
--
ALTER TABLE `hace`
  ADD KEY `ID_Cliente` (`ID_Cliente`),
  ADD KEY `ID_Pedido` (`ID_Pedido`);

--
-- Indices de la tabla `imprime`
--
ALTER TABLE `imprime`
  ADD KEY `ID_Compra` (`ID_Compra`),
  ADD KEY `ID_Vianda` (`ID_Vianda`);

--
-- Indices de la tabla `integran`
--
ALTER TABLE `integran`
  ADD KEY `ID_Comida` (`ID_Comida`),
  ADD KEY `ID_Menu` (`ID_Menu`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`ID_Menu`);

--
-- Indices de la tabla `normal`
--
ALTER TABLE `normal`
  ADD PRIMARY KEY (`ID_Cliente`);

--
-- Indices de la tabla `orden`
--
ALTER TABLE `orden`
  ADD PRIMARY KEY (`ID_Orden`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`ID_Pedido`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`ID_Sucu`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ID_Compra`);

--
-- Indices de la tabla `tiene_m`
--
ALTER TABLE `tiene_m`
  ADD KEY `ID_Menu` (`ID_Menu`),
  ADD KEY `ID_Estado` (`ID_Estado`);

--
-- Indices de la tabla `tiene_p`
--
ALTER TABLE `tiene_p`
  ADD KEY `ID_Pedido` (`ID_Pedido`),
  ADD KEY `ID_Estado` (`ID_Estado`);

--
-- Indices de la tabla `vianda`
--
ALTER TABLE `vianda`
  ADD PRIMARY KEY (`ID_Vianda`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID_Cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comida`
--
ALTER TABLE `comida`
  MODIFY `ID_Comida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `ID_Cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `ID_Menu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `normal`
--
ALTER TABLE `normal`
  MODIFY `ID_Cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orden`
--
ALTER TABLE `orden`
  MODIFY `ID_Orden` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `ID_Pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `ID_Sucu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ID_Compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vianda`
--
ALTER TABLE `vianda`
  MODIFY `ID_Vianda` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contiene`
--
ALTER TABLE `contiene`
  ADD CONSTRAINT `contiene_ibfk_1` FOREIGN KEY (`ID_Menu`) REFERENCES `menu` (`ID_Menu`),
  ADD CONSTRAINT `contiene_ibfk_2` FOREIGN KEY (`ID_Orden`) REFERENCES `orden` (`ID_Orden`);

--
-- Filtros para la tabla `dispara`
--
ALTER TABLE `dispara`
  ADD CONSTRAINT `dispara_ibfk_1` FOREIGN KEY (`ID_Orden`) REFERENCES `orden` (`ID_Orden`),
  ADD CONSTRAINT `dispara_ibfk_2` FOREIGN KEY (`ID_Pedido`) REFERENCES `pedido` (`ID_Pedido`);

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `empresa_ibfk_1` FOREIGN KEY (`ID_Cliente`) REFERENCES `cliente` (`ID_Cliente`);

--
-- Filtros para la tabla `en`
--
ALTER TABLE `en`
  ADD CONSTRAINT `en_ibfk_1` FOREIGN KEY (`ID_Pedido`) REFERENCES `pedido` (`ID_Pedido`),
  ADD CONSTRAINT `en_ibfk_2` FOREIGN KEY (`ID_Sucu`) REFERENCES `sucursal` (`ID_Sucu`);

--
-- Filtros para la tabla `envasa`
--
ALTER TABLE `envasa`
  ADD CONSTRAINT `envasa_ibfk_1` FOREIGN KEY (`ID_Menu`) REFERENCES `menu` (`ID_Menu`),
  ADD CONSTRAINT `envasa_ibfk_2` FOREIGN KEY (`ID_Orden`) REFERENCES `orden` (`ID_Orden`),
  ADD CONSTRAINT `envasa_ibfk_3` FOREIGN KEY (`ID_Vianda`) REFERENCES `vianda` (`ID_Vianda`);

--
-- Filtros para la tabla `hace`
--
ALTER TABLE `hace`
  ADD CONSTRAINT `hace_ibfk_1` FOREIGN KEY (`ID_Cliente`) REFERENCES `cliente` (`ID_Cliente`),
  ADD CONSTRAINT `hace_ibfk_2` FOREIGN KEY (`ID_Pedido`) REFERENCES `pedido` (`ID_Pedido`);

--
-- Filtros para la tabla `imprime`
--
ALTER TABLE `imprime`
  ADD CONSTRAINT `imprime_ibfk_1` FOREIGN KEY (`ID_Compra`) REFERENCES `ticket` (`ID_Compra`),
  ADD CONSTRAINT `imprime_ibfk_2` FOREIGN KEY (`ID_Vianda`) REFERENCES `vianda` (`ID_Vianda`);

--
-- Filtros para la tabla `integran`
--
ALTER TABLE `integran`
  ADD CONSTRAINT `integran_ibfk_1` FOREIGN KEY (`ID_Comida`) REFERENCES `comida` (`ID_Comida`),
  ADD CONSTRAINT `integran_ibfk_2` FOREIGN KEY (`ID_Menu`) REFERENCES `menu` (`ID_Menu`);

--
-- Filtros para la tabla `normal`
--
ALTER TABLE `normal`
  ADD CONSTRAINT `normal_ibfk_1` FOREIGN KEY (`ID_Cliente`) REFERENCES `cliente` (`ID_Cliente`);

--
-- Filtros para la tabla `tiene_m`
--
ALTER TABLE `tiene_m`
  ADD CONSTRAINT `tiene_m_ibfk_1` FOREIGN KEY (`ID_Menu`) REFERENCES `menu` (`ID_Menu`),
  ADD CONSTRAINT `tiene_m_ibfk_2` FOREIGN KEY (`ID_Estado`) REFERENCES `estado_m` (`ID_Estado`);

--
-- Filtros para la tabla `tiene_p`
--
ALTER TABLE `tiene_p`
  ADD CONSTRAINT `tiene_p_ibfk_1` FOREIGN KEY (`ID_Pedido`) REFERENCES `pedido` (`ID_Pedido`),
  ADD CONSTRAINT `tiene_p_ibfk_2` FOREIGN KEY (`ID_Estado`) REFERENCES `estado_p` (`ID_Estado`);
COMMIT;

/* Creacion de los Usuarios */

CREATE USER 'cliente'@'localhost' IDENTIFIED BY 'shell123';
CREATE USER 'informatico'@'localhost' IDENTIFIED BY 'shell123';
CREATE USER 'gerente'@'localhost' IDENTIFIED BY 'shell123';
CREATE USER 'cocina'@'localhost' IDENTIFIED BY 'shell123';
CREATE USER 'atencion'@'localhost' IDENTIFIED BY 'shell123';
CREATE USER 'administracion'@'localhost' IDENTIFIED BY 'shell123';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
