-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-10-2021 a las 06:10:37
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ciudadano_sano`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cities`
--

INSERT INTO `cities` (`id`, `country_id`, `name`, `status`, `updated_at`, `created_at`) VALUES
(1, 2, 'Cali', 1, '2021-09-30 22:38:41', '2021-09-30 22:21:23'),
(2, 1, 'New York', 1, '2021-09-30 22:38:57', '2021-09-30 22:38:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `countries`
--

INSERT INTO `countries` (`id`, `name`, `status`, `updated_at`, `created_at`) VALUES
(1, 'Estados Unidos', 1, '2021-09-26 19:30:43', '2021-09-26 19:03:37'),
(2, 'Colombia', 1, '2021-09-27 08:06:49', '2021-09-27 08:06:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `seat_id` int(11) NOT NULL,
  `no_document` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `address` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cell_phone` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `employees`
--

INSERT INTO `employees` (`id`, `seat_id`, `no_document`, `name`, `last_name`, `email`, `address`, `cell_phone`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '1122489657', 'Paterson', 'Sinisterra', 'paterson@hotmail.com', 'Ave 12 # 45 - 105', '3113054896', 1, '2021-10-09 21:12:14', '2021-10-09 21:49:47'),
(2, 1, '11447896523', 'Serafin', 'Cerquera', 'serafin@ciudadanosano.com', 'Ave 44 # 78 - 18', '3114562389', 1, '2021-10-09 21:40:17', '2021-10-09 21:40:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `headquarters`
--

CREATE TABLE `headquarters` (
  `id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `headquarters`
--

INSERT INTO `headquarters` (`id`, `city_id`, `name`, `status`, `updated_at`, `created_at`) VALUES
(1, 1, 'San Fernando', 1, '2021-10-03 12:18:47', '2021-10-03 12:18:47'),
(2, 2, 'Liberty', 1, '2021-10-03 12:58:04', '2021-10-03 12:20:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `professions`
--

CREATE TABLE `professions` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `professions`
--

INSERT INTO `professions` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dentista', 1, '2021-10-09 17:52:09', '2021-10-09 17:55:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `permits` text COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `permits`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'Super usuario con todos los permisos del sistema.', ',roles,users,countries,cities,headquarters,types_contracts,professions,employees', 1, '2021-09-19 16:07:10', '2021-09-24 17:56:15'),
(2, 'Paciente', 'Rol para el ingreso de pacientes al sistema', '', 1, '2021-09-19 17:47:54', '2021-09-19 17:47:54'),
(3, 'Director de sedes', 'Rol asignado al director para la gestión de sedes', ',roles', 1, '2021-09-19 17:55:33', '2021-09-21 00:17:27'),
(4, 'Asesor de afiliación', 'Rol asignado al asesor de afiliación para la gestión de pacientes', ',roles,users', 1, '2021-09-19 19:36:52', '2021-09-21 00:18:25'),
(5, 'Empleado', 'Rol utilizado para los empleados', ',roles', 1, '2021-09-20 20:41:34', '2021-09-20 20:41:34'),
(6, 'Proveedor', '', ',users', 1, '2021-09-21 00:19:05', '2021-09-21 00:19:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `types_contracts`
--

CREATE TABLE `types_contracts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `types_contracts`
--

INSERT INTO `types_contracts` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Indefinido', 1, '2021-10-08 21:54:26', '2021-10-08 22:01:02'),
(2, 'Temporal', 1, '2021-10-08 21:55:03', '2021-10-08 21:55:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `rol_id`, `name`, `last_name`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Miguel Angel', 'Cerquera Rodriguez', 'cerquera199627@hotmail.com', '$2y$12$yA2Fjyw0EpMZk5WjB0.bT.Rlybx4uNzh1pnjrycTDpxWldgYmDL8W', 1, '2021-09-22 22:54:26', '2021-10-09 17:49:06'),
(2, 1, 'Ingrid', 'Blanco', 'ingridbp1995@gmail.com', '$2y$12$aXTtOV3BC5oZb1RNS/hd9.BtnHgSuv6gM4KrJIHqIMciNsq8IoCqm', 1, '2021-09-25 12:20:59', '2021-09-25 12:23:53');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-cities_countries` (`country_id`);

--
-- Indices de la tabla `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seat_id` (`seat_id`);

--
-- Indices de la tabla `headquarters`
--
ALTER TABLE `headquarters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indices de la tabla `professions`
--
ALTER TABLE `professions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `types_contracts`
--
ALTER TABLE `types_contracts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `headquarters`
--
ALTER TABLE `headquarters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `professions`
--
ALTER TABLE `professions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `types_contracts`
--
ALTER TABLE `types_contracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `fk-cities_countries` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`);

--
-- Filtros para la tabla `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `fk-employees_headquarters` FOREIGN KEY (`seat_id`) REFERENCES `headquarters` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `headquarters`
--
ALTER TABLE `headquarters`
  ADD CONSTRAINT `fk-headquarters_cities` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk-users_roles` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
