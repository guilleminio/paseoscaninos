-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-11-2021 a las 00:57:17
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `paseos_caninos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(300) NOT NULL,
  `apellido_cliente` varchar(300) NOT NULL,
  `email_cliente` varchar(50) NOT NULL,
  `telefono_cliente` varchar(50) NOT NULL,
  `domicilio_cliente` varchar(300) NOT NULL,
  `contrasenia_cliente` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre_cliente`, `apellido_cliente`, `email_cliente`, `telefono_cliente`, `domicilio_cliente`, `contrasenia_cliente`) VALUES
(1, 'Cosme', 'Fulanito', 'doncosmefulanito@springfield.com', '22548642', 'Calle False 123', '$2y$10$mgqPKhaulErnIrV3mhlhRe4Grdo8E7H4vxuzMLpyL8P3gqJs.d1qe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paseadores`
--

CREATE TABLE `paseadores` (
  `id_paseador` int(11) NOT NULL,
  `nombre_paseador` varchar(300) NOT NULL,
  `apellido_paseador` varchar(300) NOT NULL,
  `descripcion_paseador` varchar(500) NOT NULL,
  `fecha_ingreso_paseador` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `paseadores`
--

INSERT INTO `paseadores` (`id_paseador`, `nombre_paseador`, `apellido_paseador`, `descripcion_paseador`, `fecha_ingreso_paseador`) VALUES
(1, 'Agostina', 'Bonano', 'Me encantan los animales, su energía y compañerismo. Me considero muy responsable y siempre les dedico toda mi atención y cuidados. Tengo experiencia haciendo paseos de perros y me gusta mucho pasar mi tiempo cuidándolos', '2018-07-09'),
(2, 'Martín', 'Finaccio', 'Mis paseos se basan en: ejercicio fisico, educación basica canina, compromiso y dedicación con todos por igual, ¡en cada uno de mis paseos!', '2016-08-17'),
(3, 'Sergio', 'García', 'Soy profesional universitario y quiero mucho a los perros; la fidelidad a su amo y la ternura e inocencia que transmiten cuando te miran son impagables; les das cariño y ellos te lo devuelven. Te ofrezco darle a tu perro el paseo que el tanto desea en el día, con una buena caminata para que libere sus energias y se mantenga en buena forma', '2017-04-19'),
(4, 'Pablo', 'Wos', 'Hola soy Ignacio. Toda mi vida crié perros. Tuve desde dogos argentinos hasta salchichas. Son mi debilidad. Cuando quieras damos una vuelta!', '2021-04-14'),
(5, 'Brenda', 'Pacheco', 'Siempre tuve perros de todas las razas. Me gusta jugar y salir a correr con ellos. Son la compañía más noble que se puede tener y estar rodeada de ellos me da tranquilidad!!!', '2017-11-15'),
(6, 'Romina', 'Paredes', 'Hola! amo los perros por esto me inicie en Paseos Caninos, quisiera poder compartir con ellos no sólo un agradable paseo, sino tambien dándole el cariño y la compañia que necesitan cuando no pueden estar con sus dueños y hacerlos sentir en familia.', '2016-10-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paseos`
--

CREATE TABLE `paseos` (
  `id_paseo` int(11) NOT NULL,
  `id_paseador` int(11) NOT NULL,
  `id_perro` int(11) NOT NULL,
  `fecha_paseo` date NOT NULL,
  `hora_paseo` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `paseos`
--

INSERT INTO `paseos` (`id_paseo`, `id_paseador`, `id_perro`, `fecha_paseo`, `hora_paseo`) VALUES
(1, 3, 1, '2021-12-06', '12:00:00'),
(3, 5, 1, '2021-12-09', '11:00:00'),
(4, 5, 1, '2021-12-09', '11:00:00'),
(5, 1, 1, '2021-11-29', '09:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perros`
--

CREATE TABLE `perros` (
  `id_perro` int(11) NOT NULL,
  `nombre_perro` varchar(50) NOT NULL,
  `edad_perro` int(11) NOT NULL,
  `tamanio_perro` varchar(50) NOT NULL,
  `raza_perro` varchar(50) NOT NULL,
  `descripcion_perro` varchar(300) NOT NULL,
  `duenio_perro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `perros`
--

INSERT INTO `perros` (`id_perro`, `nombre_perro`, `edad_perro`, `tamanio_perro`, `raza_perro`, `descripcion_perro`, `duenio_perro`) VALUES
(1, 'Boris', 4, '2', 'Golden', 'Aún tiene mentalidad de cachorro', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `email_cliente` (`email_cliente`);

--
-- Indices de la tabla `paseadores`
--
ALTER TABLE `paseadores`
  ADD PRIMARY KEY (`id_paseador`);

--
-- Indices de la tabla `paseos`
--
ALTER TABLE `paseos`
  ADD PRIMARY KEY (`id_paseo`),
  ADD KEY `FK_PERROS_PASEOS` (`id_perro`),
  ADD KEY `FK_PASEADORES_PASEOS` (`id_paseador`);

--
-- Indices de la tabla `perros`
--
ALTER TABLE `perros`
  ADD PRIMARY KEY (`id_perro`),
  ADD KEY `FK_PERROS_CLIENTES` (`duenio_perro`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `paseadores`
--
ALTER TABLE `paseadores`
  MODIFY `id_paseador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `paseos`
--
ALTER TABLE `paseos`
  MODIFY `id_paseo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `perros`
--
ALTER TABLE `perros`
  MODIFY `id_perro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `paseos`
--
ALTER TABLE `paseos`
  ADD CONSTRAINT `FK_PASEADORES_PASEOS` FOREIGN KEY (`id_paseador`) REFERENCES `paseadores` (`id_paseador`),
  ADD CONSTRAINT `FK_PERROS_PASEOS` FOREIGN KEY (`id_perro`) REFERENCES `perros` (`id_perro`);

--
-- Filtros para la tabla `perros`
--
ALTER TABLE `perros`
  ADD CONSTRAINT `FK_PERROS_CLIENTES` FOREIGN KEY (`duenio_perro`) REFERENCES `cliente` (`id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
