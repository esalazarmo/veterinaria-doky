-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-12-2024 a las 06:33:23
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
-- Base de datos: `dokibase`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendario`
--

CREATE TABLE `calendario` (
  `id_calendario` int(11) NOT NULL,
  `id_cita` int(11) DEFAULT NULL,
  `fecha_disponible` varchar(255) DEFAULT NULL,
  `hora_disponible` varchar(255) DEFAULT NULL,
  `id_veterinario` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_de_compras`
--

CREATE TABLE `carrito_de_compras` (
  `id_carrito` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_total` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chatbot`
--

CREATE TABLE `chatbot` (
  `IdChatbot` int(11) NOT NULL,
  `idServicio` int(11) DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  `IdMembresia` int(11) DEFAULT NULL,
  `Tipo_interaccion` varchar(255) DEFAULT NULL,
  `Mensaje_bienvenida` varchar(255) DEFAULT NULL,
  `Pre_diagnostico` bit(1) DEFAULT NULL,
  `Fecha_interaccion` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `id_cita` int(11) NOT NULL,
  `idchatbot` int(11) DEFAULT NULL,
  `fecha_cita` date DEFAULT NULL,
  `tipo_servicio` varchar(255) DEFAULT NULL,
  `estado_cita` varchar(50) DEFAULT NULL,
  `id_Usuario` int(11) DEFAULT NULL,
  `id_veterinario` int(11) DEFAULT NULL,
  `id_mascota` int(11) DEFAULT NULL,
  `id_estilista` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estilista`
--

CREATE TABLE `estilista` (
  `id_estilista` int(11) NOT NULL,
  `nombre_estilista` varchar(255) DEFAULT NULL,
  `especialidad` varchar(255) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia_clinica`
--

CREATE TABLE `historia_clinica` (
  `id_historia` int(11) NOT NULL,
  `id_mascota` int(11) DEFAULT NULL,
  `id_veterinario` int(11) DEFAULT NULL,
  `fecha_consulta` date DEFAULT NULL,
  `diagnostico` varchar(255) DEFAULT NULL,
  `tratamiento` varchar(255) DEFAULT NULL,
  `observaciones` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `historia_clinica`
--

INSERT INTO `historia_clinica` (`id_historia`, `id_mascota`, `id_veterinario`, `fecha_consulta`, `diagnostico`, `tratamiento`, `observaciones`) VALUES
(6, 6, 2, '2024-07-14', 'Problemas respiratorios', 'Nebulizaciones', 'Evitar corrientes de aire'),
(5, 5, 1, '2024-06-22', 'Infección intestinal', 'Antibióticos', 'Evitar alimentos crudos'),
(4, 4, 4, '2024-05-18', 'Deshidratación', 'Suero oral y dieta balanceada', 'Hidratación diaria necesaria'),
(3, 3, 3, '2024-04-12', 'Artritis', 'Analgésicos y fisioterapia', 'Revisar en un mes'),
(2, 2, 2, '2024-03-05', 'Infección respiratoria', 'Antibióticos y reposo', 'Control en dos semanas'),
(1, 1, 1, '2024-02-10', 'Alergia cutánea', 'Antihistamínicos', 'Evitar ciertos alimentos'),
(7, 7, 3, '2024-08-03', 'Fractura en la pata', 'Cirugía y reposo', 'Radiografía de control en 15 días'),
(8, 8, 4, '2024-09-10', 'Sobrepeso', 'Dieta hipocalórica', 'Ejercicio diario recomendado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascota`
--

CREATE TABLE `mascota` (
  `id_mascota` int(11) NOT NULL,
  `nombre_mascota` varchar(255) DEFAULT NULL,
  `especie` varchar(255) DEFAULT NULL,
  `raza` varchar(255) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `id_Usuario` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `mascota`
--

INSERT INTO `mascota` (`id_mascota`, `nombre_mascota`, `especie`, `raza`, `edad`, `id_Usuario`) VALUES
(1, 'Nina', 'Conejo', 'Mini Lop', 1, 4),
(2, 'Rex', 'Perro', 'Pastor Alemán', 4, 3),
(3, 'Max', 'Perro', 'Golden Retriever', 3, 1),
(4, 'Luna', 'Gato', 'Siames', 2, 2),
(5, 'Coco', 'Ave', 'Loro Amazónico', 5, 5),
(6, 'Milo', 'Gato', 'Persa', 6, 6),
(7, 'Bella', 'Perro', 'Bulldog Francés', 2, 7),
(8, 'Rocky', 'Perro', 'Chihuahua', 3, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membresia`
--

CREATE TABLE `membresia` (
  `id_membresia` int(11) NOT NULL,
  `tipo_membresia` varchar(50) DEFAULT NULL,
  `precio_mensual` float DEFAULT NULL,
  `beneficios` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `id_pago` int(11) NOT NULL,
  `monto` float DEFAULT NULL,
  `fecha_pago` date DEFAULT NULL,
  `metodo_pago` varchar(50) DEFAULT NULL,
  `estado_pago` varchar(50) DEFAULT NULL,
  `id_cita` int(11) DEFAULT NULL,
  `id_carrito` int(11) DEFAULT NULL,
  `id_membresia` int(11) DEFAULT NULL,
  `id_servicio` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `disponibilidad` bit(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre_producto`, `descripcion`, `precio`, `disponibilidad`) VALUES
(1, 'Ricocan', 'Camida para perro 1kl', 20, b'1'),
(2, 'Ricocat', 'Camida para gato 1kl', 19.5, b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id_servicio` int(11) NOT NULL,
  `nombre_servicio` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `id_estilista` int(11) DEFAULT NULL,
  `id_veterinario` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `IdUsuario` int(11) NOT NULL,
  `Nombre_usuario` varchar(255) DEFAULT NULL,
  `Correo_electronico` varchar(255) DEFAULT NULL,
  `Contraseña` varchar(255) DEFAULT NULL,
  `Fecha_registro` date DEFAULT NULL,
  `Calificacion_servicio` int(11) DEFAULT NULL,
  `Comentario` text DEFAULT NULL,
  `DNI` varchar(20) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IdUsuario`, `Nombre_usuario`, `Correo_electronico`, `Contraseña`, `Fecha_registro`, `Calificacion_servicio`, `Comentario`, `DNI`, `Telefono`, `Direccion`) VALUES
(1, 'Juan Pérez', 'juan.perez@example.com', 'pass1234', '2024-01-01', 5, 'Excelente servicio.', '12345678', '987654321', 'Av. Siempre Viva 123'),
(2, 'María López', 'maria.lopez@example.com', 'securePass!', '2024-01-15', 4, 'Buena atención.', '87654321', '912345678', 'Calle Falsa 456'),
(3, 'Carlos García', 'carlos.garcia@example.com', 'myPass@2024', '2024-02-10', 5, 'Atención rápida.', '56789012', '945612378', 'Jr. Los Olivos 789'),
(4, 'Ana Torres', 'ana.torres@example.com', 'password123', '2024-03-05', 3, 'Podría mejorar.', '89012345', '963258741', 'Av. San Juan 102'),
(5, 'Luis Martínez', 'luis.martinez@example.com', 'L0vemyPet', '2024-04-20', 4, 'Buena experiencia.', '45678901', '987123456', 'Calle Luna 15'),
(6, 'Lucía Fernández', 'lucia.fernandez@example.com', 'Fernandez@123', '2024-05-25', 5, 'Encantada con el servicio.', '12398765', '985624731', 'Jr. Sol Naciente 48'),
(7, 'Pedro Morales', 'pedro.morales@example.com', 'moralesPedro!', '2024-06-30', 3, 'Algo de demora.', '78901234', '953267849', 'Av. Primavera 33'),
(8, 'Sofía Ramírez', 'sofia.ramirez@example.com', 'Sofi@12345', '2024-07-15', 5, 'Muy recomendable.', '43210987', '912837465', 'Calle Victoria 67');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `veterinario`
--

CREATE TABLE `veterinario` (
  `id_veterinario` int(11) NOT NULL,
  `nombre_veterinario` varchar(255) DEFAULT NULL,
  `especialidad` varchar(255) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `veterinario`
--

INSERT INTO `veterinario` (`id_veterinario`, `nombre_veterinario`, `especialidad`, `telefono`) VALUES
(1, 'Samuel Garcia', 'Cirugía', '987654321'),
(2, 'Manuel Perez', 'Dentista Veterinario', '987654322'),
(3, 'Liliana Paz', 'Medicina Interna', '987654323'),
(4, 'Ana Miranda', 'Rehabilitación', '987654324');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calendario`
--
ALTER TABLE `calendario`
  ADD PRIMARY KEY (`id_calendario`),
  ADD KEY `id_cita` (`id_cita`),
  ADD KEY `id_veterinario` (`id_veterinario`);

--
-- Indices de la tabla `carrito_de_compras`
--
ALTER TABLE `carrito_de_compras`
  ADD PRIMARY KEY (`id_carrito`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `chatbot`
--
ALTER TABLE `chatbot`
  ADD PRIMARY KEY (`IdChatbot`),
  ADD KEY `idServicio` (`idServicio`),
  ADD KEY `IdUsuario` (`IdUsuario`),
  ADD KEY `IdMembresia` (`IdMembresia`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `idchatbot` (`idchatbot`),
  ADD KEY `id_Usuario` (`id_Usuario`),
  ADD KEY `id_veterinario` (`id_veterinario`),
  ADD KEY `id_mascota` (`id_mascota`),
  ADD KEY `id_estilista` (`id_estilista`);

--
-- Indices de la tabla `estilista`
--
ALTER TABLE `estilista`
  ADD PRIMARY KEY (`id_estilista`);

--
-- Indices de la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
  ADD PRIMARY KEY (`id_historia`),
  ADD KEY `id_mascota` (`id_mascota`),
  ADD KEY `id_veterinario` (`id_veterinario`);

--
-- Indices de la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD PRIMARY KEY (`id_mascota`),
  ADD KEY `id_Usuario` (`id_Usuario`);

--
-- Indices de la tabla `membresia`
--
ALTER TABLE `membresia`
  ADD PRIMARY KEY (`id_membresia`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `id_cita` (`id_cita`),
  ADD KEY `id_carrito` (`id_carrito`),
  ADD KEY `id_membresia` (`id_membresia`),
  ADD KEY `id_servicio` (`id_servicio`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id_servicio`),
  ADD KEY `id_estilista` (`id_estilista`),
  ADD KEY `id_veterinario` (`id_veterinario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD UNIQUE KEY `Correo_electronico` (`Correo_electronico`);

--
-- Indices de la tabla `veterinario`
--
ALTER TABLE `veterinario`
  ADD PRIMARY KEY (`id_veterinario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calendario`
--
ALTER TABLE `calendario`
  MODIFY `id_calendario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estilista`
--
ALTER TABLE `estilista`
  MODIFY `id_estilista` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
  MODIFY `id_historia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `mascota`
--
ALTER TABLE `mascota`
  MODIFY `id_mascota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT de la tabla `membresia`
--
ALTER TABLE `membresia`
  MODIFY `id_membresia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `veterinario`
--
ALTER TABLE `veterinario`
  MODIFY `id_veterinario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
