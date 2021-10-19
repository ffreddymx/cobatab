-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2021 a las 01:20:58
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cobatab`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Apellido` varchar(30) NOT NULL,
  `Matricula` varchar(30) NOT NULL,
  `Tutor` varchar(100) NOT NULL,
  `Direccion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `Nombre`, `Apellido`, `Matricula`, `Tutor`, `Direccion`) VALUES
(1, 'Benito', 'Juárez Zapata', '1PB30025', 'Bernardo Juárez Castillo', 'Calle 27 de Febrero, Colonia Pueblo Nuevo, Tacotalpa Tabasco '),
(2, 'Emiliano', 'Hidalgo Zapata', '1PB20026', 'Miguel Hidalgo y Costilla', 'Tacotalpa'),
(4, 'Ruben', 'Estrada Marin', '1PB20027', 'Olga Nieto Pintado', 'Conocida'),
(5, 'Ernesto Zedillo', 'Ponce de Leon', '1PB20028', 'Salinas de Gortari', 'Las Lomas DF'),
(8, 'Darvin ', 'Garcia Cordova', '1PB20030', 'Daniel Garcia', 'Conocida'),
(9, 'Leonel', 'Messi', '1PB20031', 'Pele', 'Argentina'),
(10, 'ccccx', 'cccx', 'ccccx', 'cccx', 'cccx');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `Id` int(11) NOT NULL,
  `usuario` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `Tipo` int(1) NOT NULL,
  `Nombre` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `Grado` int(5) NOT NULL,
  `Grupo` varchar(2) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`Id`, `usuario`, `password`, `Tipo`, `Nombre`, `Grado`, `Grupo`) VALUES
(1, 'admin', 'admin', 1, 'Dr Raul Sanchez Doriga', 0, ''),
(2, 'local', 'local', 2, 'Profesor Oscar', 0, ''),
(3, 'alumno', 'alumno', 3, 'Fernando Díaz', 1, 'A'),
(4, 'ssss', 'ssss', 2, 'sss', 2, 'A'),
(5, 'xxxx', 'xxxx', 2, 'xxx', 2, 'B'),
(6, 'paquete', 'paquete', 1, 'Armando', 0, ''),
(7, 'rodolfo', 'rodolfo', 2, 'rodolfo martinez', 0, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
