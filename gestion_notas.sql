-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-09-2024 a las 19:27:07
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestion_notas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturas`
--

CREATE TABLE `asignaturas` (
  `id_asignatura` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignaturas`
--

INSERT INTO `asignaturas` (`id_asignatura`, `nombre`, `descripcion`) VALUES
(1, 'Matemáticas', 'Números y operaciones'),
(2, 'Lenguaje', 'Lectura y escritura'),
(3, 'Ciencias Naturales', 'Estudio de la naturaleza'),
(4, 'Historia', 'Eventos y civilizaciones'),
(5, 'Geografía', 'Estudio del mundo'),
(6, 'Educación Física', 'Actividades deportivas'),
(7, 'Arte', 'Creatividad y expresión'),
(8, 'Inglés', 'Idioma extranjero básico'),
(9, 'Tecnología', 'Uso de herramientas digitales'),
(10, 'Ética', 'Valores y convivencia'),
(1001, 'Sistemas', 'Tecnologia y sistemas informaticos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `id_estudiante` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `grado` varchar(50) NOT NULL,
  `correo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id_estudiante`, `nombre`, `apellido`, `grado`, `correo`) VALUES
(1, 'Juan', 'Pérez Gómez', '1', 'juan.perez1@example.com'),
(2, 'María', 'Gómez', '1', 'maria.gomez1@example.com'),
(3, 'Carlos', 'Fernández', '1', 'carlos.fernandez1@example.com'),
(4, 'Ana', 'Torres', '1', 'ana.torres1@example.com'),
(5, 'Luis', 'Martínez', '1', 'luis.martinez1@example.com'),
(6, 'Sofía', 'Ramírez', '1', 'sofia.ramirez1@example.com'),
(7, 'Diego', 'Hernández', '1', 'diego.hernandez1@example.com'),
(8, 'Valentina', 'Castillo', '1', 'valentina.castillo1@example.com'),
(9, 'Samuel', 'Salazar Ramos', '1', 'samuel.salazar1@example.com'),
(10, 'Camila', 'Moreno', '1', 'camila.moreno1@example.com'),
(11, 'Pedro', 'Lopez', '2', 'pedro.lopez2@example.com'),
(12, 'Lucía', 'Vargas', '2', 'lucia.vargas2@example.com'),
(13, 'Sebastián', 'Ríos', '2', 'sebastian.rios2@example.com'),
(14, 'Isabella', 'Cuervo', '2', 'isabella.cuervo2@example.com'),
(15, 'Gabriel', 'Cruz', '2', 'gabriel.cruz2@example.com'),
(16, 'Camilo', 'Morales', '2', 'camilo.morales2@example.com'),
(17, 'Emilia', 'Pérez', '2', 'emilia.perez2@example.com'),
(18, 'Andrés', 'Rincón', '2', 'andres.rincon2@example.com'),
(19, 'Natalia', 'Castro', '2', 'natalia.castro2@example.com'),
(20, 'Julián', 'Bermúdez', '2', 'julian.bermudez2@example.com'),
(21, 'Matías', 'Ocampo', '3', 'matias.ocampo3@example.com'),
(22, 'Valeria', 'Salas', '3', 'valeria.salas3@example.com'),
(23, 'Lucas', 'Sierra', '3', 'lucas.sierra3@example.com'),
(24, 'Mariana', 'Hurtado', '3', 'mariana.hurtado3@example.com'),
(25, 'Nicolás', 'Córdoba', '3', 'nicolas.cordoba3@example.com'),
(26, 'Daniela', 'Cifuentes', '3', 'daniela.cifuentes3@example.com'),
(27, 'Tobías', 'López', '3', 'tobias.lopez3@example.com'),
(28, 'Diana', 'Pacheco', '3', 'diana.pacheco3@example.com'),
(29, 'Santiago', 'Medina', '3', 'santiago.medina3@example.com'),
(30, 'Camila', 'Ochoa', '3', 'camila.ochoa3@example.com'),
(31, 'Felipe', 'Buitrago', '4', 'felipe.buitrago4@example.com'),
(32, 'Luisa', 'Arango', '4', 'luisa.arango4@example.com'),
(33, 'Diego', 'Rojas', '4', 'diego.rojas4@example.com'),
(34, 'Andrea', 'Vélez', '4', 'andrea.velez4@example.com'),
(35, 'Cristian', 'Betancourt', '4', 'cristian.betancourt4@example.com'),
(36, 'Mía', 'Mendoza', '4', 'mia.mendoza4@example.com'),
(37, 'Emiliano', 'Osorio', '4', 'emiliano.osorio4@example.com'),
(38, 'Juliana', 'Gaviria', '4', 'juliana.gaviria4@example.com'),
(39, 'Alberto', 'Zapata', '4', 'alberto.zapata4@example.com'),
(40, 'Martina', 'Pinzón', '4', 'martina.pinzón4@example.com'),
(41, 'Samuel', 'Palacios', '5', 'samuel.palacios5@example.com'),
(42, 'Sofía', 'Bermúdez', '5', 'sofia.bermudez5@example.com'),
(43, 'Mateo', 'Becerra', '5', 'mateo.becerra5@example.com'),
(44, 'Emilia', 'Quintero', '5', 'emilia.quintero5@example.com'),
(45, 'Lucas', 'Restrepo', '5', 'lucas.restrepo5@example.com'),
(46, 'Gabriela', 'Jaramillo', '5', 'gabriela.jaramillo5@example.com'),
(47, 'Lina', 'Hernández', '5', 'lina.hernandez5@example.com'),
(48, 'Fernando', 'Vivas', '5', 'fernando.vivas5@example.com'),
(49, 'Victoria', 'Salazar', '5', 'victoria.salazar5@example.com'),
(50, 'Juan', 'Arias', '5', 'juan.arias5@example.com'),
(51, 'Santiago', 'León', '6', 'santiago.leon6@example.com'),
(52, 'Isabella', 'Serrano', '6', 'isabella.serrano6@example.com'),
(53, 'Alejandro', 'Maya', '6', 'alejandro.maya6@example.com'),
(54, 'Gabriela', 'Rincón', '6', 'gabriela.rincon6@example.com'),
(55, 'Valentín', 'González', '6', 'valentin.gonzalez6@example.com'),
(56, 'Salomé', 'Mejía', '6', 'salome.mejia6@example.com'),
(57, 'Emilio', 'Marín', '6', 'emilio.marin6@example.com'),
(58, 'Estefanía', 'Alonso', '6', 'estefania.alonso6@example.com'),
(59, 'Bruno', 'Castaño', '6', 'bruno.castano6@example.com'),
(60, 'Renata', 'Molina', '6', 'renata.molina6@example.com'),
(61, 'Pablo', 'Sánchez', '7', 'pablo.sanchez7@example.com'),
(62, 'Ariana', 'Cárdenas', '7', 'ariana.cardenas7@example.com'),
(63, 'Mauricio', 'Figueroa', '7', 'mauricio.figueroa7@example.com'),
(64, 'Carolina', 'Escobar', '7', 'carolina.escobar7@example.com'),
(65, 'Santiago', 'Gutiérrez', '7', 'santiago.gutierrez7@example.com'),
(66, 'Cecilia', 'Castañeda', '7', 'cecilia.castaneda7@example.com'),
(67, 'Ricardo', 'Ceballos', '7', 'ricardo.ceballos7@example.com'),
(68, 'Natalia', 'Ruiz', '7', 'natalia.ruiz7@example.com'),
(69, 'Sofía', 'Angulo', '7', 'sofia.angulo7@example.com'),
(70, 'Gonzalo', 'Barón', '7', 'gonzalo.baron7@example.com'),
(71, 'Ángel', 'Salinas', '8', 'angel.salinas8@example.com'),
(72, 'Marta', 'Peña', '8', 'marta.pena8@example.com'),
(73, 'Cristóbal', 'Giraldo', '8', 'cristobal.giraldo8@example.com'),
(74, 'Diana', 'Sarmiento', '8', 'diana.sarmiento8@example.com'),
(75, 'Patricio', 'Corredor', '8', 'patricio.corredor8@example.com'),
(76, 'Claudia', 'Alzate', '8', 'claudia.alzate8@example.com'),
(77, 'Ángela', 'Parra', '8', 'angela.parra8@example.com'),
(78, 'Hugo', 'Hincapié', '8', 'hugo.hincapie8@example.com'),
(79, 'Luz', 'Gonzalez', '8', 'luz.gonzalez8@example.com'),
(80, 'Martín', 'Bermúdez', '8', 'martin.bermudez8@example.com'),
(81, 'Carlos', 'Marín', '9', 'carlos.marin9@example.com'),
(82, 'Beatriz', 'Salazar', '9', 'beatriz.salazar9@example.com'),
(83, 'Samuel', 'Vásquez', '9', 'samuel.vasquez9@example.com'),
(84, 'Verónica', 'Rivas', '9', 'veronica.rivas9@example.com'),
(85, 'Salvador', 'Prado', '9', 'salvador.prado9@example.com'),
(86, 'María', 'Pineda', '9', 'maria.pineda9@example.com'),
(87, 'Ricardo', 'Téllez', '9', 'ricardo.tellez9@example.com'),
(88, 'Luisa', 'López', '9', 'luisa.lopez9@example.com'),
(89, 'Héctor', 'Patiño', '9', 'hector.patino9@example.com'),
(90, 'Elena', 'Hernández', '9', 'elena.hernandez9@example.com'),
(91, 'Arturo', 'Arroyo', '10', 'arturo.arroyo10@example.com'),
(92, 'Carmen', 'Reyes', '10', 'carmen.reyes10@example.com'),
(93, 'Jorge', 'Valdés', '10', 'jorge.valdes10@example.com'),
(94, 'Sofia', 'Aguirre', '10', 'sofia.aguirre10@example.com'),
(95, 'Andrés', 'Alzate', '10', 'andres.alzate10@example.com'),
(96, 'Lina', 'Acosta', '10', 'lina.acosta10@example.com'),
(97, 'Julián', 'Duque', '10', 'julian.duque10@example.com'),
(98, 'Valentina', 'Ortiz', '10', 'valentina.ortiz10@example.com'),
(99, 'Diego', 'García', '10', 'diego.garcia10@example.com'),
(100, 'Laura', 'Córdoba', '10', 'laura.cordoba10@example.com'),
(101, 'Emilio', 'Ocampo', '11', 'emilio.ocampo11@example.com'),
(102, 'Viviana', 'López', '11', 'viviana.lopez11@example.com'),
(103, 'Victor', 'Jiménez', '11', 'victor.jimenez11@example.com'),
(104, 'Carla', 'Mendoza', '11', 'carla.mendoza11@example.com'),
(105, 'Manuel', 'Ramírez', '11', 'manuel.ramirez11@example.com'),
(106, 'Sara', 'López', '11', 'sara.lopez11@example.com'),
(107, 'Daniel', 'Tobón', '11', 'daniel.tobon11@example.com'),
(108, 'Lucía', 'Salazar', '11', 'lucia.salazar11@example.com'),
(109, 'Fernando', 'Castrillón', '11', 'fernando.castrillon11@example.com'),
(110, 'Natalia', 'Valenzuela', '11', 'natalia.valenzuela11@example.com'),
(200, 'asdas', 'a', '2', 'ads@gmail.com'),
(201, 'b', 'b', '2', 'b@gmail.com'),
(203, 'c', 'c', '2', 'c@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `id_nota` int(11) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `id_asignatura` int(11) NOT NULL,
  `id_profesor` int(11) NOT NULL,
  `periodo` int(11) NOT NULL CHECK (`periodo` between 1 and 4),
  `nota` decimal(2,1) NOT NULL CHECK (`nota` between 1 and 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`id_nota`, `id_estudiante`, `id_asignatura`, `id_profesor`, `periodo`, `nota`) VALUES
(1, 1, 1, 1, 1, 4.8),
(3, 1, 3, 2, 1, 3.5),
(11, 1, 1, 1, 1, 4.5),
(12, 1, 2, 2, 1, 3.8),
(13, 2, 1, 1, 1, 4.0),
(14, 2, 3, 3, 1, 2.5),
(15, 3, 2, 2, 1, 3.2),
(16, 3, 4, 4, 1, 3.5),
(17, 4, 5, 5, 1, 4.0),
(18, 5, 1, 1, 1, 2.0),
(19, 5, 3, 3, 1, 3.0),
(20, 1, 1, 1, 2, 5.0),
(21, 1, 2, 2, 2, 4.5),
(22, 2, 1, 1, 2, 4.0),
(23, 2, 3, 3, 2, 3.5),
(24, 3, 2, 2, 2, 3.0),
(25, 3, 4, 4, 2, 4.0),
(26, 4, 5, 5, 2, 4.5),
(27, 5, 1, 1, 2, 2.5),
(28, 5, 3, 3, 2, 3.5),
(29, 200, 1, 1, 1, 3.0),
(30, 201, 2, 2, 1, 2.5),
(31, 203, 3, 3, 1, 4.3),
(32, 200, 5, 5, 3, 5.0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `id_profesor` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `especialidad` varchar(100) NOT NULL,
  `correo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`id_profesor`, `nombre`, `apellido`, `especialidad`, `correo`) VALUES
(1, 'Laura', 'Martínez', 'Lenguaje', 'laura.martinez@example.com'),
(2, 'Pedro', 'Fernández', 'Lenguaje', 'pedro.fernandez@example.com'),
(3, 'Sofía', 'Hernández', 'Matemáticas', 'sofia.hernandez@example.com'),
(4, 'Andrés', 'García', 'Matemáticas', 'andres.garcia@example.com'),
(5, 'Clara', 'Rodríguez', 'Ciencias Naturales', 'clara.rodriguez@example.com'),
(6, 'Julio', 'López', 'Ciencias Naturales', 'julio.lopez@example.com'),
(7, 'Carmen', 'González', 'Ciencias Sociales', 'carmen.gonzalez@example.com'),
(8, 'Roberto', 'Sánchez', 'Ciencias Sociales', 'roberto.sanchez@example.com'),
(9, 'Lucía', 'Torres', 'Educación Física', 'lucia.torres@example.com'),
(10, 'Diego', 'Martínez', 'Educación Física', 'diego.martinez@example.com'),
(11, 'Ana', 'Rivas', 'Lenguaje', 'ana.rivas@example.com'),
(12, 'Luis', 'Martínez', 'Lenguaje', 'luis.martinez@example.com'),
(13, 'Fernando', 'Cano', 'Matemáticas', 'fernando.cano@example.com'),
(14, 'Valentina', 'Morales', 'Matemáticas', 'valentina.morales@example.com'),
(15, 'Marcos', 'Céspedes', 'Física', 'marcos.cespedes@example.com'),
(16, 'Gabriela', 'Pérez', 'Física', 'gabriela.perez@example.com'),
(17, 'Iván', 'Acosta', 'Química', 'ivan.acosta@example.com'),
(18, 'Carla', 'Suárez', 'Química', 'carla.suarez@example.com'),
(19, 'Jorge', 'Ortega', 'Historia', 'jorge.ortega@example.com'),
(20, 'Mónica', 'Cáceres', 'Historia', 'monica.caceres@example.com'),
(1001, 'Carlos ', 'Ceballos', '1', 'wcarlosceballos@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','student','teacher') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'admin', '$2y$10$9d/MtE36KpsWi/OSJE4O1OR5/3ANuOMd7bfdUN5MLKQYEtYbGmRVC', 'admin', '2024-09-26 00:49:28'),
(5, 'teacher', '$2y$10$URaWs0Pj63u3tDFleTGpR.IhMpdldkGRhV17LjR6EwzM/81Hidh4e', 'teacher', '2024-09-28 19:45:01'),
(6, 'student', '$2y$10$bgdrDHD5lujXOtHmfsokJOKVd1Dg0hdh1.8ii22qCNO.0cPwj.qT2', 'student', '2024-09-28 20:50:09');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD PRIMARY KEY (`id_asignatura`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`id_estudiante`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id_nota`),
  ADD KEY `id_estudiante` (`id_estudiante`),
  ADD KEY `id_asignatura` (`id_asignatura`),
  ADD KEY `id_profesor` (`id_profesor`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`id_profesor`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiantes` (`id_estudiante`) ON DELETE CASCADE,
  ADD CONSTRAINT `notas_ibfk_2` FOREIGN KEY (`id_asignatura`) REFERENCES `asignaturas` (`id_asignatura`) ON DELETE CASCADE,
  ADD CONSTRAINT `notas_ibfk_3` FOREIGN KEY (`id_profesor`) REFERENCES `profesores` (`id_profesor`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
