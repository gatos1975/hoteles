-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-07-2023 a las 00:47:26
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hoteles`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `idciudad` int(11) NOT NULL,
  `ciudad` varchar(35) NOT NULL,
  `detalle` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`idciudad`, `ciudad`, `detalle`) VALUES
(2, 'MACAS', 'MORONA SANTIAGO'),
(3, 'QUITO', 'PICHINCHA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idusuario` int(11) NOT NULL,
  `nombres` int(11) NOT NULL,
  `telefono` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `idhabitacion` int(11) NOT NULL,
  `idhotel` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`idhabitacion`, `idhotel`, `numero`, `descripcion`, `estado`) VALUES
(1, 5, 1, 'CAMA SIMPLE', ''),
(3, 1, 2, 'habitacion matrimonial con vis', ''),
(4, 5, 5, '2 plazas', 'LIBRE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hoteles`
--

CREATE TABLE `hoteles` (
  `idHotel` int(11) NOT NULL,
  `idciudad` int(11) NOT NULL,
  `nombre` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hoteles`
--

INSERT INTO `hoteles` (`idHotel`, `idciudad`, `nombre`) VALUES
(1, 2, 'SOL DEL ORIENTE'),
(2, 3, 'PUERTO RICO'),
(3, 2, 'HOTEL AMAZONAS'),
(5, 2, 'ARRAYAN Y PIEDRA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `idReservas` int(11) NOT NULL,
  `idHabitaciones` int(11) NOT NULL,
  `idClientes` int(11) NOT NULL,
  `fentrada` date NOT NULL,
  `fsalida` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsaurio` int(11) NOT NULL,
  `Nombres` text NOT NULL,
  `Apellidos` text NOT NULL,
  `contrasenia` text NOT NULL,
  `correo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsaurio`, `Nombres`, `Apellidos`, `contrasenia`, `correo`) VALUES
(1, 'admin', 'admin', '123', 'admin@gmail.com'),
(2, 'ANIBAL', 'ANDRAMUÑO', '1234', 'anibalandramunio@gmail.com'),
(3, 'Wilmer Stevens', 'Ayuy Atamaint', '123', 'wilmerstevens@gmail.com'),
(14, 'Monica', 'Sanchez', '123456', 'monica@yahoo.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`idciudad`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idusuario`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`idhabitacion`),
  ADD KEY `idhotel_idx` (`idhotel`);

--
-- Indices de la tabla `hoteles`
--
ALTER TABLE `hoteles`
  ADD PRIMARY KEY (`idHotel`),
  ADD KEY `idciudad_idx` (`idciudad`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`idReservas`),
  ADD KEY `idhabitacion_idx` (`idHabitaciones`),
  ADD KEY `idclientes_idx` (`idClientes`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsaurio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `idciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `idhabitacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `hoteles`
--
ALTER TABLE `hoteles`
  MODIFY `idHotel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `idReservas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsaurio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD CONSTRAINT `habitaciones_ibfk_1` FOREIGN KEY (`idhotel`) REFERENCES `hoteles` (`idHotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `hoteles`
--
ALTER TABLE `hoteles`
  ADD CONSTRAINT `hoteles_ibfk_1` FOREIGN KEY (`idciudad`) REFERENCES `ciudades` (`idciudad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`idHabitaciones`) REFERENCES `habitaciones` (`idhabitacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`idClientes`) REFERENCES `clientes` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
