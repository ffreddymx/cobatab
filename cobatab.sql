-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2021 a las 07:42:05
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
  `Direccion` varchar(200) NOT NULL,
  `Movil` varchar(10) NOT NULL,
  `Email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `Nombre`, `Apellido`, `Matricula`, `Direccion`, `Movil`, `Email`) VALUES
(1, 'Ernesto Zedillo', 'Ponce de Leon', '1PB20028', 'Las Lomas DF', '', ''),
(15, 'Benito', 'Juarez', '123fggg', 'El derecho al respeto ajeno es la paz', '', ''),
(17, 'Jorge Luis', 'Aguilar de la Cruz', '20B0220034', 'Conocida', '9932840160', 'jorge@google.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `id` int(11) NOT NULL,
  `Asignatura` varchar(50) NOT NULL,
  `idgrupo` int(11) NOT NULL,
  `Hora` int(2) NOT NULL,
  `Dia` varchar(10) NOT NULL,
  `idprofesor` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`id`, `Asignatura`, `idgrupo`, `Hora`, `Dia`, `idprofesor`) VALUES
(1, 'Español', 12, 1, 'Lunes', 1),
(4, 'Mecánica Cuántica', 12, 2, 'Lunes', 2),
(6, 'Ciencias', 12, 4, 'Martes', 3),
(7, 'Español', 12, 4, 'Lunes', 1),
(8, 'Español', 12, 1, 'Martes', 1),
(9, 'Mecánica Cuántica', 12, 2, 'Martes', 2),
(12, 'Mecánica Cuántica', 12, 4, 'Martes', 2);

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
(5, '4to', 13, 3);

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
(13, 'C', 'Vespertino', '2022-2025'),
(14, 'C', 'Matutino', '2022-2025');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `id` int(11) NOT NULL,
  `horario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`id`, `horario`) VALUES
(1, '0600-0650'),
(2, '0650-0740'),
(3, '0740-0830'),
(4, '0830-0920'),
(5, '0920-0950'),
(6, '0950-1040'),
(7, '1040-1130'),
(8, '1130-1220'),
(9, '1220-1310');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscrito`
--

CREATE TABLE `inscrito` (
  `id` int(11) NOT NULL,
  `idalumno` int(11) NOT NULL,
  `idgrupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inscrito`
--

INSERT INTO `inscrito` (`id`, `idalumno`, `idgrupo`) VALUES
(27, 1, 13),
(28, 15, 12),
(29, 1, 12),
(30, 17, 12);

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
  `Aprobado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`id`, `idasignatura`, `idalumno`, `Nota1`, `Nota2`, `Nota3`, `Promedio`, `Aprobado`) VALUES
(8, 1, 15, 9, 9, 9, 0, 'Si'),
(9, 4, 15, 5, 5, 5, 0, 'No'),
(10, 1, 1, 8, 8, 8, 0, 'Si'),
(11, 4, 1, 9, 8, 8, 0, 'Si'),
(12, 1, 17, 0, 0, 0, 0, 'Cursando'),
(13, 4, 17, 0, 0, 0, 0, 'Cursando');

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
(3, 'Lilina Carolina', 'Mendez Cruz', 'Pichucalco, Chiapas', '', '322145788', 'Ing. Informatica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `usuario` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `Nivel` int(1) NOT NULL,
  `Tipo` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `idalumno` int(3) NOT NULL,
  `idprofesor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `usuario`, `password`, `Nivel`, `Tipo`, `idalumno`, `idprofesor`) VALUES
(1, 'admin', 'admin', 1, 'Administrador', 0, 0),
(2, 'local', 'local', 3, 'Alumno', 15, 0),
(3, 'profesor', 'alumno', 2, 'Profesor', 0, 2),
(15, 'ssss', '', 0, 'Profesor', 0, 3);

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
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inscrito`
--
ALTER TABLE `inscrito`
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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `grado`
--
ALTER TABLE `grado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `inscrito`
--
ALTER TABLE `inscrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
