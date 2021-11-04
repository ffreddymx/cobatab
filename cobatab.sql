-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-11-2021 a las 02:57:09
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
(1, 'Ernesto Zedillo', 'Ponce de Leon', '1PB20028', 'Salinas de Gortari', 'Las Lomas DF'),
(15, 'Benito', 'Juarez', '123fggg', '', 'El derecho al respeto ajeno es la paz');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `id` int(11) NOT NULL,
  `Asignatura` varchar(50) NOT NULL,
  `idgrupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`id`, `Asignatura`, `idgrupo`) VALUES
(1, 'Español', 12),
(4, 'Mecánica Cuántica', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE `grado` (
  `id` int(11) NOT NULL,
  `grado` varchar(11) NOT NULL,
  `idgrupo` int(11) NOT NULL,
  `idprofesor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`id`, `grado`, `idgrupo`, `idprofesor`) VALUES
(1, '3ro', 1, 1),
(2, '2do', 12, 2),
(4, '2do', 12, 2),
(5, '4to', 13, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `id` int(11) NOT NULL,
  `Grupo` varchar(50) NOT NULL,
  `Turno` varchar(20) NOT NULL,
  `Ciclo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id`, `Grupo`, `Turno`, `Ciclo`) VALUES
(1, 'A', 'Matutino', '2019-2022'),
(12, 'B', 'Matutino', '2019-2022'),
(13, 'C', 'Vespertino', '2022-2025');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `id` int(11) NOT NULL,
  `idasignatura` int(2) NOT NULL,
  `idalumno` int(2) NOT NULL,
  `Nota1` int(2) NOT NULL,
  `Nota2` int(2) NOT NULL,
  `Nota3` int(2) NOT NULL,
  `Promedio` float NOT NULL,
  `Aprobado` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`id`, `idasignatura`, `idalumno`, `Nota1`, `Nota2`, `Nota3`, `Promedio`, `Aprobado`) VALUES
(1, 1, 1, 8, 0, 0, 0, 'No');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellido` varchar(50) NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Movil` varchar(10) NOT NULL,
  `Profesion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`id`, `Nombre`, `Apellido`, `Direccion`, `Email`, `Movil`, `Profesion`) VALUES
(1, 'Oscar Raul', 'Martines Valdez', 'Las Gaviotas 3ra, Villahermosa, Tabasco', '', '9932658744', 'Lic. Bioquimica'),
(2, 'Ruben', 'Hernandez Trinidad', 'Oro Verde, Tacotalpa Tabasco', '', '9325487', 'Lic. Matematica'),
(5, 'Lilina Carolina', 'Mendez Cruz', 'Pichucalco, Chiapas', '', '322145788', 'Ing. Informatica');

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
(7, 'rodolfo', 'rodolfo', 2, 'rodolfo martinez', 0, ''),
(8, 'sdsdfdsf', '', 0, '', 0, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idgrupo` (`idgrupo`),
  ADD KEY `idgrupo_2` (`idgrupo`);

--
-- Indices de la tabla `grado`
--
ALTER TABLE `grado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idgrupo` (`idgrupo`),
  ADD KEY `idprofesor` (`idprofesor`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idasignatura` (`idasignatura`),
  ADD KEY `idalumno` (`idalumno`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `grado`
--
ALTER TABLE `grado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD CONSTRAINT `asignatura_ibfk_1` FOREIGN KEY (`idgrupo`) REFERENCES `grupo` (`id`);

--
-- Filtros para la tabla `grado`
--
ALTER TABLE `grado`
  ADD CONSTRAINT `grado_ibfk_1` FOREIGN KEY (`idgrupo`) REFERENCES `grupo` (`id`),
  ADD CONSTRAINT `grado_ibfk_2` FOREIGN KEY (`idprofesor`) REFERENCES `profesor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`idasignatura`) REFERENCES `asignatura` (`id`),
  ADD CONSTRAINT `notas_ibfk_2` FOREIGN KEY (`idalumno`) REFERENCES `alumnos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
